<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $offers = Offer::orderBy('created_at', 'desc')->get();
        $userDetails = [];
        foreach ($offers as $offer) {
            $userId = $offer->user_id;
            if (!isset($userDetails[$userId])) {
                $user = User::findOrFail($userId);
                $userDetails[$userId] = [
                    'name' => $user->name,
                    'number' => $user->phone,
                    'total_customers' => 1,
                    'descriptions' => [$offer->description],
                ];
            } else {
                $userDetails[$userId]['total_customers']++;
                $userDetails[$userId]['descriptions'][] = $offer->description;
            }
        }

        return view('admin.pages.history.index', compact('offers', 'userDetails'));
    }

    public function view($id)
    {
        $offers = Offer::with('user', 'customer')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $uniqueOffers = $offers->groupBy(function ($offer) {
            return $offer->created_at->toDateTimeString();
        })->map(function ($group) {
            return $group->first();
        });

        $customerCounts = [];

        foreach ($offers as $offer) {
            $key = ($offer->description ?? '') . '|' . ($offer->created_at ?? '');
            if (!isset($customerCounts[$key])) {
                $customerCounts[$key] = 0;
            }
            $customerCounts[$key] += 1;
        }

        return view('admin.pages.history.index', compact('uniqueOffers', 'customerCounts'));
    }
}
