<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserEducation;

class UserEducationController extends Controller
{

    public function save_user_education(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'degree' => 'required',
            'institute' => 'required',
            'startDate' => 'required',
        ]);

        $user = UserEducation::where('user_id', $request->user()->id)->where('degree', $request->degree)
            ->where('institute', $request->institute)->get();

        if (count($user) > 0) {
            return response()->json([
                'success' => false, 'error' => "This record is already added!",
                'body' => null
            ], 401);
        }

        if ($validator->passes()) {

            $startDate = date('Y-m-d', strtotime($request->startDate));
            $endDate = null;
            if ($request->endDate) {
                $endDate = date('Y-m-d', strtotime($request->endDate));
            }

            $user_education = [
                'degree' => $request->degree,
                'institute' => $request->institute,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'user_id' => $request->user()->id,
            ];
            if (isset($request->id)) {
                $user_education['updated_by'] =  $request->user()->id;
                UserEducation::where('id', $request->id)->update($user_education);
            } else {
                $user_education['created_by'] =  $request->user()->id;
                UserEducation::create($user_education);
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
