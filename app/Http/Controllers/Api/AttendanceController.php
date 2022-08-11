<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\QrcodeAccessKey;
use App\Models\User;

class AttendanceController extends Controller
{
    //this function will be define for QR scan base check in and check out
    public function check_in_check_out(Request $request)
    {
        // dd($request->all());
        $key = QrcodeAccessKey::find(1);
        $user = User::find($request->user()->id);
        if ($request->qr_access_key != $key->access_key) {
            return response()->json(['success' => false, 'error' => "Qr code access key expired"], 401);
        }

        if ($user == null) {
            return response()->json(['success' => false, 'error' => 'User Not found'], 401);
        }

        if ($request->isCheckin) {

            $check = Attendance::whereDate('date', get_date())->where('user_id', $user->id)
                ->whereNotNull('check_in_time')->get();

            // return response()->json(['data'=> $check]);

            if (count($check) > 0) {
                return response()->json([
                    'success' => false, 'error' => 'You already checked-in for todayyyy!'
                ], 401);
            }

            $data = [
                'date' => get_date(),
                'user_id' => $user->id,
                'check_in_time' => get_time(),
                'day' => date('l', strtotime(get_date())),
                'month' => date("F", strtotime(get_date())),
                'attendance_status' => 0

            ];

            $data['created_by'] = $user->id;

            Attendance::create($data);
            User::where('id', $user->id)->update([
                'isCheckin' => true
            ]);

            return response()->json([
                'success' => true, 'error' => null
            ], 200);
        }
        if (!$request->isCheckin) {

            $check = Attendance::where('user_id', $user->id)->whereDate('date', get_date())
                ->where('check_in_time', '!=', null)->whereNotNull('check_out_time')
                ->get();

            if (count($check) > 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'You have already checked-Out'
                ], 401);
            }

            $attend = Attendance::select('date', 'id', 'check_in_time')
                ->where('user_id', $user->id)->whereDate('date', '=', get_date())->get();

            if (count($attend) > 0) {

                $check_in_time = $attend->first()->check_in_time;
                $check_out_time = get_time();
                $total_today_hours = difference_bwt_two_times($check_in_time, $check_out_time);

                $data['check_out_time'] = get_time();
                $data['total_logged_hours'] = $total_today_hours;
                $data['total_hours_inSec'] = convert_time_seconds($total_today_hours);
                $data['updated_by'] = $user->id;
                $data['attendance_status']  = 1;

                Attendance::where('id', $attend->first()->id)
                    ->where('date', $attend->first()->date)->update($data);
                User::where('id', $user->id)->update([
                    'isCheckin' => false
                ]);

                return response()->json([
                    'success' => true, 'error' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'You haven`t Checked-Out please Check-In first!'
                ], 401);
            }
        }
    }
}
