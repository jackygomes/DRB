<?php

namespace App\Http\Controllers;

use App\News;
use App\Newspaper;
use Illuminate\Http\Request;

class NewspaperController extends Controller
{
    public function index()
    {
        $newspapers = Newspaper::get();
        return view('back-end.newspaper.index', compact('newspapers'));
    }

    public function create()
    {
        return view('back-end.newspaper.create');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'newspaper' => 'required'
        ]);

        $newspaper = new Newspaper();
        $newspaper->name = $request->newspaper;
        $newspaper->save();

        return redirect()->route('newspapers')->with('success', 'Successfully Added');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $newspaper = Newspaper::where('id', $id)->first();
        return view('back-end.newspaper.edit', compact('newspaper'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'newspaper' => 'required'
        ]);

        $newspaper = Newspaper::where('id', $id)->first();
        $newspaper->name = $request->newspaper;
        $newspaper->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }
}
