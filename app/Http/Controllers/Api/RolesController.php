<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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
}
