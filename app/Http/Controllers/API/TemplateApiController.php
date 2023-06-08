<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Templates;
use Illuminate\Http\Request;
use Exception;

class TemplateApiController extends Controller
{
    public function index()
    {
        try {
            $templates = Templates::where('status', 1)->get();
            return response()->json([
                'status' => true,
                'Message' => "all templates Data",
                'templates' => $templates
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
