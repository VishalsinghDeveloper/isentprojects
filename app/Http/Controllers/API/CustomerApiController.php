<?php

namespace App\Http\Controllers\API;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerApiController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $customers = $user->customers;
            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Customer Data not found',
                    'customers' => $customers
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Customer All Data',
                    'customers' => $customers
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'phone' => 'required|digits:10|unique:customers',
                'email' => 'nullable|email|unique:customers,email',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $firstError = $errors->first();
        
                throw new Exception($firstError);
            }  
            $customer = new Customer();
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->phone = $request->input('phone');
            $customer->email = $request->input('email');
            $birthDate = $request->input('birth_date');
            $dob = '0000-' . date('m-d', strtotime($birthDate));
            $customer->user_id = Auth::user()->id;
            $customer->birth_date = $dob;
            if ($request->hasFile('images')) {
                $path = '/uploads/customers/';
                $file = $request->file('images');
                $extension = $file->getClientOriginalExtension();
                $filename = $path . time() . '.' . $extension;
                $file->move('uploads/customers/', $filename);
                $customer->images = $filename;
            }
            $customer->save();

            return response()->json([
                'status' => true,
                'message' => 'Customer created successfully',
                'customer' => $customer
            ], 200);
        } catch (Exception $e) {
            return  response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }
}
