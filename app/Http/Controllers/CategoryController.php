<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
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

    /**
     * research category list view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function researchCategory() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'admin'){
        } else {
            return abort(404);
        }
        $categories = ResearchCategory::orderBy('created_at', 'DESC')->get();
        return view('back-end.research-category.index', compact('categories'));
    }

    /**
     * Research category store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * research category edit
     * @param $CategoryId
     */
    public function researchCategoryEdit($categoryId) {
        try {
            $category = ResearchCategory::find($categoryId);
            return view('back-end.research-category.edit', compact('category'));
        }catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }
    }

    /**
     * research category update method
     * @param Request $request
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function researchCategoryUpdate(Request $request, $categoryId) {
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);
            $slug = Str::slug($request->name, '_');
            $slug = $slug.'_'.$categoryId;

            $category = ResearchCategory::find($categoryId);
            $category->name = $request->name;
            $category->slug = $slug;
            $category->save();

            return redirect()->route('admin.research.category')->with('success', 'Category Updated Successfully');
        }catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }
    }

    public function researchCategoryDelete($categoryId) {

        try{
            $productExist = Product::where('category_id', $categoryId)->first();

            if($productExist){
                return redirect()->back()->with('failed', 'This category has product. You cannot delete this category.');
            } else {
                $category = ResearchCategory::find($categoryId);
                $category->delete();
                return redirect()->back()->with('success', 'Category Has Been Deleted Successfully.');
            }
        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }
    }

}
