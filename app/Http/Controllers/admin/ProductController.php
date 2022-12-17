<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Product_cats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    //
    function list(){
        $product = Product::all();
        return view('backend.product.list-product', compact('product'));
    }
    function create()
    {
        return view('backend.product.product');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'content' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'old_price' => 'required',
            'trademake' => 'required',
            'origin' => 'required',
            'size' => 'required',
            'type_sole' => 'required',
            'code' => 'required'
        ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute độ dài phải trên 3 ký tự'
            ],
            [
                'name' => 'Tiêu đề',
                'content' => 'Nội dung',
                'price' => 'giá',
                'amount' => 'số lượng',
                'code' => 'mã sản phẩm',
                'trademake' => 'thuong hieu',
                'origin' => 'xuat xu',
                'size' => 'kich co',
                'type_sole' => 'loai de giay'
            ]

        );
//        $input = $request->all();
        // return $request->input();
//        echo "helod";
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            echo $filename;
            $thumbnail = "uploads/" . $filename;
            $file->move('public/uploads/', $file->getClientOriginalName());

        }
        Product::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'content' => $request->input('content'),
            'price' => $request->input('price'),
            'old_price' => $request->input('old_price'),
            'thumbnail' => $thumbnail,
            'amount' => $request->input('amount'),
            'cat_id' => $request->input('cat'),
            'trademake' => $request->input('trademake'),
            'size' => $request->input('size'),
            'origin' => $request->input('origin'),
            'type_sole' => $request->input('type_sole')

        ]);
        return redirect('add-product')->with('status', 'thêm bài viết thành công');

    }

    function edit($id){
        $product = Product::where('id', $id)->get();
        return view('backend.product.edit-product', compact('product'));
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:3',
            'content' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'old_price' => 'required',
            'trademake' => 'required',
            'origin' => 'required',
            'size' => 'required',
            'type_sole' => 'required',
            'code' => 'required'
        ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute độ dài phải trên 3 ký tự'
            ],
            [
                'name' => 'Tiêu đề',
                'content' => 'Nội dung',
                'price' => 'giá',
                'amount' => 'số lượng',
                'code' => 'mã sản phẩm',
                'trademake' => 'thuong hieu',
                'origin' => 'xuat xu',
                'size' => 'kich co',
                'type_sole' => 'loai de giay'
            ]

        );
//        $input = $request->all();
        // return $request->input();
//        echo "helod";
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            echo $filename;
            $thumbnail = "uploads/" . $filename;
            $file->move('public/uploads/', $file->getClientOriginalName());

        }
        Product::where('id', $id)->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'content' => $request->input('content'),
            'price' => $request->input('price'),
            'old_price' => $request->input('old_price'),
            'thumbnail' => $thumbnail,
            'amount' => $request->input('amount'),
            'cat_id' => $request->input('cat'),
            'trademake' => $request->input('trademake'),
            'size' => $request->input('size'),
            'origin' => $request->input('origin'),
            'type_sole' => $request->input('type_sole')
        ]);
        return redirect('list-product')->with('status','đã sửa bản ghi thành công');
    }



    function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('list-product')->with('status','xoa san pham thanh cong');
    }

    function action(Request $request){
        $list_check = $request->input('list_check');

        if($list_check){


            $act = $request->input('act');
            if($act =='delete'){
                Product::destroy($list_check);
                return redirect('admin/product/list')->with('status','Bạn xóa thành công ');
            }
            if($act =='restore'){
                Product::withTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                return redirect('admin/product/list')->with('status','Bạn đã khôi phục thành công ');
            }
            if($act == 'forceDelete'){
                Product::withTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                return redirect('admin/product/list')->with('status','bạn đã xõa vĩnh viễn tài khoản thành công');
            }


        }
        else{
            return redirect('admin/product/list')->with('status','bạn cần chọn phần tử để thực hiện');
        }

    }

    function show_product(){
        $products = Product::where('old_price','!=',NULL)->orderBy('id','desc')->get();
        $products_best = Product::where('old_price','!=',NULL)->orderBy('id','desc')->limit(8)->get();
        $product_cats = Product_cats::where('parent_id','=',NULL)->get();
        $cats = Product_cats::all();
        return view('welcome',compact('products','products_best','product_cats','cats'));

    }
    function detail_product($id){
        $products = Product::find($id);


        return view('backend.product.detail_product',compact('products'));
    }

    function list_filter(){
        $products = Product::where('old_price','!=',NULL)->orderBy('id','desc')->get();
        $products_best = Product::where('old_price','!=',NULL)->orderBy('id','desc')->limit(8)->get();
        $product_cats = Product_cats::where('parent_id','=',NULL)->get();
        $cats = Product_cats::all();
        return view('product.list-product',compact('products','products_best','product_cats','cats'));
    }
    function list_filter_products(Request $request){
        $price = $request->input('r-price');
        if($price == 0){
            $products = Product::all()->simplePaginate(2);
        }
        if($price == 1){
            $products = Product::where('price','<',5000000)->orderBy('id','desc')->simplePaginate(2);
        }
        if($price == 2){
            $query[] = ['price', '>=', 500000];
            $query[] = ['price', '<', 1000000];
            $products = Product::where($query)->orderBy('id','desc')->simplePaginate(2);
        }
        if($price == 3){
            $query[] = ['price', '>=', 1000000];
            $query[] = ['price', '<', 5000000];
            $products = Product::where($query)->orderBy('id','desc')->simplePaginate(2);
        }
        if($price == 4){
            $query[] = ['price', '>=', 5000000];
            $query[] = ['price', '<', 10000000];
            $products = Product::where($query)->orderBy('id','desc')->simplePaginate(2);
        }
        if($price == 5){
            $query[] = ['price', '>', 10000000];
            $products = Product::where($query)->orderBy('id','desc')->simplePaginate(2);
        }
        //  dd($products);
        return view('product.list-product',compact('products'));
    }
}
