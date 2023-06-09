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
use Carbon\Carbon;

class CustomerApiController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $customers = $user->customers->map(function ($customer) {
                $customer->birth_date = date('d M', strtotime($customer->birth_date));
                return $customer;
            });

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
            $customer->birth_date = $dob;
            $customer->user_id = Auth::user()->id;
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

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'sometimes|required',
                'email' => 'nullable|email',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $firstError = $errors->first();
                throw new Exception($firstError);
            }
            $customer = Customer::find($id);
            if (!$customer) {
                throw new Exception('Customer not found');
            }
            if (Auth::user()->id !== $customer->user_id) {
                throw new Exception('Unauthorized');
            }

            // Update customer details
            $customer->fill($request->except('birth_date'));

            $birthDate = $request->input('birth_date');
            if ($birthDate) {
                $dob = '0000-' . date('m-d', strtotime($birthDate));
                $customer->birth_date = $dob;
            }

            if ($request->hasFile('images')) {
                $des = '/uploads/customers/' . $customer->image;
                if (File::exists($des)) {
                    File::delete($des);
                }
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
                'message' => 'Customer updated successfully',
                'customer' => $customer
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }


    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                throw new Exception('Customer not found');
            }
            if (Auth::user()->id !== $customer->user_id) {
                throw new Exception('Unauthorized');
            }
            // Delete customer's images if they exist
            if (!empty($customer->images)) {
                $imagePath = public_path($customer->images);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $customer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Customer deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }
}
