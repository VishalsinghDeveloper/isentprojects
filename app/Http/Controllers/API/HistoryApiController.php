<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class HistoryApiController extends Controller
{
    public function getHistory()
    {

        try {
            $user = Auth::user();
            $offers = Offer::where('user_id', $user->id)
                ->with('customer')
                ->orderBy('created_at', 'desc')
                ->get();

            $offer = $offers->map(function ($data) {
                return [
                    'id' => $data->id,
                    'cust_id' => $data->cust_id,
                    'name' => $data->customer->first_name . ' ' . $data->customer->last_name,
                    'description' => $data->description,
                    'images' => $data->customer->images,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'All History Data',
                'history' => $offer
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }
}
