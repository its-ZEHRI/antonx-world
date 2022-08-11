<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Console\Command;

class UserCheckinUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserCheckinUpdate:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check isCheckin is updated or not if not then false it.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereNot('id', 1)->where('job_type', '!=', 'Remote')->where('isCheckin',1)
            ->select('id')->get();
        foreach ($users as $user)  {
            $user_attendance = Attendance::where('user_id',$user->id)->first();
            $total_time = difference_bwt_two_times($user_attendance->check_in_time, '17:00:00');
            $total_hours_inSec = convert_time_seconds($total_time);
            Attendance::where('user_id',$user->id)->update([
                'check_out_time'=>'17:00:00',
                'total_logged_hours' => $total_time,
                'total_hours_inSec' => convert_time_seconds($total_time),
                'attendance_status' => 1
                ]);

        }
        $users = User::where('isCheckin' ,1)->get();
        foreach( $users as $user){
            User::where('id', $user->id)->update(['isCheckin' => 0]);
        }
    }
}
