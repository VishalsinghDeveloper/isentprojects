<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::where('role', 0)->get();
        return view('admin.pages.notification.send', ['user' => $user]);
    }
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',

        ]);
        $userid = $request->input('users');
        if (empty($userid)) {
            return redirect()->back()->with('error', 'Please select at least one user.');
        }
        foreach ($userid as $userid) {
            $notifications = new Notification();
            $notifications->title = $request->input('title');
            $notifications->message = $request->input('message');
            $notifications->user_id = $userid;
            $notifications->save();
        }
        return redirect()->route('notification-index')->with('success', 'Notification sent successfully');
    }
    public function list()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();

        $uniqueNotifications = $notifications->groupBy(function ($notification) {
            return $notification->created_at->toDateTimeString();
        })->map(function ($group) {
            return $group->first();
        });
        $userCounts = $uniqueNotifications->pluck('message')->countBy();
        return view('admin.pages.notification.index', ['notifications' => $uniqueNotifications, 'userCounts' => $userCounts]);
    }
}
