<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('title')->get()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
        $pages = Page::orderBy('slug')->get()->sortBy('slug', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.page.index', compact('pages', 'menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'menu_id' => 'required',
            'slug' => 'required|unique:pages',
        ]);

        $page = new Page([
            'title' => $request->get('title'),
            'menu_id' => $request->get('menu_id'),
            'description' => $request->get('description'),
            'slug' => $request->get('slug')
        ]);
        $page->save();
        return redirect()->route('page.index')->with('success', 'Page has been created successfully');
    }

    public function edit($id)
    {
        $menus = Menu::orderBy('title')->get()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
        $page = Page::find($id);
        return view('back-end.page.edit', compact('page', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'menu_id' => 'required',
            'slug' => 'required|unique:pages,slug,'.$id,
        ]);
        $page = Page::find($id);
        $page->title = $request->get('title');
        $page->menu_id = $request->get('menu_id');
        $page->description = $request->get('description');
        $page->slug = $request->get('slug');
        $page->save();
        return redirect()->route('page.index')->with('success', 'Page has been updated successfully');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->route('page.index')->with('success', 'Page has been deleted successfully');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('front-end.pages.page', compact('page'));
    }

    public function show(Request $request, Page $page)
    {
        return view('back-end.page.show', compact('page'));
    }
}
