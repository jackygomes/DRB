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
        if($filter = NewsForYou::where('user_id', auth()->user()->id)->first()){
            $filter->newspaper_id = $request->newspaper;
            $filter->category_id = $request->category;
            $filter->update();

        }else{
            $filter = new NewsForYou();
            $filter->user_id = auth()->user()->id;
            $filter->newspaper_id = $request->newspaper;
            $filter->category_id = $request->category;
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
            return view('front-end.news.filter', compact('categories', 'newspapers'));
        }

        return view('front-end.news.news-for-you', compact('categories', 'filter'));
    }
}
