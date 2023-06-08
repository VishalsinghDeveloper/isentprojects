<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Notification;
use App\Models\Templates;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // $selectedDate = $request->input('selected_date');
        $usercount = User::where('role', 0)->count();
        $templateCount = Templates::count();
        $offerCount = Offer::whereDate('created_at', now())->count();

        return view('admin.pages.dashboard.dashboard', [
            'usercount' => $usercount,
            // 'selectedDate' => $selectedDate,
            'offerCount' => $offerCount,
            'templateCount' => $templateCount
        ]);
    }
}
