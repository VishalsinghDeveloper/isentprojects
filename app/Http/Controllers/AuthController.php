<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginaction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        return redirect()->route('dashboard');
    }

    // public function register()
    // {
    //     return view('admin.auth.register');
    // }

    // public function registeraction(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'phone' => ['required', 'digits:10','unique:users'],

    //     ])->validate();
    //     $user =new User;
    //     $user->name = $request->name;
    //     $user->phone = $request->phone;
    //     $user->email=$request->email;
    //      if ($request->hasfile('images')) {
    //         $path ='/uploads/user/';
    //         $file = $request->file('images');
    //         $extention = $file->getClientOriginalExtension();
    //         $filename = $path.time() . '.' . $extention;
    //         $file->move('uploads/user/', $filename);
    //         $user->images = $filename;
    //     }
    //     return redirect()->route('dashboard');
    // }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
