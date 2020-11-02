<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorialFormValidation;
use App\Service\DateOrganizer;
use App\Tutorial;
use App\TutorialCategory;
use App\TutorialInvoice;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    /**
     * @param bool $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($categoryId = false)
    {
        if($categoryId){
            $tutorials = Tutorial::where('tutorial_category_id', $categoryId)->where('status', 1)->paginate(50);
        }else
            $tutorials = Tutorial::where('status', 1)->paginate(50);

        $tutorialCategories = TutorialCategory::get();
        return view('front-end.tutorial.index', compact('tutorials', 'tutorialCategories'));
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
    public function storeTutorial(TutorialFormValidation $request){
        $input = (object) $request->validated();

        $imageName = time(). '.' . $input->tutorial_image->extension();
        $input->tutorial_image->move(storage_path('app/public/tutorial'), $imageName);

        Tutorial::create([
            'tutorial_category_id' => $input->tutorial_category_id,
            'name'              => $input->name,
            'tutorial_image'    => $imageName,
            'date'              => $input->date,
            'trainers'          => json_encode($input->trainers),
            'description'       => $input->description,
            'attendees'         => $input->attendees,
            'curriculum'        => $input->curriculum,
            'requirement'       => $input->requirement,
            'price'             => $input->price,
        ]);

        return redirect()->route('tutorial.create')->with('success', 'Tutorial Creation Successful');
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
        try{
            $tutorial = Tutorial::findOrFail($tutorialId);

            $transactionId = strtoupper(bin2hex(random_bytes(10)));

            $invoice = TutorialInvoice::create([
                'user_id'           => auth()->user()->id,
                'tutorial_id'       => $tutorial->id,
                'amount'            => $tutorial->price,
                'is_paid'           => 0,
                'transaction_id'    => $transactionId,
            ]);

            $paymentRoute = $sslPayment->makePaymentRequest($invoice->amount, config('drb.paymentType.tutorial'), $transactionId);
            return redirect($paymentRoute);

        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Cant Proceed Payment. Something Went Wrong');
        }
    }

    public function categoryView()
    {
        return view('back-end.tutorial.category-view');
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

}
