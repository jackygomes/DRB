<?php

namespace App\Http\Controllers;

use App\Category;
use App\ResearchCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function researchCategory() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'admin'){
        } else {
            return abort(404);
        }
        $categories = ResearchCategory::all();
        return view('back-end.research-category.index', compact('categories'));
    }

    public function researchCategoryStore(Request $request) {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'admin'){
        } else {
            return abort(404);
        }
        $this->validate($request, [
            'name' => 'required',
        ]);

        try{
            $data = [
                'name' => $request->name,
                'slug' => '',
            ];
            $slug = Str::slug($request->name, '_');
            if($category = ResearchCategory::create($data)){
                $slug = $slug.'_'.$category->id;

                $category->slug = $slug;
                $category->save();
            }
        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }

        return redirect()->back()->with('success', 'Category Created Successfully');
    }
}
