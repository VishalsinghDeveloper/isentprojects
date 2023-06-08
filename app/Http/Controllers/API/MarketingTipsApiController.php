<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MarketingTips;
use Illuminate\Http\Request;
use Exception;

class MarketingTipsApiController extends Controller
{
    public function index()
    {
        try {
            $marketingTips = MarketingTips::latest()->get();
            return response()->json([
                'status' => true,
                'message' => "all marketing_tips Data",
                'marketing_tips' => $marketingTips
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 200);
        }
    }
}
