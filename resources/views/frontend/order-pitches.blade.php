@extends('layouts.frontend.app')
@section('content')


<div id="main-content-wp" class="checkout-page">
    <div id="wrapper" class="wp-inner clearfix container">
        <form method="POST" action="{{route('order-pitches')}}" name="form-checkout">
            @csrf
            <input type="hidden" name="id" value="{{$pitchesMax}}">
            <div class="row">
                <div class="col-lg-6 section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="name">Họ tên</label>
                                <input type="text" name="name" id="name" class="form-control">
                                @error('name')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                @error('email')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone_number" id="phone" class="form-control">
                                @error('phone_number')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note" class="form-control"></textarea>
                                @error('note')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        @foreach($time as $key=>$item)
                        @foreach($pitch as $key2=>$item2)
                        <div>
                            <h4>Thông tin sân đặt:</h4>
                        </div>
                        <div class="pl-4">
                            <h5>- Tên sân: {{$item2['name_pitch']}}</h5>
                            <h5>- Địa chỉ: {{$item2['address']}}</h5>
                            <h5>- Ngày đặt sân: {{$item['day_year']}} </h5>
                            <h5>- Giờ đặt sân: {{$item['time_start']}} -{{$item['time_end']}} </h5>
                            <h5>- Giá sân sân: {{$item['price'] ? number_format($item['price'], 0, ',', '.') : 0}}</h5>
                        </div>
                        @endforeach
                        @endforeach
                        <div>
                            <h4>Hình thức thanh toán</h4>
                        </div>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="direct-payment" name="payment" value="1" checked>
                                    <label for="direct-payment">Thanh toán trực tiếp tại sân</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-home" name="payment" value="2">
                                    <label for="payment-home">Thanh toán qua momo</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-vnpay" name="payment" value="3">
                                    <label for="payment-vnpay">Thanh toán qua vnpay</label>
                                </li>
                            </ul>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" name="btn_submit" id="order-now" value="Đặt hàng" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
@push('css')
<style>
    li{
        list-style-type: none !important;
    }
    .pl-4{
        padding-left: 1.5rem !important;
    }
</style>
@endpush

