<?php

namespace App\Http\Controllers;

use App\Announcment;
use Illuminate\Http\Request;

class AnnouncmentController extends Controller
{
    public function index()
    {
        $announcments = Announcment::orderBy('text')->get()->sortBy('text', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.announcment.index', compact('announcments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $announcment = new Announcment([
            'text' => $request->get('text'),
            'is_published' => $is_published
        ]);
        $announcment->save();
        return redirect()->route('announcment.index')->with('success', 'Announcment has been created successfully');
    }

    public function edit($id)
    {
        $announcment = Announcment::find($id);
        return view('back-end.announcment.edit', compact('announcment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $announcment = Announcment::find($id);
        $announcment->text = $request->get('text');
        $announcment->is_published = $is_published;
        $announcment->save();
        return redirect()->route('announcment.index')->with('success', 'Announcment has been updated successfully');
    }

    public function destroy($id)
    {
        $announcment = Announcment::find($id);
        $announcment->delete();
        return redirect()->route('announcment.index')->with('success', 'Announcment has been deleted successfully');
    }
}
