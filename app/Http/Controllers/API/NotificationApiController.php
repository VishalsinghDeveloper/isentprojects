<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;


class NotificationApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->id)->latest()->get();
        if ($notifications->isEmpty()) {
            return response()->json([
                'status' => false,
                'Message' => 'No Notifications found for this user',
                'notifications' => $notifications
            ], 200);
        }
        return response()->json([
            'status' => true,
            'Message' => "all Notifications Data",
            'notifications' => $notifications
        ], 200);
    }
}
