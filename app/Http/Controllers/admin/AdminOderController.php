<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Checkout;
use Illuminate\Http\Request;

class AdminOderController extends Controller
{
    //
    function admin_order(Request $request , $id){
        $order = Checkout::find($id);
        $coupon = Checkout::find($id)->coupons;
        return view('backend.admin-order.admin_order',compact('order'));
    }

    function update_order(Request $request, $id){
        $order_update = Checkout::find($id);
        Checkout::where('id',$id)->update([
            'status'=>$request->input('status'),
        ]);
        return redirect('admin_order/'.$id)->with('status','đã sửa bản ghi thành công');
    }
}
