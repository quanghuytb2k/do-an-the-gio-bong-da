<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\OrderPitches;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(){
        return view('backend.admin.dashboard');
    }
}
