<?php

namespace App\Http\Controllers;

use App\Models\UserDesignation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class UserDesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index()
    {
        $data['page_title'] = "AntonX User Designation";
        $data['designations'] = UserDesignation::with(['createdBy'])->get();
        return view('user_designation.user_designation', $data);
    }
    public function designation_form(Request $request)
    {
        $data['page_title'] = "User Designation Form";
        if (isset($request->id)) {
            $data['designation'] =  UserDesignation::where('id', $request->id)->get()[0];
        } else {
            $data['designation'] = false;
        }

        return view('user_designation.user_designation_form', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:user_designations,title,' . $request->id,
        ]);
        if ($validator->passes()) {

            $designation_data = [
                'title' => $request->title,
                'slug' =>  slugify($request->title),
            ];

            if (isset($request->id)) {
                $designation_data['updated_by'] = Auth::user()->id;
                UserDesignation::where('id', $request->id)->update($designation_data);
            } else {
                $designation_data['created_by'] = Auth::user()->id;
                UserDesignation::create($designation_data);
            }
            $response['status'] = "Success";
            $response['result'] = "Added Successfully";
        } else {
            $response['status'] = "Failure!";
            $response['result'] =  $validator->errors()->toJson();
        }
        return response()->json($response);
    }

    public function deleted_list()
    {
        $data['page_title'] = "AntonX User Designation";
        $data['designations'] = UserDesignation::withTrashed()->whereNot('deleted_at', null)->get();

        return view('user_designation.deleted_list', $data);
    }

    public function restore_deleted_record(Request $request)
    {
        $user_des = UserDesignation::withTrashed()->where('id', $request->id);
        if ($user_des) {
            UserDesignation::withTrashed()->where('id', $request->id)->restore();
            $response['status'] = "Success";
            $response['result'] = "Data restored Successfully";
        } else {
            $response['status'] = "failure";
            $response['result'] = "Data restoration denied for this user!";
        }

        return response()->json($response);
    }

    public function delete_permanently(Request $request)
    {
        $user_des = UserDesignation::withTrashed()->find($request->id);
        $user_des->forceDelete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";

        return response()->json($response);
    }

    public function delete(Request $request)
    {
        UserDesignation::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
