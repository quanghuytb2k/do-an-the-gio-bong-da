<?php

namespace App\Http\Controllers\admin;

use App\Checkout;
use App\Http\Controllers\Controller;
use App\OrderPitches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function dashboard(){
        return view('backend.admin.dashboard');
    }
    function dashboard2(){
        return view('backend.admin.dashboard2');
    }
    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active'=>'dashboard']);
            return $next($request);
        });
    }
//    function dashboard(){
//
//        return view('admin.dashboard');
//    }
    function detail(Request $request, $id){
        $order = Checkout::find($id);
        $order_product = Checkout::find($id)->products;
        $product_qty = DB::table('checkout_product')->where('checkout_id',$id)->get('qty');
        $qty = array();
        foreach($product_qty as $item){
            $qty[]=$item->qty;

        }
        $coupon = Checkout::find($id)->coupons;
        return view('backend.admin.detail',compact('order' , 'order_product','qty','coupon'));
    }
    function update_dashboard(Request $request, $id){
        Checkout::where('id',$id)->update([
            'status' => $request->input('status')
        ]);
        return redirect('detail_dashboard'.$id)->with('status', 'Cập nhật trạng thái thành công!');
    }
}
