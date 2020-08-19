<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('title')->get()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
        ]);
        $menu = new Menu([
            'title' => $request->get('title'),
            'parent_menu_id' => $request->get('parent_menu_id')

        ]);
        $menu->save();
        return redirect(route('menu.index'))->with('success', 'Menu has been created successfully');
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        $allmenus = Menu::orderBy('title')->get()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.menu.edit', compact('menu', 'allmenus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
        ]);
        $menu = Menu::find($id);
        $menu->title = $request->get('title');
        $menu->parent_menu_id = $request->get('parent_menu_id');
        $menu->save();
        return redirect()->route('menu.index')->with('success', 'Menu has been updated successfully');
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu has been deleted successfully');
    }
}
