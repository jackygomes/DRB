<?php

namespace App\Http\Controllers;

use App\StaticContent;
use Illuminate\Http\Request;

class StaticContentController extends Controller
{
    public function index()
    {
        $keyvaluepairs = StaticContent::orderBy('key')->get()->sortBy('key', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.configuration.index', compact('keyvaluepairs'));
    }

    public function edit($id)
    {
        $keyvaluepair = StaticContent::find($id);
        return view('back-end.configuration.edit', compact('keyvaluepair'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'value' => 'required',
        ]);

        $keyvaluepair = StaticContent::find($id);
        $keyvaluepair->value = $request->get('value');
        $keyvaluepair->save();
        return redirect()->route('configuration.index')->with('success', 'Value has been updated successfully');
    }
}
