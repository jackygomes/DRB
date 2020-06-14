<?php

namespace App\Http\Controllers;

use App\Company;
use App\Sector;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('name')->get()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $companies = Company::orderBy('name')->get()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.company.index', compact('companies','sectors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ticker' => 'required',
            'sector_id' => 'required',
        ]);

        $company = new Company([
            'name' => $request->get('name'),
            'ticker' => $request->get('ticker'),
            'sector_id' => $request->get('sector_id')
        ]);
        $company->save();
        return redirect()->route('company.index');
    }

    public function edit($id)
    {
        $sectors = Sector::orderBy('name')->get()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
        $company = Company::find($id);
        return view('back-end.company.edit', compact('company', 'sectors'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'ticker' => 'required',
            'sector_id' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->ticker = $request->get('ticker');
        $company->sector_id = $request->get('sector_id');
        $company->is_visible = $request->get('is_visible');
        $company->save();
        return redirect()->route('company.index')->with('success', 'Company has been updated successfully');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('company.index')->with('success', 'Page has been deleted successfully');
    }

    public function show($id){
        $company = Company::find($id);
        return view('back-end.company.show', compact('company'));
    }
}
