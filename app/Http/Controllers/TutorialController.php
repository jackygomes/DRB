<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorialFormValidation;
use App\Service\DateOrganizer;
use App\Tutorial;
use App\TutorialCategory;
use App\TutorialInvoice;
use Google\Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Matrix\Exception;

class TutorialController extends Controller
{
    /**
     * @param bool $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($categoryId = false)
    {
        if ($categoryId) {
            $tutorials = Tutorial::where('tutorial_category_id', $categoryId)->where('status', 1)->paginate(50);
        } else
            $tutorials = Tutorial::where('status', 1)->paginate(50);

        $tutorialCategories = TutorialCategory::get();
        $dateOrganizer = new DateOrganizer();
        return view('front-end.tutorial.index', compact('tutorials', 'tutorialCategories', 'dateOrganizer'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $tutorials = Tutorial::get();
        $dateOrganizer = new DateOrganizer();
        return view('back-end.tutorial.index', compact('tutorials', 'dateOrganizer'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tutorialCategories = TutorialCategory::get();
        return view('back-end.tutorial.create', compact('tutorialCategories'));
    }

    /**
     * @param TutorialFormValidation $request
     * @return $this
     */
    public function storeTutorial(TutorialFormValidation $request)
    {
        $input = (object)$request->validated();
        $imageName = $this->storeImage($input);

        Tutorial::create([
            'tutorial_category_id' => $input->tutorial_category_id,
            'name' => $input->name,
            'tutorial_image' => $imageName,
            'date' => $input->date,
            'end_date' => $input->end_date,
            'trainers' => json_encode($input->trainers),
            'description' => $input->description,
            'attendees' => $input->attendees,
            'curriculum' => $input->curriculum,
            'requirement' => $input->requirement,
            'price' => $input->price,
        ]);

        return redirect()->route('tutorial.create')->with('success', 'Tutorial Creation Successful');
    }

    /**
     * @param $input
     * @return string
     */
    public function storeImage($input){

        $image = Image::make($input->tutorial_image)->resize(600, 400);
        $fileName = time() . '.jpg';
        Storage::disk('s3')->put(env('APP_ENV') . '/training/' . $fileName, $image->stream()->__toString());

        return $fileName;
    }

    /**
     * @param $id
     * @return $this
     */
    public function updateStatus($id)
    {
        $tutorial = Tutorial::where('id', $id)->first();
        $tutorial->status ? $tutorial->status = 0 : $tutorial->status = 1;
        $tutorial->save();
        return redirect()->back()->with('success', 'Updated Status Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tutorialDetails($id)
    {
        $tutorial = Tutorial::where('id', $id)->first();
        $dateOrganizer = new DateOrganizer();
        $invoices = TutorialInvoice::where('tutorial_id', $tutorial->id)->with('user')->get();
        return view('back-end.tutorial.detail', compact('tutorial', 'dateOrganizer', 'invoices'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDetails($id)
    {
        $tutorial = Tutorial::where('id', $id)->first();
        $tutorialCategories = TutorialCategory::get();
        $dateOrganizer = new DateOrganizer();
        $attendees = TutorialInvoice::where('id', $tutorial->id)->get();
        return view('front-end.tutorial.details', compact('tutorial', 'dateOrganizer', 'tutorialCategories', 'attendees'));
    }


    /**
     * @param $tutorialId
     * @param SslPaymentController $sslPayment
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function makePayment($tutorialId, SslPaymentController $sslPayment)
    {
        try {
            $tutorial = Tutorial::findOrFail($tutorialId);

            $transactionId = strtoupper(bin2hex(random_bytes(10)));

            $invoice = TutorialInvoice::create([
                'user_id' => auth()->user()->id,
                'tutorial_id' => $tutorial->id,
                'amount' => $tutorial->price,
                'is_paid' => 0,
                'transaction_id' => $transactionId,
            ]);

            $paymentRoute = $sslPayment->makePaymentRequest($invoice->amount, config('drb.paymentType.tutorial'), $transactionId);
            return redirect($paymentRoute);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cant Proceed Payment. Something Went Wrong');
        }
    }

    public function categoryView()
    {
        $categories = TutorialCategory::get();
        $dateOrganizer = new DateOrganizer();
        return view('back-end.tutorial.category-view', compact('categories', 'dateOrganizer'));
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        TutorialCategory::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Added New Category');
    }

    /**
     * @param bool $id
     * @return $this
     */
    public function addToCalendar($id = false)
    {
        $http = new \GuzzleHttp\Client([
            'verify' => false,
        ]);

        $client = new Client();
        $client->setHttpClient($http);
        $client->setApplicationName('Training Event');
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setClientId(config('drb.googleCalendar.clientId'));
        $client->setClientSecret(config('drb.googleCalendar.clientSecret'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->setRedirectUri(route('tutorials.add.to.calendar'));
        //$client->setRedirectUri('https://5d10707899df.ngrok.io/trainings/add-to-calendar'); //route('tutorials.add.to.calendar')

        if (!isset($_GET['code'])) {
            $client->setState(base64_encode(json_encode(['tutorial_id' => $id])));
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit();

        } elseif (isset($_GET['code'])) {
            $tokenInfo = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($tokenInfo);

            //calender code
            if(isset($_GET['state'])){
                $tutorialId =  json_decode(base64_decode($_GET['state']))->tutorial_id;
                $tutorial = Tutorial::where('id', $tutorialId)->first();

                try{
                    //event setup
                    $event = new Google_Service_Calendar_Event();
                    $event->setSummary($tutorial->name);

                    $start = new \Google_Service_Calendar_EventDateTime();
                    $start->setDateTime($tutorial->date . ':00+06:00');
                    $start->setTimeZone('Asia/Dhaka');
                    $event->setStart($start);

                    $end = new \Google_Service_Calendar_EventDateTime();
                    $end->setDateTime($tutorial->end_date . ':00+06:00');
                    $end->setTimeZone('Asia/Dhaka');
                    $event->setEnd($end);

                    $calendarService = new Google_Service_Calendar($client);
                    $calendarId = 'primary';

                    $result = $calendarService->events->insert($calendarId, $event);
                    //dd($result->htmlLink);

                    return redirect()->route('tutorials.details', $tutorial->id)->with('success', 'Added Training Event To Calendar');
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            }
        }

    }


}
