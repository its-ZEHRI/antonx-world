<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;


class LeaderboardController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        // last 30th (30 days) date from now 
        $endDate = date('Y-m-d', strtotime('-31 days'));

        // show attendance statistic from now to last 30 days
        $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
            ->whereDate('date', '>', $endDate)
            ->whereColumn('user_id', 'users.id')
            ->getQuery();

        $users = User::with('user_streak')->whereNotIn('id', array(1))->select('users.*')
            ->selectSub($current_hours, 'seconds')
            ->orderBy('seconds', 'DESC')
            ->get();

        if (!$users) {

            return response()->json(['success' => false, 'error' => 'Data Not Available', 'body' => null], 401);
        
        } else {

            return response()->json(['success' => true, 'error' => null, 'body' => ['Users_data' => $users]], 200);
        }
    }

}
