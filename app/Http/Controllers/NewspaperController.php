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

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $newspaper = new Newspaper();
        $newspaper->name = $request->newspaper;
        $newspaper->save();

        return redirect()->back()->with('success', 'Successfully Added');
    }

    public function edit($id)
    {
        $newspaper = Newspaper::where('id', $id)->first();
        return view('back-end.newspaper.edit', compact('newspaper'));
    }
}
