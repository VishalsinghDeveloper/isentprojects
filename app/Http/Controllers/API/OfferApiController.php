<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Templates;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class OfferApiController extends Controller
{
    public function sendOffer(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required',
                'customers' => 'required',
            ]);
            $customerIds = explode(',', $request->input('customers'));
            foreach ($customerIds as $customerId) {
                $offerCustomer = new Offer();
                $offerCustomer->description = $request->input('description');
                $offerCustomer->cust_id = $customerId;
                $offerCustomer->user_id = Auth::user()->id;
                $offerCustomer->save();
            }
            return response()->json([
                'status' => true,
                'message' => 'Offer sent successfully'
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
