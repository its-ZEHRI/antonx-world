<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;
use Carbon\Carbon;

class RolesController extends Controller
{
    /**
     *
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index()
    {
        $data['page_title'] = "AntonX User Roles";
        $data['roles'] = UserRole::with(['created_by'])->get();
        return view('user_role.user_role', $data);
    }
    public function role_form(Request $request)
    {
        $data['page_title'] = "User Roles Form";
        if (isset($request->id)) {
            $data['role'] =  UserRole::where('id', $request->id)->get()[0];
        } else {
            $data['role'] = false;
        }

        return view('user_role.role_form', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:user_roles,title,' . $request->id,
        ]);
        if ($validator->passes()) {
            $check = [];
            //  UserRole::where('slug', slugify($request->title))->get();
            if (count($check) > 0) {
                $response['status'] = "Failure";
                $response['result'] = "Record Already Exists";
            } else {

                $role_data = [
                    'title' => $request->title,
                    'slug' =>  slugify($request->title)
                ];

                if (isset($request->id)) {
                    $role_data['updated_by'] = Auth::user()->id;
                    UserRole::where('id', $request->id)->update($role_data);
                } else {
                    $role_data['created_by'] = Auth::user()->id;
                    UserRole::create($role_data);
                }
                $response['status'] = "Success";
                $response['result'] = "Added Successfully";
            }
        } else {
            $response['status'] = "Failure!";
            $response['result'] =  $validator->errors()->toJson();
        }
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        UserRole::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
