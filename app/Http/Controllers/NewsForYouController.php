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
            $filter->newspaper_id = $request->newspapers ? json_encode($request->newspapers) : null;
            $filter->category_id = $request->categories ? json_encode($request->categories) : null;
            $filter->language = $request->language;
            $filter->update();

        }else{
            $filter = new NewsForYou();
            $filter->user_id = auth()->user()->id;
            $filter->newspaper_id = $request->newspapers ? json_encode($request->newspapers) : null;
            $filter->category_id = $request->categories ? json_encode($request->categories) : null;
            $filter->language = $request->language;
            $filter->save();
        }
        return redirect()->back()->with('success', 'Saved Successfully');
    }

    public function getFilteredNews()
    {
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();

        if(!auth()->user()){
            return view('front-end.news.news-for-you-login', compact('categories'));
        }

        $filter = NewsForYou::where('user_id', auth()->user()->id)->first();

        $newspapers = Newspaper::get();

        //if no filter
        if(!$filter){
            return view('front-end.news.filter', compact('categories', 'newspapers', 'filter'));
        }

        $filter->category_id = (str_replace('"',"",$filter->category_id));
        $filter->newspaper_id = (str_replace('"',"",$filter->newspaper_id));

        return view('front-end.news.news-for-you', compact('categories', 'filter'));
    }
}
