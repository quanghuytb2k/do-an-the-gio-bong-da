<?php

namespace App\Http\Controllers;

use App\Pitches;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }
    public function service(){
        $stadiums = Pitches::all();
        return view('frontend.service', compact('stadiums'));
    }
}
