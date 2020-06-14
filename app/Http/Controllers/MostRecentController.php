<?php

namespace App\Http\Controllers;

use App\MostRecent;
use Illuminate\Http\Request;
use Auth;

class MostRecentController extends Controller
{
    public function index()
    {
        $mostrecents = MostRecent::orderBy('created_at', 'DESC')->get();
        return view('back-end.most-recent.index', compact('mostrecents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:200',
            'date' => 'required',
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $mostrecent = new MostRecent([
            'user_id' => Auth::user()->id,
            'body' => $request->get('body'),
            'date' => $request->get('date'),
            'is_published' => $is_published
        ]);
        $mostrecent->save();
        return redirect()->back()->with('success', 'Most Recent Topic has been created successfully');

    }

    public function edit($id)
    {
        $mostrecent = MostRecent::find($id);
        return view('back-end.most-recent.edit', compact('mostrecent'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required|max:200',
            'date' => 'required',
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $mostrecents = MostRecent::find($id);
        $mostrecents->user_id = Auth::user()->id;
        $mostrecents->body = $request->get('body');
        $mostrecents->date = $request->get('date');
        $mostrecents->is_published = $is_published;
        $mostrecents->save();
        return redirect()->route('recent.index')->with('success', 'Most Recent Topic has been updated successfully');

    }

    public function destroy($id)
    {
        $mostrecent = MostRecent::find($id);
        $mostrecent->delete();
        return redirect()->back()->with('success', 'Most Recent Topic has been deleted successfully');
    }
}
