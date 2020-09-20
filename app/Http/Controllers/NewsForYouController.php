<?php

namespace App\Http\Controllers;

use App\Category;
use App\NewsForYou;
use Illuminate\Http\Request;

class NewsForYouController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $filter = NewsForYou::where('user_id', auth()->user()->id)->first();
        return view('back-end.news.foryou', compact('categories', 'filter'));
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
}
