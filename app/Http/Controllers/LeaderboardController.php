<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\FeaturedUser;
use App\Models\QrcodeAccessKey;
use App\Models\User;

class LeaderboardController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $featured_users = FeaturedUser::with('user')->whereDate('expire_date' ,'>', get_date())->get();

        // yesterday date 
        $startDate = date('Y-m-d', strtotime('-1 days'));
        // last 30th (30 days) date from now 
        $endDate = date('Y-m-d', strtotime('-31 days'));
        // show attendance statistic from now to last 30 days
        $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
            ->whereDate('date', '>', $endDate)->whereDate('date', '<', get_date())
            ->whereColumn('user_id', 'users.id')
            ->getQuery();
        $users = User::with('user_streak')->whereNotIn('id', array(1))->select('users.*')
            ->selectSub($current_hours, 'seconds')
            ->orderBy('seconds', 'DESC')
            ->get();




        $access_token = QrcodeAccessKey::select('access_key')->where('id', 1)->get()[0];
        $data = ['users' => $users, 'featured_users' => $featured_users, 'access_token' => $access_token];

        return view('leaderboard.leaderboard', $data);
    }
}
