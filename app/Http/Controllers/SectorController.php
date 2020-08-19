<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('name')->get()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.sector.index', compact('sectors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sectors',
        ]);

        $sector = new Sector([
            'name' => $request->get('name')
        ]);
        $sector->save();
        return redirect()->route('sector.index')->with('Sector has been created successfully');
    }

    public function edit($id)
    {
        $sector = Sector::find($id);
        return view('back-end.sector.edit', compact('sector'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sectors,name,'.$id,
        ]);
        $sector = Sector::find($id);
        $sector->name = $request->get('name');
        $sector->save();
        return redirect()->route('sector.index')->with('success', 'Sector has been updated successfully');
    }

    public function destroy($id)
    {
        $sector = Sector::find($id);
        $sector->delete();
        return redirect()->route('sector.index')->with('Sector has been deleted successfully');
    }

}
