<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public $successStatus = 200;

    use AuthenticatesUsers;
    public function login_by_api(Request $request)
    {
        $atn = request('atn_number');
        $pass = request('password');

        $user = User::where('atn_number', '=', $atn)->first();
        if ($user) {
            if ($atn != $user->atn_number) {
                return response()->json(['success' => false, 'error' => 'ATN number dose match', 'body' => null], 401);
            } elseif (!Hash::check($pass, $user->password)) {
                return response()->json(['success' => false, 'error' => 'Password dose not match', 'body' => null], 401);
            } elseif (Auth::attempt(['atn_number' => $atn, 'password' => $pass])) {
                $user = Auth::user();
                $token =  $user->createToken('MyAPI')->accessToken;
                return response()->json(['success' => true, 'error' => null, 'body' => ['access_token' => $token, 'user_info' => $user]], $this->successStatus);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'User not found', 'body' => null], 401);
        }
    }



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'atn_number';
    }
}
