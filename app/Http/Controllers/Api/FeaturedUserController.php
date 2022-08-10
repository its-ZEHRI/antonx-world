<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\FeaturedUser;

class FeaturedUserController extends Controller
{
    public function index()
    {
        // yesterday date 
        $startDate = date('Y-m-d', strtotime('-1 days'));
        // last 30th (30 days) date from now 
        $endDate = date('Y-m-d', strtotime('-31 days'));

        $featured_users = FeaturedUser::with('user')
            ->whereDate('created_at', '>', $endDate)
            ->orderBy('id', 'DESC')->get();
        $events = Event::with(['attendees', 'attendees.user'])
            ->whereDate('created_at', '>', $endDate)
            ->orderBy('date', 'ASC')->get();

        return response()->json(['success' => true, 'error' => null, 'body' => ['featured_users' => $featured_users, 'events' => $events]], 200);
    }
}
