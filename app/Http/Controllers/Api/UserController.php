<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role');
    }

    public function users_list(Request $request)
    {

        $users_list = User::select('id', 'name', 'image_url')->whereNot('id', '=', 1)->whereNot('id', '=', $request->user()->id)->get();

        if ($users_list) {

            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['users_list' => $users_list]
            ], 200);
        } else {

            return response()->json([
                'success' => false, 'error' => "Users are not found",
                'body' => null
            ], 401);
        }
    }

    public function find_user(Request $request)
    {
        $user = $request->user();
        $user_info = User::with([
            'education', 'company', 'user_social_links', 'week_attendances', 'featured_user'
        ])->find($user->id);


        if ($user_info) {

            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['user_info' => $user_info]
            ], 200);
        } else {

            return response()->json([
                'success' => false, 'error' => "User not found",
                'body' => null
            ], 401);
        }
    }

    public function user_profile(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user_additional_info = User::where('id', $user->id)
                ->with('education')
                ->with('user_social_links')
                ->with('company')
                ->with('featured_user')
                ->with('attendances')
                ->get();

            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['user_info' => $user_additional_info]
            ]);
        } else {

            return response()->json([
                'success' => false, 'error' => "User not found",
                'body' => null
            ]);
        }
    }
}
