<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUsers;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['page_title'] = "AntonX User Attendance List";
        $data['attendance'] = Attendance::orderBy('id', 'DESC')->with('user')->get();


        $users = User::whereNot('id', 1)->where('job_type', '!=', 'Remote')
            ->select('id')->get();

        return view('attendance.attendance_list', $data);
    }

    // Only view list of a Current logged in User;
    public function single_user_attendance_list()
    {
        $data['page_title'] = "AntonX- User Attendance";
        $data['user'] = User::with('attendances')->whereNotIn('id', array(1))->find(Auth::user()->id);

        return view('attendance.user_attendance', $data);
    }

    public function attendance_form(Request $request)
    {
        $data['page_title'] = "User Attendance Form";
        $data['users'] = User::whereNotIn('id', array(1))->get();
        if (isset($request->id)) {
            $data['attendance'] =  Attendance::where('id', $request->id)->get()[0];
        } else {
            $data['attendance'] = false;
        }

        return view('attendance.attendance_form', $data);
    }

    // mark Attendance by Admin
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'user_id' => 'required',
            'check_in_time' => 'required',
        ]);
        // this function has been define in App/my_helper.php library it show the difference btw two times 
        $total_time = difference_bwt_two_times($request->check_in_time, $request->check_out_time);
        if ($validator->passes()) {
            $data = [
                'date' => $request->date,
                'user_id' => $request->user_id,
                'check_in_time' => $request->check_in_time,
                'check_out_time' => $request->check_out_time,
                'total_logged_hours' => $total_time,
                'total_hours_inSec' => convert_time_seconds($total_time),
                'day' => date('l', strtotime($request->date)),
                'month' => date("F", strtotime($request->date)),
            ];
            if ($request->check_in_time && $request->check_out_time) {
                $data['attendance_status'] = 1;
            }
            if (isset($request->id)) {
                $data['updated_by'] = Auth::user()->id;
                Attendance::where('id', $request->id)->update($data);
            } else {
                $data['created_by'] = Auth::user()->id;
                Attendance::create($data);
            }
            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response['status'] = 'failure';
            $response['result'] = $validator->errors();
        }
        return response()->json($response);
    }

    // mark Attendance by user
    public function user_mark_attendance(Request $request)
    {
        $response['status'] = 'failure';
        $response['result'] = "This Route is down by the admin, \n Please Check in/out by Mobile.";
        return response()->json($response);
        // $key = QrcodeAccessKey::find(1);
        // $user = User::find($request->user_id);

        /*    if ($request->qr_access_key != $key->access_key) {
            return response()->json(['success' => false, 'error' => "Qr code access key expired"], 401);
        }

        if ($user == null) {
            return response()->json(['success' => false, 'error' => 'User Not found'], 401);
        }

        if ($request->isCheckin) {

            $check = Attendance::whereDate('date', get_date())->where('user_id', $user->id)
                ->whereNotNull('check_in_time')->get();

            if (count($check) > 0) {
                return response()->json([
                    'success' => false, 'error' => 'You already checked-in for today!'
                ], 401);
            }

            $data = [
                'date' => get_date(),
                'user_id' => $user->id,
                'check_in_time' => get_time(),
                'day' => date('l', strtotime(get_date())),
                'month' => date("F", strtotime(get_date())),
                'attendance_status' => 1,
            ];

            $data['created_by'] = $user->id;

            Attendance::create($data);

            return response()->json([
                'success' => 'You have checked-In Successfully', 'error' => null
            ], 200);
        }
        if (!$request->isCheckin) {

            $check = Attendance::where('user_id', $user->id)->whereDate('date', get_date())
                ->where('check_in_time', '!=', null)->whereNotNull('check_out_time')
                ->get();

            if (count($check) > 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'You have already checked-Out for Today'
                ], 401);
            }

            $attend = Attendance::select('date', 'id', 'check_in_time')
                ->where('user_id', $user->id)->whereDate('date', '=', get_date())->get();
            if(count($attend) >0 ){

            
            $check_in_time = $attend->first()->check_in_time;
            $check_out_time = get_time();
            $total_today_hours = difference_bwt_two_times($check_in_time, $check_out_time);

            $data['check_out_time'] = get_time();
            $data['total_logged_hours'] = $total_today_hours;
            $data['total_hours_inSec'] = convert_time_seconds($total_today_hours);
            $data['attendance_status']  = 0;
            $data['updated_by'] = $user->id;

            Attendance::where('id', $attend->first()->id)
                ->where('date', $attend->first()->date)->update($data);
            
            return response()->json([
                'success' => 'You have checked-Out Successfully', 'error' => null
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'error' => 'You haven`t Checked in please Check-In!'
            ], 401);

        }
        }*/
    }

    // It will soft delete the requested attendance.
    public function delete(Request $request)
    {
        Attendance::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }

    // Export Users attendance report of a given month to n Excel sheet.
    public function export(Request $request)
    {
        if ($request->date != null) {

            $date = Carbon::createFromFormat('Y-m-d', $request->date);
            $month_name = date('F', strtotime($date));
            $monthly_working_hours = get_month_days($date->month, $date->year) * 8;

            // show Users attendance statistic report
            $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
                ->whereMonth('date', $date->month)->whereYear('date', $date->year)
                ->whereColumn('user_id', 'users.id')
                ->getQuery();

            $users = User::with('attendances')
                ->whereNotIn('id', array(1))->select('users.*')
                ->selectSub($current_hours, 'seconds')
                ->orderBy('seconds', 'desc')
                ->get();

            $data = [
                'users' => $users,
                'monthly_working_hours' => $monthly_working_hours,
                'date' => $date
            ];
        }

        return Excel::download(new ExportUsers($data), 'AntonX_users_' . $month_name . '_attendance_report.xlsx');
    }
}
