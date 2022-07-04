<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function create()
    {
        return view('backend.product.product');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
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
                'min' => ':attribute độ dài phải trên 5 ký tự'
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
}
