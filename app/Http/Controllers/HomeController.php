<?php

namespace App\Http\Controllers;

use App\Pitches;
use App\Product;
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
        $fiveStars = Pitches::limit(6)->get();
        $product = Product::limit(6)->get();
        return view('frontend.index', compact('fiveStars', 'product'));
    }
    public function service()
    {
        $stadiums = Pitches::all();
        return view('frontend.service', compact('stadiums'));
    }
    public function product()
    {
        $products = Product::all();
        return view('frontend.product', compact('products'));
    }
    public  function  detail($id)
    {
        $pitches = Pitches::where('id', $id)->get();
        $times = Pitches::find($id)->pitchBookingTimes;
        foreach ($times as $item) {
            $day_year = $item->day_year;
        }
        //        dd($pitches);
        return view('frontend.detail', compact('pitches', 'times', 'day_year'));
    }
}
