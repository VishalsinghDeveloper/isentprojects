<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Exception;

class FAQApiController extends Controller
{
    public function index()
    {
        try {
            $faqs = FAQ::paginate(5);
            return response()->json([
                'status' => true,
                'Message' => "all Faqs Data",
                'faqs' => $faqs
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
