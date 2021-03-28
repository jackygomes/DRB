<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\NewsletterCategory;
use Illuminate\Http\Request;

class NewsletterCategoryController extends Controller
{
    public function index()
    {
        $newsletterCategories = NewsletterCategory::all();
        return view('back-end.newsletter_category.index', compact('newsletterCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['category' => 'required', 'type' => 'required']);
        NewsletterCategory::create(['category' => $request->category, 'type' => $request->type]);
        return redirect()->route('nl_category.index')->with(['success' => 'Created Successfully']);
    }

    public function edit($id)
    {
        $newsletterCategories = NewsletterCategory::findOrFail($id);
        return view('back-end.newsletter_category.edit', compact('newsletterCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'string',
            'type' => 'string'
        ]);
        $newsletterCategory = NewsletterCategory::findOrFail($id);
        $newsletterCategory->update($request->all());
        return back()->with(['success' => 'Category Updated Successfully']);
    }

    public function delete($id)
    {
        $newsletterCategory = NewsletterCategory::findOrFail($id);

        if(count($newsletterCategory->newsletter) > 0)
            return back()->with(['error' => 'Newsletters Exist In This Category. Can\'t Delete It.']);
        else{
            $newsletterCategory->delete();
            return back()->with(['success' => 'Deleted Successfully']);
        }
    }
}
