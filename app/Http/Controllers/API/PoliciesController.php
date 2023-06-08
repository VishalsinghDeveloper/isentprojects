<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Policies;
use Illuminate\Http\Request;
use Exception;

class PoliciesController extends Controller
{
    public function index()
    {
        try {
            $policies = Policies::where('status', 1)->get();
            return response()->json([
                'status' => true,
                'message' => 'all Policies Data',
                'policies' => $policies
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
