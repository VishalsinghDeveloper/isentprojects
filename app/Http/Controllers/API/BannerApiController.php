<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Exception;

class BannerApiController extends Controller
{
    public function index()
    {
        try {
            $banners = Banner::where('status', 1)->get();
            return response()->json([
                'status' => true,
                'message' => 'all Banners Data',
                'banners' => $banners
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
