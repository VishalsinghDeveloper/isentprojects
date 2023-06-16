<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Templates;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class OfferApiController extends Controller
{
    public function sendOffer(Request $request,$id)
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
            $var1 = $request->input('var1');
            $var2 = $request->input('var2');

            $template = Templates::find($id);
            $requestData = [
                'template_id' =>  $template->template_id,
                'sender' => $template->sender_id,
                'short_url' => '1', // 1 (On) or 0 (Off)
                'mobiles' => '919XXXXXXXXX',
                'VAR1' =>  $var1,
                'VAR2' => $var2,
            ];

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'authkey' => 'Enter your MSG91 authkey',
                'content-type' => 'application/json',
            ])->post('https://control.msg91.com/api/v5/flow/', $requestData);

            if ($response->successful()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Offer sent successfully',
                    'data' => $response->json(),
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to send offer',
                    'data' => $response->json(),
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }
}
