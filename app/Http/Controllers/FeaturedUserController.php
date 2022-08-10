<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\FeaturedUser;
use App\Models\User;

class FeaturedUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }
    public function index()
    {
        $data['page_title'] = "AntonX- Featured User List";
        $data['featured_users'] = FeaturedUser::orderBy('id', 'DESC')->get();
        return view('featured_user.featured_user_list', $data);
    }
    public function featured_user_form(Request $request)
    {
        $data['page_title'] = "User Attendance Form";
        $data['users'] = User::whereNotIn('id', array(1))->get();
        if (isset($request->id)) {
            $data['featured_user'] =  FeaturedUser::where('id', $request->id)->get()[0];
        } else {
            $data['featured_user'] = false;
        }
        return view('featured_user.featured_user_form', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'feature_date' => 'required',
            'feature_expire_date' => 'required',
            'badge_icon' => 'image|mimes:png,gif,jpeg,jpg,svg,|max:2048',
        ]);
        if ($validator->passes()) {
            $data = [
                'user_id' => $request->user_id,
                'title' => $request->title,
                'date' => $request->feature_date,
                'expire_date' => $request->feature_expire_date,
                'description' => $request->description,

            ];
            if ($request->file('badge_icon')) {
                $badge_icon = "";
                $file = $request->file('badge_icon');
                $badge_icon = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/images/featured_icons'), $badge_icon);
                $data['badge_icon'] =  request()->getSchemeAndHttpHost() . "/public/images/featured_icons/$badge_icon";
            }

            if (isset($request->id)) {
                $data['updated_by'] = Auth::user()->id;
                FeaturedUser::where('id', $request->id)->update($data);
            } else {
                $data['created_by'] = Auth::user()->id;
                FeaturedUser::create($data);
            }
            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response['status'] = 'failure';
            $response['result'] = $validator->errors();
        }
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        FeaturedUser::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
