<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserLink;

class UserLinkController extends Controller
{

    public function save_user_link(Request $request)
    {
        if (!$request->social_profile_link) {
            return response()->json([
                'success' => false, 'error' => "Please provide valid link",
                'body' => null
            ], 401);
        }
        $validator = Validator::make($request->all(), [
            'social_profile_link' => 'required|unique:user_links,social_profile_link,' . $request->id,
            'site_name' => 'required',
        ]);

        $user = UserLink::where('user_id', $request->user()->id)->where('social_profile_link', $request->social_profile_link)->get();

        if (count($user) > 0) {
            return response()->json([
                'success' => false, 'error' => "This Site Link is already  added!",
                'body' => null
            ], 401);
        }

        if ($validator->passes()) {

            $user_links = [
                'social_profile_link' => $request->link,
                'site_name' => $request->site_name,
                'user_id' => $request->user()->id,
            ];
            if (isset($request->id)) {
                $user_links['updated_by'] =  $request->user()->id;
                UserLink::where('id', $request->id)->update($user_links);
            } else {
                $user_links['created_by'] =  $request->user()->id;
                UserLink::create($user_links);
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
