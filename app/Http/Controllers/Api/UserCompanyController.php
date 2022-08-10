<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserCompany;


class UserCompanyController extends Controller
{
   
    public function save_user_company(Request $request)
    {
        $usr = User::find($request->user()->id);
        if (!$usr) {
            return response()->json([
                'success' => false, 'error' => "User Not found",
                'body' => null
            ]);
        }
        if (!$request->designation) {
            return response()->json([
                'success' => false, 'error' => "Please provide your Designation",
                'body' => null
            ]);
        }
        $validator = Validator::make($request->all(), [
            'designation' => 'required',
            'startDate' => 'required',
        ]);

        $user = UserCompany::where('user_id', $request->user()->id)->where('designation', $request->designation)->get();

        if (count($user) > 0) {
            return response()->json([
                'success' => false, 'error' => "This Designation is already  added!",
                'body' => null
            ], 401);
        }

        if ($validator->passes()) {

            $startDate = date('Y-m-d', strtotime($request->startDate));
            $endDate = null;
            if ($request->endDate) {
                $endDate = date('Y-m-d', strtotime($request->endDate));
            }

            $user_company = [
                'designation' => $request->designation,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'user_id' => $request->user()->id,
            ];
            if (isset($request->id)) {
                $user_company['updated_by'] =  $request->user()->id;
                UserCompany::where('id', $request->id)->update($user_company);
            } else {
                $user_company['created_by'] =  $request->user()->id;
                UserCompany::create($user_company);
            }
            return response()->json([
                'success' => true, 'error' => null,
                'body' => 'Added successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false, 'error' => $validator->errors()->first(),
                'body' => null
            ], 401);
        }
    }
}
