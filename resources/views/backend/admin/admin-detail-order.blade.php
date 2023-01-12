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
                        <h4 class="title">Thông tin khách đặt sân</h4>
                            <h5>- Tên khách {{$order_pitches['name_customer']}}</h5>
                            <h5>- Email {{$order_pitches['email']}}</h5>
                            <h5>- số điện thoại {{$order_pitches['phone']}} </h5>
                            <h5>- Ghi chú{{$order_pitches['note']}}</h5>
                    </li>
                    <li>
                        @foreach($time as $key=>$item)
                        @foreach($pitch as $key2=>$item2)
                        <h4 class="title">Thông tin sân đặt</h4>
                            <h5>- Tên sân {{$item2['name_pitch']}}</h5>
                            <h5>- Địa chỉ {{$item2['address']}}</h5>
                            <h5>- Ngày đặt sân {{$item['day_year']}} </h5>
                            <h5>- Giờ đặt sân {{$item['time_start']}} -{{$item['time_end']}} </h5>
                            <h5>- Gía sân sân {{$item['price']}}</h5>
                        @endforeach
                        @endforeach
                    </li>
                    <li>
                        <h4 class="title">Thông tin thanh toán</h4>
                        <h4 class="title">Tổng số tiền cần thanh toán là: {{$order_pitches->price}}</h4>
                        <span class="detail text-success"><?php if($order_pitches->status == 1)echo("Đã thanh toán");else echo("Chưa thanh toán");?></span>
                    </li>
                    <form method="POST" action="{{route('pay', $order_pitches->id)}}" class="form-action form-inline">
                        @csrf
                        <li>
                            <h3 class="title">Tình trạng thanh toán</h3>
                            <select name="status" class="form-control">
                                <option  value= 1 @if($order_pitches->status =='1')
                                    selected='selected'
                                @endif>Đã thanh toán</option>
                                <option value=0 @if($order_pitches->status =='0')
                                    selected='selected'
                                @endif>Chưa thanh toán</option>                           
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật thanh toán" class="btn btn-primary">
                        </li>
                    </form>
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                </ul>
            </div>
            
        </div>
    </div>
</div>
@endsection
