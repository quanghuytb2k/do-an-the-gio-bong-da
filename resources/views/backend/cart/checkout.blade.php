@extends('layouts.backend.cart')
@section('content')


<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>


        @endif
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="{{route('checkout/action')}}" name="form-checkout">
            @csrf
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">

                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name">
                            @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                            @error('email')
        <small class="form-text text-danger">{{$message}}</small>
        @enderror
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-col " style="width: 100%;
                        padding-right: 0;">
                            <label for="addres">Địa chỉ</label>
                            <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                                <label for="province">Tỉnh/Thành Phố</label>
                                <select name="province" class="province form-control" id="province">
                                    <option value="">-- Chọn Tỉnh/Thành Phố--</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->name}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                                <label for="district">Quận/Huyện</label>
                                <select name="district" class="district form-control" id="district">
                                    <option value="">-- Chọn Quận/Huyện --</option>
                                </select>
                                @error('district')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-col fl-left" style="width: 100%;
                            padding-right: 0;">
                                <label for="commune">Xã/Phường</label>
                                <select name="commune" class="commune form-control">
                                    <option value="">-- Chọn Xã/Phường --</option>
                                </select>
                                @error('commune')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="form-row">
                    <div class="form-col fl-right">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" name="phone_number" id="phone">
                        @error('phone_number')
    <small class="form-text text-danger">{{$message}}</small>
    @enderror
                    </div>
                </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"></textarea>
                            @error('note')
        <small class="form-text text-danger">{{$message}}</small>
        @enderror
                        </div>
                    </div>

            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>


            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    @foreach (Cart::content() as $item)


                    <tbody>
                        <tr class="cart-item">
                            <td class="product-name"><input type="text"  name="name_product" value=" {{$item->name}}" readonly> <strong   class="product-quantity">Số lượng: <input type="text" name="qty" value=" {{$item->qty}}" readonly style="width:70px">  </strong></td>
                            <td class="product-total" ><input type="text" name="total" value="{{number_format($item->total,0,',','.')}}đ " readonly> </td>
                        </tr>

                    </tbody>
                    @endforeach
                    <tfoot>
                        <tr class="order-total">

                            <td>Tổng đơn hàng:</td>
                            @if(Session::get('coupon')==false)
                            <td><strong class="total-price" name="giatri">{{Cart::total()}}đ</strong></td>
                            @endif
                        </tr>
                    </tfoot>
                    <td>
                        @if(Session::get('coupon'))
                        @php
                            $array = [];
                            $coupon_session = Session::get('coupon');
                            $array = [
                                $coupon_session ,
                            ];
                        @endphp
                        @foreach($array as $key => $value)
                            @if($value['coupon_condition']==1)
                                <input type="hidden" name="coupon_id" value="{{$value['coupon_id']}}">
                                <div>
                                    <p id="total-price"> Mã giảm : <span class=''> {{$value['coupon_feature']}} %</span></p>
                                </div>
                                @php
                                    $total = str_replace(',','',Cart::total());
                                    $total_coupon = ($total*$value['coupon_feature'])/100;
                                    echo '<div class="">
                                            <p id="total-price" class="">Tổng giảm là : <span>' .number_format($total_coupon,0,',','.').'đ</span></p>
                                            </div>';
                                @endphp
                                    <input type="hidden" name="total_coupon" value="{{number_format($total_coupon,0,',','.')}}">
                                    <input type="hidden" name="total_pay" value="{{number_format($total-$total_coupon,0,',','.')}}">
                                <div class="">
                                    <p id="total-price" class="">Tổng giá tiền sau khi giảm là: <span class=''>{{number_format($total-$total_coupon,0,',','.')}}đ</span></p>
                                </div>
                            @endif
                            @if($value['coupon_condition']==2)
                                <input type="hidden" name="coupon_id" value="{{$value['coupon_id']}}">
                                <div class="">
                                    <p id="total-price" class=""> Mã giảm : <span class=''> {{$value['coupon_feature']}} k</span></p>
                                </div>
                                @php
                                    $total = str_replace(',','',Cart::total());
                                    $total_coupon = $total-$value['coupon_feature'];
                                    echo '<div >
                                            <p id="total-price" class="">Tổng giảm là : <span>' .number_format($value['coupon_feature'],0,',','.').'đ</span></p>
                                            </div>';
                                @endphp
                                <div class="">
                                    <p id="total-price" class="">Tổng giá tiền sau khi giảm là: <span class=''>{{number_format($total_coupon,0,',','.')}}đ</span></p>
                                </div>
                            @endif
                        @endforeach
                        @endif
                        </td>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" name="payment" value="direct-payment">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" id="payment-home" name="payment" value="payment-home">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" name="btn_submit" id="order-now" value="Đặt hàng">
                </div>
            </div>

        </div>
    </form>
    </div>

</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        //  select district

        $("#province").change(function (){
            var _token = $('input[name="_token"]').val();
            var province = $(this).val();
            var data = {province: province, _token:_token};
            console.log(data);
            $.ajax({
                url: "{{route('district')}}",
                method: 'POST',
                data: data,
                dataType: 'json',
                success:function(data){
                    $('.district').html(data);
                    // alert(data);
            }
            });
        });
        $("#district").change(function(){
            var _token = $('input[name="_token"]').val();
            var commune = $(this).val();
            var data = {commune:commune, _token:_token};
            $.ajax({
                url:"{{route('commune')}}",
                method :'POST',
                data:data,
                dataType: 'json',
                success:function(data){
                    $('.commune').html(data);
                }
            });
        });


</script>
@stop
