<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bill;
use App\Checkout;
use App\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Province;
use App\District;
use App\Commune;
use App\Product;
use App\Order_product;
use App\Checkout_product;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use Session;
use Mail;
class CheckoutController extends Controller
{
    //
    function checkout_add(){
        $provinces = Province::all();
            $districts = District::all();
            $communes = Commune::all();
            $coupon = Session::get('coupon');
            $array = [];
            $total_amount = 0;
            if(!empty(Session::get('coupon'))){
                $coupon_session = Session::get('coupon');
            $array = [
                $coupon_session ,
            ];
            // dd($array);
            foreach($array as $key=>$item){
                if($item['coupon_condition'] == 1){
                    $total = str_replace(',','',Cart::total());
                    $total_coupon = $total*$item['coupon_feature']/100;
                    $total_amount = $total-$total_coupon;
                }
                if($item['coupon_condition'] == 2){
                    $total = str_replace('.','',Cart::total());
                    $total_coupon = $item['coupon_feature'];
                    $total_amount = $total-$total_coupon;
                }
            }
            }
        return view('backend.cart.checkout',compact('provinces','districts','communes','total_amount'));
    }
    function checkout_action(Request $request){
        $request->validate([
            'name'=>'required|min:5',
            'email'=>'required|min:5',
            'phone_number'=>'required',
            'note'=>'required',
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute độ dài phải trên 5 ký tự'
            ],
            [
                'name'=>'Tiêu đề',
                'email'=>'email',
                'phone_number'=>'số điện thoại',
                'note'=>'ghi chú',
            ]

            );
            $order = Checkout::create([
                'code'=> 'DT'.time(),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'addres' => $request->input('province').','.$request->input('district').','.$request->input('commune'),
                'phonenumber' => $request->input('phone_number'),
                'product'=>$request->input('name_product'),
                'soluong'=> Cart::count(),
                'payment'=>$request->input('payment'),
                'giatri'=>Cart::total(0,0,''),
                'status'=>'đang sử lý',
                'coupon_id'=>$request->input('coupon_id'),
                "total_pay" => $request->input('total_pay'),
                "total_coupon" => $request->input('total_coupon'),
            ]);
            $coupon = Session::get('coupon');
            if($coupon == true){
                Session::forget('coupon');
            }
            $orderdetails= [];
            $order_id = Checkout::max('id');
            foreach (Cart::content() as $key=>$item){
               $orderdetails[$key] = Checkout_product::create([
                    'checkout_id'=> $order_id ,
                    'product_id'=> $item->id,
                    'qty'=> $item->qty ,
                ]);
            }
            Mail::to($order->email)->send(new SendMail($order,$orderdetails));
                Cart::destroy();
            return redirect('cart/checkout')->with('status','đã mua sản phẩm  thành công');
    }

    function district(Request $request){
        $province = $request->get('province');
        $select_district = '<option value="">-- Chọn Quận/Huyện --</option>';
        $matp = Province::where('name', $province)->get();
        $matp = $matp['0']->matp;
        if($matp){
            $list_district = District::where('matp', $matp)->get();
            foreach($list_district as $district){
                $select_district .= '
                <option value="'.$district->name.'">'.$district->name.'</option>';
            }
        }
        $data = $select_district;
        return response()->json($data);
    }
    function commune(Request $request){
        $commune = $request->get('commune');
        $select_commune = "<option value=''>-- chọn Xã/phường --</option>";
        $maqh = District::where('name',$commune)->get();
        $maqh = $maqh['0']->maqh;
        if($maqh){
            $list_commune = Commune::where('maqh',$maqh)->get();
            foreach($list_commune as $commune){
                $select_commune .=' <option value="'.$commune->name.'">'.$commune->name.'</option>
                ';
            }
        }$data = $select_commune;
        return response()->json($data);
    }
    function num_order(Request $request){
        $num_order = $request->get('num_order');
        // foreach($num_order as $k=>$v){
        //     Cart::update($k,$v);
        // }
        foreach (Cart::content() as $item){
            $total2 = $num_order * $item->price;
        }
        $data = number_format($total2,0,',','.').'đ';
        return response()->json($data);
    }
}
