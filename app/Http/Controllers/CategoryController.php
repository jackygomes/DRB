<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('back-end.category.index', compact('categories'));
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255',
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $category = new Category([
            'name' => $request->get('name'),
            'order' => $request->get('order'),
            'is_published' => $is_published
        ]);
        $category->save();
        return redirect()->back()->with('success', 'Category has been created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('back-end.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255',
        ]);

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }
        
        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->order = $request->get('order');
        $category->is_published = $is_published;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category has been updated successfully');
    }

    public function destroy ($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category has been deleted successfully');
    }
}
