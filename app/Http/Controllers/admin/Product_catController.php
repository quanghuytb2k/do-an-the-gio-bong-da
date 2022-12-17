<?php

namespace App\Http\Controllers;
use App\Product_cats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Product_catController extends Controller
{
    //
    function product_cat(){
        $product_cat= Product_cats::all();
        $cats= data_tree($product_cat);
        return view("product.product_cat",compact("product_cat", "cats"));
    }
    function addproduct_cat(Request $request){
        $request->validate([
            'name' => 'required|unique:product_cats|string|max:255',
            'parent_id' => 'required',
        ],
        [
            'required'=>':attribute không được để trống',
            'min' => ':attribute có độ dài ít nhất :min',
            'max' => ':attribute có độ dài lớn nhất :max',
            'confirmed' => 'Xác nhận mật khẩu không thành công',
            'unique' => ':attribute đã tồn tại trong hệ thống!'
        ],
        [
            'name'=> 'Tiêu đề danh mục',
            'parent_id' => 'Danh mục cha',
        ]
    );
        Product_cats::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
        ]);
        return redirect('product_cat')->with('status', 'Đã thêm danh mục sản phẩm thành công!');
    }
}
