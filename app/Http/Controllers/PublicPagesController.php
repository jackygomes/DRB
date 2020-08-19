<?php

namespace App\Http\Controllers;
use App\Survey;
use Illuminate\Http\Request;
use App\FinanceInfo;
use App\Company;
use App\Page;
use App\Menu;
use Mail;
use App\Mail\ContactUs;
use App\Mail\Subscribe;
use App\News;
use App\PageItem;
use App\StaticContent;
use App\SubscriptionPlan;
use Illuminate\Database\Eloquent\Collection;

class PublicPagesController extends Controller
{
    public function landing(){
        $survey_results = Survey::where('is_published', true)->get();
        $surveys = Survey::where('is_accepting_answer', true)->get();
        $staticcontent = StaticContent::all();
        $subscriptionplans = SubscriptionPlan::where('is_visible', 1)->get();
        $featured = News::where('is_published', 1)->where('showing_area', 'featured')->latest()->first();
        $world = News::where('is_published', 1)->where('showing_area', 'world')->latest()->first();
        $worlds = News::where('is_published', 1)->where('showing_area', 'world')->orderBy('id', 'desc')->skip(1)->take(4)->get();
        $country = News::where('is_published', 1)->where('showing_area', 'country')->latest()->first();
        $countries = News::where('is_published', 1)->where('showing_area', 'country')->orderBy('id', 'desc')->skip(1)->take(4)->get();
        $economy = News::where('is_published', 1)->where('showing_area', 'economy')->latest()->first();
        $economies = News::where('is_published', 1)->where('showing_area', 'economy')->orderBy('id', 'desc')->skip(1)->take(4)->get();
        $company = News::where('is_published', 1)->where('showing_area', 'company')->latest()->first();
        $companies = News::where('is_published', 1)->where('showing_area', 'company')->orderBy('id', 'desc')->skip(1)->take(4)->get();
        $top5s = News::where('is_published', 1)->where('showing_area', 'top5')->latest()->take(7)->get();
        $sides = News::where('is_published', 1)->where('showing_area', 'side')->latest()->take(10)->get();
        // $allnews = News::where('is_published', 1)->where('showing_area', '<>',  'featured')->latest()->take(5)->get();
        return view('front-end.home.index', compact('subscriptionplans','surveys', 'survey_results','staticcontent','featured','world','worlds','country','countries','economy','economies','company','companies', 'top5s', 'sides'));
    }

    public function search(Request $request)
    {
        $companies = Company::where('name', 'LIKE', "%$request->search%")
        ->orwhere('ticker', 'LIKE', "%$request->search%")->get();
        if($companies->count() > 0)
        {
            $finance_infos = new Collection();
            foreach ($companies as $company)
            {
                $finance_info = FinanceInfo::where('company_id', 'LIKE', "$company->id")->first();
                if ($finance_info != null) {
                    $finance_infos->push($finance_info);
                }
            }
        }
        // elseif($tickers->count() > 0)
        // {
        //     $finance_infos = new Collection();
        //     foreach ($tickers as $ticker)
        //     {
        //         $finance_info = FinanceInfo::where('company_id', 'LIKE', "$ticker->id")->first();
        //         if ($finance_info != null) {
        //             $finance_infos->push($finance_info);
        //         }
        //     }
        // }
        else{
            $finance_infos = FinanceInfo::where('year', 'LIKE', "%$request->search%")->get();
        }

        $menu = Menu::where('title', 'LIKE', "%$request->search%")->first();
        $pageitems = PageItem::where('particular', 'LIKE', "%$request->search%")->get();
        if($menu != null)
        {
            $pages = Page::where('menu_id', 'LIKE', "%$menu->id%")
            ->orwhere('title', 'LIKE', "%$request->search%")->get();
        }
        // elseif( $pageitems->count() > 0)
        // {
        //     $pages = new Collection();
        //     foreach ($pageitems as $pageitem)
        //     {
        //         $page = Page::where('id', 'LIKE', "%$pageitem->page_id%")->first();
        //         if ($page != null) {
        //             $pages->push($page);
        //         }
        //     }
        // }
        else{
            $pages = Page::where('title', 'LIKE', "%$request->search%")
            ->orWhere('description', 'LIKE', "%$request->search%")->get();
        }

        $allnews = News::where('is_published', 1)->where('heading', 'LIKE', "%$request->search%")->latest()->paginate(10);

        return view('front-end.search.search', compact('finance_infos', 'pages', 'pageitems','allnews'));
    }

    public function contactUs(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'body' => 'required|max:255',
        ]);
        Mail::to([env('MY_MAIL')])
        ->queue(new ContactUs( $request->email, $request->body));

        return Redirect()->back()->with('success', 'Your message successfully sent');

    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
        Mail::to([env('MY_MAIL')])
        ->queue(new Subscribe( $request->email));

        return Redirect()->back()->with('success', 'Your email successfully subscribed');

    }


}
