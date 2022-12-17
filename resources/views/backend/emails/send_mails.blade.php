<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}} ">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/03vjjkv59uvqj4oy2r733miqbkspcof5omxzn0my2lwpia7j/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Admintrator</title>
</head>
<body>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content-detail" class="detail-exhibition">
            <div class="section" id="info">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <ul class="list-item">
                    <li>
                        <h4 class="title">Mã đơn hàng</h4>
                        <span class="detail text-success">{{$order->id}}</span>
                    </li>
                    <li>
                        <h4 class="title">Địa chỉ nhận hàng</h4>
                        <span class="detail text-success">{{$order->addres}}/{{$order->phonenumber}}</span>
                    </li>
                    <li>
                        <h4 class="title">Thông tin vận chuyển</h4>
                        <span class="detail text-success">
                        @if($order->payment == 'payment-home')
                            Thanh toán tại nhà
                        @else
                            Thanh toán tại cửa hàng
                        @endif
                        </span>
                    </li>
                    <form method="POST" action="{{route('detail', $order->id)}}}" class="form-action form-inline">
                        @csrf
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status" class="form-control">
                                <option  value='Đang xử lý' @if($order->status =='Đang xử lý')
                                    selected='selected'
                                @endif>Đang xử lý</option>
                                <option value='Đang vận chuyển' @if($order->status =='Đang vận chuyển')
                                    selected='selected'
                                @endif>Đang vận chuyển</option>
                                <option  value='Hoàn thành' @if($order->status =='Hoàn thành')
                                    selected='selected'
                                @endif>Hoàn thành</option>                            
                            </select>
                        </li>
                    </form>
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <th class="thead-text">STT</th>
                                <th class="thead-text">Ảnh sản phẩm</th>
                                <th class="thead-text">Tên sản phẩm</th>
                                <th class="thead-text">Đơn giá</th>
                                <th class="thead-text">Số lượng</th>
                                <th class="thead-text">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ordinal=0;
                            @endphp
                            @foreach($orderdetails as $product)
                            @php
                                $ordinal++;
                            @endphp
                                <tr>
                                    <td class="thead-text">{{$ordinal}}</td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="{{asset($product->Products->thumbnail)}}"alt="" style="width: 70px; height: 70px;">
                                        </div>
                                    </td>
                                   
                                    <td class="thead-text">{{$product->Products->name}}</td>
                                    <td class="thead-text">{{number_format($product->Products->price)}} VNĐ</td>
                                    <td class="thead-text">{{$product->qty}}</td>
                                    {{-- <td class="thead-text">{{number_format($product->Products->price *$order->soluong])}} VNĐ</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee">{{$order->soluong}} sản phẩm</span>
                            <span class="total">{{number_format($order->giatri)}} VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<body>