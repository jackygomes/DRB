<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\NewsForYou;
use App\Newspaper;
use Illuminate\Http\Request;

class NewsForYouController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $newspapers = Newspaper::get();
        $filter = NewsForYou::where('user_id', auth()->user()->id)->first();
        return view('back-end.news.foryou', compact('categories', 'filter', 'newspapers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newspapers' => 'required',
            'categories' => 'required',
            'language' => 'required'
        ]);

        if($filter = NewsForYou::where('user_id', auth()->user()->id)->first()){
            $filter->newspapers = $request->newspapers ? json_encode($request->newspapers) : null;
            $filter->categories = $request->categories ? json_encode($request->categories) : null;
            $filter->language = $request->language;
            $filter->update();

        }else{
            $filter = new NewsForYou();
            $filter->user_id = auth()->user()->id;
            $filter->newspapers = $request->newspapers ? json_encode($request->newspapers) : null;
            $filter->categories = $request->categories ? json_encode($request->categories) : null;
            $filter->language = $request->language;
            $filter->save();
        }
        return redirect()->back()->with('success', 'Saved Successfully');
    }

    public function getFilteredNews()
    {
        $filter = NewsForYou::where('user_id', auth()->user()->id)->first();
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
        $newspapers = Newspaper::get();

        //if no filter
        if(!$filter){
            return view('front-end.news.filter', compact('categories', 'newspapers', 'filter'));
        }

        $filter->categories = (str_replace('"',"",$filter->categories));
        $filter->newspapers = (str_replace('"',"",$filter->newspapers));

        return view('front-end.news.news-for-you', compact('categories', 'filter'));
    }
}
