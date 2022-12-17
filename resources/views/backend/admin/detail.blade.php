@extends('layouts.backend.master')
@section('content')

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
                            <select name="status" class="form-control" disabled>
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
                                <th class="thead-text">Số tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ordinal=0;
                            @endphp
                            @foreach($order_product as $product)
                            @php
                                $ordinal++;
                            @endphp
                                <tr>
                                    <td class="thead-text">{{$ordinal}}</td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="{{asset($product->thumbnail)}}" alt="" style="width: 70px; height: 70px;">
                                        </div>
                                    </td>
                                    <td class="thead-text">{{$product->name}}</td>
                                    <td class="thead-text">{{number_format($order->giatri)}} VNĐ</td>
                                    <td class="thead-text">{{$qty[$ordinal-1]}}</td>
                                    <td class="thead-text">{{number_format($order->giatri*$qty[$ordinal-1])}} VNĐ</td>
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
                        <table border="1">
                        <tr>
                        <td>
                            <span class="total-fee">Tổng số lượng</span></td>
                            <td><span class="total">Tổng đơn hàng</span></td>
                            @if(isset($coupon))
                            <td>Mã sản phẩm</td>
                            <td>Số tiền được khuyến mãi là</td>
                            <td>Tổng tiền sau khi khuyến mại là</td>
                            @endif
                        </tr>
                        <tr>
                            <td><span class="total-fee">{{$order->soluong}} sản phẩm</span></td>
                            <td> <span class="total">{{number_format($order->giatri)}} VNĐ</span></td>
                            @if(isset($coupon))
                            <td>{{$coupon->code}}</td>
                            @if($coupon->condition==1)
                            @php
                                $total_coupon = $order->giatri*$coupon->feature/100;
                            @endphp
                            <td>{{number_format($order->giatri*$coupon->feature/100)}}</td>
                            <td>{{number_format($order->giatri-$total_coupon)}}</td>
                            @endif
                            @if($coupon->condition==2)
                            @php

                            @endphp
                                <td>{{number_format($coupon->feature)}}</td>
                                <td>{{number_format($order->giatri-$coupon->feature)}}</td>
                            @endif
                            @endif
                        </tr>
                        </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
