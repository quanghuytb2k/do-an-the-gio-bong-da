<?php

namespace App\Http\Controllers\admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
session_start();

class CouponController extends Controller
{
    //
    function index(Request $request){
        $keyword ="";
        if($request->input('keyword')){
            $keyword =$request->input('keyword');
        }
        $coupon=Coupon::where('name','LIKE',"%{$keyword}%")->paginate(5);
        return view('backend.coupon.index', with(compact('coupon')));
    }

    function create(){
        return view('backend.coupon.create');
    }

    function store(Request $request){
            $data = $request->all();
            Coupon::create($data);
            return redirect()->route('coupon.index')->with('status','đã thêm bản ghi thành công');
    }

    function checkCoupon(Request $request){
        $data = $request->input('coupon');
        $coupon = Coupon::where('code',$data)->first();
        // dd($coupon);
        if($coupon){
            $coupon_session = Session::get('coupon');
            // dd($coupon_session);
                $cou = [
                    'coupon_id' => $coupon->id,
                    'coupon_code' => $coupon->code,
                    'coupon_condition' => $coupon->condition,
                    'coupon_feature' => $coupon->feature
                ];
            Session::put('coupon',$cou);
            Session::save();
            return redirect()->back()->with('status','Thêm mã thành công');
        }
        else {
            return redirect()->back()->with('status','Thêm mã không thành công');
        }

    }

    function delete(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
        }
        return redirect()->back()->with('status','xóa mã giảm giá thành công');
    }
}
