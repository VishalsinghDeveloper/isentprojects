<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.pages.profile.profile', ['user' => $user]);
    }
    public function changePassword(Request $request,$id)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required',
        ]);
        $old= Auth::user()->password;
        if (!(Hash::check($request->oldpassword, Auth::user()->password))) {
            return redirect()->back()->with("error","Your Old password does not matches. Please try again.");
        }
        $update=User::find($id);
        $update->password=Hash::make($request->password);
        $update->update();
        return redirect()->back()->with("massage","Your password changed");
    }

    public function changeprofile(Request $request,$id){
        $request->validate([
            'name'=> 'required',
            'email'=> 'email',
            'phone'=> 'required|digits:10',
        ]);
        $user =User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email=$request->email;
        $user->update();
        return redirect()->back()->with("message","Your changes successfully");
    }

    
    public function updateimage(Request $request,$id){
        $request->validate([
            'profileimages'=> 'required',
        ]);
        $user =User::find($id);
        if ($request->hasfile('profileimages')) {
            $path ='/uploads/user/';
            $file = $request->file('profileimages');
            $extention = $file->getClientOriginalExtension();
            $filename = $path.time() . '.' . $extention;
            $file->move('uploads/user/', $filename);
            $user->images = $filename;
        }
        $user->update();
        return redirect()->back()->with("message","Your changes successfully");
    }
      
}
