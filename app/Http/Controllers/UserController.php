<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
   {
       $users = User::orderBy('full_name')->get()->sortBy('full_name', SORT_NATURAL|SORT_FLAG_CASE);
       return view('back-end.user.index', compact('users'));
   }

   public function edit($id)
   {
        $user = User::find($id);
        return view('back-end.user.edit', compact('user'));
   }

   public function update(Request $request, $id)
   {
        $this->validate($request, [
            'full_name' => 'required|max:100',
            'contact_number'=>'required' ,
            'profession' => 'required',
            'institution' => 'required',
            'type' => 'required',
            'email'=>'required|email|unique:users,email,'.$id ,
        ]);

        $user = User::find($id);
        $user->full_name = $request->get('full_name');
        $user->contact_number = $request->get('contact_number');
        $user->profession = $request->get('profession');
        $user->institution = $request->get('institution');
        $user->type = $request->get('type');
        $user->email = $request->get('email');

        $user->save();
        return redirect()->route('user.index')->with('success', 'User has been updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User has been deleted successfully');
    }

}
