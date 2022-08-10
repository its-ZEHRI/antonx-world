<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Models\User;
use App\Models\UserDesignation;

class UserCompanyController extends Controller
{
    public function userCompany_form(Request $request)
    {

        $data['page_title'] = "User Company Form";
        $data['designations'] = UserDesignation::get();
        if (isset($request->id)) {
            $data['userCompany'] =  UserCompany::where('id', $request->id)->get()[0];
            $data['user'] = false;
        } else {
            $data['user'] = User::where('id', $request->user_id)->get()[0];
            $data['userCompany'] = false;
        }

        return view('user.userCompany_form.userCompany_form', $data);
    }

    public function save_userCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designation' => 'required',
            'startDate' => 'required',
            'user_id' => 'required',
        ]);

        $user = [];
        if (!$request->id) {
            $user = UserCompany::where('user_id', $request->user_id)
                ->where('designation', $request->designation)->get();
        }

        if (count($user) > 0) {
            $response['status'] = "Failure!";
            $response['result'] =  "This Designation is already added for this user.";
        } else {
            if ($validator->passes()) {

                $designation = UserDesignation::find($request->designation);
                $startDate = date('Y-m-d', strtotime($request->startDate));
                $endDate = null;
                if ($request->endDate) {
                    $endDate = date('Y-m-d', strtotime($request->endDate));
                }

                $user_company = [
                    'designation' => $designation->title,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'user_id' => $request->user_id,
                ];
                if (isset($request->id)) {
                    $user_company['updated_by'] =  $request->user_id;
                    UserCompany::where('id', $request->id)->update($user_company);
                } else {
                    $user_company['created_by'] =  $request->user_id;
                    UserCompany::create($user_company);
                    if ($request->currently_working == 'on') {
                        User::where('id', $request->user_id)->update(['designation_id' => $request->designation]);
                    }
                }
                $response['status'] = "Success";
                $response['result'] = "Added Successfully";
            } else {
                $response['status'] = "Failure!";
                $response['result'] =  $validator->errors()->toJson();
            }
        }
        return response()->json($response);
    }
}
