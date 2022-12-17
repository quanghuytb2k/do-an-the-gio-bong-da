<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Checkout;
use App\Commune;
use App\District;
use App\Order_product;
use Illuminate\Support\Str;
use App\Product;
use App\Province;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuynowController extends Controller
{
    function buynow(Request $request, $product_name){
        $products = Product::all();
        foreach($products as $product){
            if(Str::slug($product->name) == $product_name){
                $id = $product->id;
            }
        }
        $province = Province::all();
        $district = District::all();
        $commune = Commune::all();
        $product = Product::find($id);
        return view('buy-now.buy_now',compact('province','commune','product'));
    }
    function checkout_action2(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|min:5',

            'phone_number'=>'required',
            'note'=>'required',
            'province'=>'required',
            'district'=>'required',
            'commune'=>'required',
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
                'province'=>'tỉnh',
            'district'=>'huyện',
            'commune'=>'xã',
            ],

            );

            Checkout::create([
                'code' => 'DT'.time(),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'addres' => $request->input('province').','.$request->input('district').','.$request->input('commune'),
                'phonenumber' => $request->input('phone_number'),
                'product'=>$request->input('name_product'),
                'soluong'=> 1,
                'payment'=>$request->input('payment'),
                'giatri'=>Cart::total(0,0,''),
                'status'=>"Đang xử lý",
            ]);
            $order_id = Checkout::max('id');
            foreach (Cart::content() as $item){
                DB::table('checkout_product')->insert([
                    'checkout_id'=> $order_id ,
                    'product_id'=> $item->id,
                ]);
            }

            return redirect('cart/checkout')->with('status','đã mua sản phẩm  thành công');
    }

}
