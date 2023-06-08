<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Sanctum;
use Illuminate\Support\Facades\Crypt;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $firstError = $errors->first();
        
                throw new Exception($firstError);
            }  
            $user = User::where('phone', $request->phone)->first();
            if (empty($user)) {
                return response()->json([
                    'status' => false,
                    'message' => "User Not Found"
                ], 200);
            }
            if ($user->status === 0) {
                return response()->json([
                    'status' => false,
                    'message' => "Sorry, Your account has been Blocked. Please contact the administrator."
                ], 403);
            }
            $otp = rand(111111, 999999);

            $tokenPayload = [
                'otp' => $otp,
                'id' => $user->id ?? null,
                'email' => $user->email,
            ];
            $token = Crypt::encrypt($tokenPayload);

            return response()->json([
                'status' => true,
                'token' => $token,
                'otp' => $otp
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'otp' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = $errors->first();
    
            throw new Exception($firstError);
        }  
        $token = $request->input('token');
        $otp = $request->input('otp');
        $payload = Crypt::decrypt($token);
        $storedOtp = $payload['otp'];
        if ($storedOtp == $otp) {
            $user = User::where('id', $payload['id'])->first();
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'status' => true,
                'access_token' => $token,
                'message' => 'OTP verification successful',
                'user'=> $user
            ], 200);
        } else{return response()->json([
            'status' => false,
            'otp' => 'Invalid OTP',
        ], 400);
    } 
    } catch (Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
        ], 400);
    }
    }
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|digits:10|unique:users',
                'gst_no' => 'nullable', 'unique:users,gst_no',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $firstError = $errors->first();
        
                throw new Exception($firstError);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gst_no' => $request->gst_no,

            ]);
            if ($request->hasFile('images')) {
                $path = '/uploads/user/';
                $file = $request->file('images');
                $extension = $file->getClientOriginalExtension();
                $filename = $path . time() . '.' . $extension;
                $file->move('uploads/user/', $filename);
                $user->images = $filename;
            }
            $user->save();
            $otp = rand(111111, 999999);

            $tokenPayload = [
                'otp' => $otp,
                'id' => $user->id,
                'email' => $user->email,
            ];
            $token = Crypt::encrypt($tokenPayload);

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'otp' => $otp,
                'token' => $token,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 404);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = $request->user();

            Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|string|min:8',
            ])->validate();

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'The provided current password does not match your actual password.',
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }


    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $fieldsToUpdate = ['name', 'phone', 'email'];
        $hasChanges = false;

        foreach ($fieldsToUpdate as $field) {
            if ($request->has($field)) {
                $user->$field = $request->$field;
                $hasChanges = true;
            }
        }
        if ($request->hasFile('profileimages')) {
            $path = '/uploads/user/';
            $filename = $path . time() . '.' . $request->file('profileimages')->getClientOriginalExtension();
            $request->file('profileimages')->move('uploads/user/', $filename);
            $user->images = $filename;
            $hasChanges = true;
        }
        if (!$hasChanges) {
            return response()->json(['message' => 'No changes provided'], 400);
        }
        $user->save();
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
