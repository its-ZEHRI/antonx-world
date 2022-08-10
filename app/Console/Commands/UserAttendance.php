<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Null_;

class UserAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserAttendance:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will add date for those user who did not checked in and will be consider as absent for this day.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = User::whereNot('id', 1)->where('job_type', '!=', 'Remote')
            ->select('id')->get();

        foreach ($users as $user) {
            $present_users = Attendance::where('user_id', $user->id)->whereDate('date', get_date())->get();
            if (count($present_users) < 1) {
                $data = [
                    'date' => get_date(),
                    'user_id' => $user->id,
                    'check_in_time' => NULL,
                    'check_out_time' => NULL,
                    'total_hours_inSec' => 0,
                    'attendance_status' => 0,
                    'day' => date('l', strtotime(get_date())),
                    'month' => date("F", strtotime(get_date())),
                ];
                $data['updated_by'] = 1;
                $data['created_by'] = 1;
                Attendance::create($data);
            }
        }
    }
}
