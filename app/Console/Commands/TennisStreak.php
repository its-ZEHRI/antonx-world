<?php

namespace App\Console\Commands;

use App\Models\TableTennisGame;
use App\Models\TableTennisStreak;
use App\Models\User;
use Illuminate\Console\Command;

class TennisStreak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TennisStreak:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will count streak of tennis table matches daily!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*
        // yesterday date 
        $startDate = date('Y-m-d', strtotime('-1 days'));
        // last 30th (30 days) date from now 
        $endDate = date('Y-m-d', strtotime('-31 days'));

        // show attendance statistic from now to last 30 days
        $match_winner = TableTennisGame::selectRaw()
            ->whereDate('date', '>', $endDate)
            ->whereColumn('user_1_id', 'users.id')
            ->whereColumn('user_2_id', 'users.id')
            ->getQuery();

        $users = User::whereNotIn('id', array(1))->select('users.*')
            ->selectSub($match_winner, 'seconds')->orderBy('seconds', 'DESC')->get();

        // show attendance statistic from yesterday to last 30 days to calculate streak for the users
        $recent_hours = TableTennisGame::selectRaw()
            ->whereColumn('user_id', 'users.id')->whereDate('date', '<', $startDate)
            ->whereDate('date', '>', $endDate)->getQuery();

        $users_2 = User::whereNotIn('id', array(1))->select('users.*')
            ->selectSub($recent_hours, 'seconds')->orderBy('seconds', 'DESC')->get();

        foreach ($users as $key => $user_list_1) {
            $current_position = $key;
            foreach ($users_2 as $val => $user_list_2) {
                if ($user_list_1->id == $user_list_2->id) {
                    $streak = TableTennisStreak::where('user_id', $user_list_2->id)->get();
                    $last_position = $val;
                    if ($current_position == $last_position) {
                        TableTennisStreak::where('id', $streak->first()->id)->where('user_id', $user_list_2->id)->update([
                            'streak' => $streak->first()->streak + 1,
                            'streak_up' => 0,
                            'streak_down' => 0
                        ]);
                    } elseif ($current_position < $last_position) {
                        TableTennisStreak::where('id', $streak->first()->id)->where('user_id', $user_list_2->id)->update([
                            'streak' => 0,
                            'streak_up' => $current_position,
                            'streak_down' => 0
                        ]);
                    } elseif ($current_position > $last_position) {
                        TableTennisStreak::where('id', $streak->first()->id)->where('user_id', $user_list_2->id)->update([
                            'streak' => 0,
                            'streak_up' => 0,
                            'streak_down' => $current_position,
                        ]);
                    } else {
                        TableTennisStreak::where('user_id', $user_list_1->id)->update([
                            'streak' => 0,
                            'streak_up' => 0,
                            'streak_down' => 0,
                        ]);
                    }
                }
            }
        }
        */
    }
}
