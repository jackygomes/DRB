<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
   {

       $users = User::orderBy('full_name')->get()->sortBy('full_name', SORT_NATURAL|SORT_FLAG_CASE);
       return view('back-end.user.index', compact('users'));
   }

    public function create()
    {
        return view('back-end.user.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'contact_number' => 'required',
            'profession' => 'required',
            'institution' => 'required',
            'type' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        //user image store
        $imageName = '';
        if(isset($request->thumbnailImage) && $request->type == 'provider') {
            $image = $request->file('thumbnailImage');
            if($image) {
                $imageNameOriginal = explode('.', $image->getClientOriginalName());
                $imageName = $imageNameOriginal[0].'-'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path("storage"), $imageName);
            }
        }

        try{
            $data = [
                'full_name'         => $request->full_name,
                'contact_number'    => $request->contact_number,
                'profession'        => $request->profession,
                'institution'       => $request->institution,
                'type'              => $request->type,
                'email'             => $request->email,
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make($request->password),
                'thumbnail_image'   => isset($imageName) ? $imageName : null,
            ];

            User::create($data);

        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }

        return redirect()->route('user.create')->with('success','User created successfully');
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

       //user image delete & store
       $imageName = '';
       if(isset($request->thumbnailImage) && $request->type == 'provider') {
           $image = $request->file('thumbnailImage');
           if($image) {
               $imageNameOriginal = explode('.', $image->getClientOriginalName());
               $imageName = $imageNameOriginal[0].'-'.time().'.'.$image->getClientOriginalExtension();
               $image->move(public_path("storage"), $imageName);
           }
           $oldImagePath = 'storage/'.$request->oldThumbnailImage;
           File::delete($oldImagePath);
       }

        $user = User::find($id);
        $user->full_name = $request->get('full_name');
        $user->contact_number = $request->get('contact_number');
        $user->profession = $request->get('profession');
        $user->institution = $request->get('institution');
        $user->type = $request->get('type');
        $user->email = $request->get('email');
        $user->thumbnail_image = isset($imageName) ? $imageName : null;

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
