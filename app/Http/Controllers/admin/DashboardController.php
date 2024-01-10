<?php

namespace App\Http\Controllers\admin;

use App\Checkout;
use App\Http\Controllers\Controller;
use App\OrderPitches;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function dashboard(){
        if(auth()->user()->role == User::USER_ADMIN_ROLE){
            $count_orders_process = OrderPitches::where('status', OrderPitches::STATUS_SUCCESS)->count();
            $count_orders_transport = OrderPitches::where('status', OrderPitches::STATUS_NO_PAY)->count();
            $count_orders_success= OrderPitches::count();
            $proceeds = OrderPitches::where('status', OrderPitches::STATUS_SUCCESS)->sum('price');
        }else{
            $order = OrderPitches::whereHas('pitches', function($q){
                $q->where('user_id', auth()->user()->id);
            });
            $count_orders_process = (clone $order)->where('status', OrderPitches::STATUS_SUCCESS)->count();
            $count_orders_transport = (clone $order)->where('status', OrderPitches::STATUS_NO_PAY)->count();
            $count_orders_success= (clone $order)->count();
            $proceeds = (clone $order)->where('status', OrderPitches::STATUS_SUCCESS)->sum('price');
        }
        $count = [$count_orders_process, $count_orders_transport, $count_orders_success];
        return view('backend.admin.dashboard', compact('count_orders_process', 'count_orders_transport','count_orders_success','proceeds'));
    }
    function dashboard2(){
        return view('backend.admin.dashboard2');
    }
    function __construct(){
        $this->middleware(function($request, $next){
            $user = auth()->user();
            $now = strtotime("today");
            $validUntil = strtotime($user->valid_until);
            $dateDiff = $validUntil - $now;
            $dayOfDataDiff = round($dateDiff / (60 * 60 * 24));

            if($dayOfDataDiff <= 7){
                session(['jsAlert'=>'Tài khoản của bạn sẽ hạn hạn trong '.$dayOfDataDiff . ' ngày nữa vui lòng gia hạn để tiếp tục sử dụng dịch vụ']);
            }else if($dayOfDataDiff <= 0){
                return redirect('login');
            }
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
