@extends('layouts.backend.cart')
@section('content')
<style>
    #coupon_delete {
    display: inline-block;
    padding: 8px 20px;
    text-transform: uppercase;
    font-size: 13px;
    border-radius: 1px;
    font-family: 'Roboto Bold';
    font-weight: normal;
    border: none;
    outline: none;
    background: #ececf1;
    color: black;
}
#coupon_delete:hover{
    background: #c6c6f0;
}
</style>
@if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>
        @endif
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">có <strong>{{Cart::count()}}</strong> sản phẩm trong giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form action="{{route('cart/action')}} " method="POST">
                    @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $item)


                        <tr>
                            <td>{{$item->id}} </td>
                            <td>
                                <a href="" title="" class="thumb">
                                    <img src="{{asset($item->options->thumbnail)}} " alt="">
                                </a>
                            </td>

                            <td>
                                <a href="" title="" class="name-product">{{$item->name}} </a>
                            </td>
                            <td>{{number_format( $item->price,0,',','.')}}đ </td>
                            <td>
                                <input type="number" name="qty[{{$item->rowId}}]" min='1'  value="{{$item->qty}}" class="num-order">
                            </td>
                            <td class="abcd">{{number_format($item->total,0,',','.')}}đ </td>
                            <td>
                                <a href="{{route('cart/remove',$item->rowId)}} " title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span class='abcd2'>{{str_replace('.00','',Cart::total())}}đ </span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
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
                                                <div class="clearfix">
                                                    <p id="total-price" class="fl-right"> Mã giảm : <span class=''> {{$value['coupon_feature']}} %</span></p>
                                                </div>
                                                @php
                                                    $total = str_replace(',','',Cart::total());
//                                                    dd($total);
                                                    $total_coupon = ($total*$value['coupon_feature'])/100;
                                                    echo '<div class="clearfix">
                                                            <p id="total-price" class="fl-right">Tổng giảm là : <span>' .number_format($total_coupon,0,',','.').'đ</span></p>
                                                            </div>';
                                                @endphp
                                                <div class="clearfix">
                                                    <p id="total-price" class="fl-right">Tổng giá tiền sau khi giảm là: <span class=''>{{number_format($total-$total_coupon,0,',','.')}}đ</span></p>
                                                </div>
                                            @endif
                                            @if($value['coupon_condition']==2)
                                                <div class="clearfix">
                                                    <p id="total-price" class="fl-right"> Mã giảm : <span class=''> {{$value['coupon_feature']}} k</span></p>
                                                </div>
                                                @php
                                                    $total = str_replace('.','',Cart::total());
                                                    $total_coupon = $total - $value['coupon_feature'];
                                                    echo '<div class="clearfix">
                                                            <p id="total-price" class="fl-right">Tổng giảm là : <span>' .number_format($total_coupon,0,',','.').'đ</span></p>
                                                            </div>';
                                                @endphp
                                        @endif
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit" name="btn_submit" value="cập nhật giỏ hàng"  id="update-cart">
                                        <a href="{{route('cart/checkout')}} " title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            @if(Cart::count()>0)
            <tr>
                <td colspan="7" style="margin-top: 20px">
                <div class="">
                    <div class="fl-left">
                <form action="{{route('check/coupon')}}" method="POST">
                    @csrf
                    <input type="text" class="form-control" name="coupon" value="{{ old('coupon') }}" placeholder="Nhập mã giảm giá"><br>
                    <a href="{{route('delete/coupon')}} " title="" id="coupon_delete">Xóa mã giảm giá</a>
                    <button type="submit" class="btn btn-default" name="check_coupon" >Tính mã giảm giá </button>
                </form>
                    </div>
                </div>
                </td>
            </tr>
            @endif

            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="{{url('/')}} " title="" id="buy-more">Mua tiếp</a><br/>
                <a href="{{route('cart/destroy')}} " title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //  select district

        // $(".num-order").change(function (){
        //     var _token = $('input[name="_token"]').val();
        //     var num_order = $(this).val();
        //     var data = {num_order: num_order, _token:_token};
        //     console.log(data);
        //     $.ajax({
        //         url: "{{route('num_order')}}",
        //         method: 'POST',
        //         data: data,
        //         dataType: 'json',
        //         success:function(data){
        //             console.log(data);
        //             $('.abcd').html(data);
        //             $('.abcd2').html(data);
        //             // alert(data);
        //     }
        //     });
        // });
    </script>
@endsection
