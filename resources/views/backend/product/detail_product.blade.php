@extends('layouts.backend.cart')
@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img  id="zoom" src="{{asset($products->thumbnail)}} " data-zoom-image="{{asset($products->thumbnail)}}"/>
                        </a>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>


                    <div class="info fl-right">
                        <h3 class="product-name">{{$products->name}}</h3>
                        <div class="desc">
                            <h3> Đặc điểm nổi bật của sản phẩm</h3>
                            <p>Giày tennis nam Prince thiết kế màu xanh dương và bạc cá tính, mạnh mẽ</p>
                            <p>Phần đế thiết kế đặc biệt, tăng khả năng bám sát mặt sân giúp tay vợt tự tin ở mỗi bước di chuyển</p>
                            <p>Đế giày tennis nam sử dụng cao su bền chống ma sát cao, mềm dẻo.</p>
                            <p>Sử dụng da nhân tạo, RPU (nhựa tổng hợp) cùng sợi tổng hợp có khả năng chống thấm nước, dễ dàng vệ sinh khi bụi bẩn.</p>
                        </div>

                        <div class="num-product">

                            <span class="title">Sản phẩm: </span>
                            @if($products->amount > 0)
                            <span class="status">Còn hàng</span>
                            @else
                            <span class="status">hết hàng</span>
                            @endif
                        </div>



                        <p class="price">{{$products->price}}đ </p>


                        <form action="{{route('cart/add',$products->id)}}">
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>

                            <input type="text" min='1' name="qty" value="1" id="num-order">

                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>

                        <input type="submit" class="add-cart" name="btn-submit" value="Thêm vào giỏ hàng" >
                    </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p>Phiên bản mới được cập nhật giúp cho Giày Tennis Asics Court FF 2 trở thành 1 đôi giày lý tưởng cho những người  chạy nhanh và nhiều  khi khi đấu. Đôi giày mang đến sự tự tin hoàn toàn với mỗi bước di chuyển, bề mặt của Court FF2 được chế tạo chắc chắn hơn và phần trên được nâng cấp để mang đến sự hỗ trợ tốt hơn khi đấu và những bước đệm mềm mại.</p>
                    <p>Phần đế giữa Twistruss  giờ đây linh hoạt hơn cho các chuyển động bất ngờ giúp người chơi có những cú xoạc chân ổn định hơn và cho phép họ đặt niềm tin hoàn toàn vào đôi giày này.Công nghệ FlyteFoam  mang đến phần đệm lót nhẹ nhưng hấp thụ lực tốt hơn. Những người chơi Tennis trên thế giới nhanh chóng gọi mẫu giày này là một trong những sản phẩm yêu thích nhất năm 2019.</p>
                    <p>Đế giày giữa: Công nghệ FlyteFoam tăng cường độ êm chân, cảm giác phản hồi (không bị bồng bềnh) tốt hơn đồng thời giảm bớt trọng lượng giày cũng như dẻo dai hơn. Công nghệ Trusstic bố trí ở dưới gan bàn chân giúp ngăn khả năng giày bị vặn - bẻ cong – bóp méo tăng thêm độ hỗ trợ và độ vững chãi khi bứt tốc, dậm nhảy hay khi thực hiện những động tác kĩ thuật di chuyển ngang.</p>
                    <p>Đế giày dưới: Công nghệ AHAR - Asics High Abrasion Rubber (vật liệu cao su chống mòn cao của Asics) mang lại độ bám và độ bền bỉ tuyệt vời trên mọi bề mặt sân.</p>
                </div>
            </div>
            <div class="section" id="same-category-wp">
{{--                <div class="section-head">--}}
{{--                    <h3 class="section-title">Cùng chuyên mục</h3>--}}
{{--                </div>--}}
{{--                <div class="section-detail">--}}
{{--                    <ul class="list-item">--}}
{{--                        <li>--}}
{{--                            <a href="" title="" class="thumb">--}}
{{--                                <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fshopee.vn%2FGi%25C3%25A0y-nam-%25C4%2591%25E1%25BA%25B9p-d%25C3%25A1ng-th%25E1%25BB%2583-thao-(M%25E1%25BA%25ABu-m%25E1%25BB%259Bi-%25E1%25BA%25A2nh-th%25E1%25BA%25ADt-H%25C3%25A0ng-Cao-C%25E1%25BA%25A5p-B%25E1%25BB%2581n-R%25E1%25BA%25BB-%25C4%2590%25E1%25BA%25B9p)-i.106207875.2068753283&psig=AOvVaw0QVDMin5je8V8M4-AnxhEV&ust=1666628859310000&source=images&cd=vfe&ved=0CA0QjRxqFwoTCIil3bzi9voCFQAAAAAdAAAAABAD">--}}
{{--                            </a>--}}
{{--                            <a href="" title="" class="product-name">Giày Tennis Asics Gel Resolution 8 White/Mako Blue (1041A079.103)</a>--}}
{{--                            <div class="price">--}}
{{--                                <span class="new">17.900.000đ</span>--}}
{{--                                <span class="old">20.900.000đ</span>--}}
{{--                            </div>--}}
{{--                            <div class="action clearfix">--}}
{{--                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>--}}
{{--                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="" title="" class="thumb">--}}
{{--                                <img src="{{asset('images/img-pro-18.png')}}">--}}
{{--                            </a>--}}
{{--                            <a href="" title="" class="product-name">https://sadesign.vn/wp-content/uploads/2021/04/chup-anh-giay-dep.jpg</a>--}}
{{--                            <div class="price">--}}
{{--                                <span class="new">17.900.000đ</span>--}}
{{--                                <span class="old">20.900.000đ</span>--}}
{{--                            </div>--}}
{{--                            <div class="action clearfix">--}}
{{--                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>--}}
{{--                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="" title="" class="thumb">--}}
{{--                                <img src="{{asset('https://ressmedia.com/wp-content/uploads/2021/07/ANH-1-36.jpg')}}">--}}
{{--                            </a>--}}
{{--                            <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>--}}
{{--                            <div class="price">--}}
{{--                                <span class="new">17.900.000đ</span>--}}
{{--                                <span class="old">20.900.000đ</span>--}}
{{--                            </div>--}}
{{--                            <div class="action clearfix">--}}
{{--                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>--}}
{{--                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="" title="" class="thumb">--}}
{{--                                <img src="{{asset('https://media3.scdn.vn/img4/2020/04_16/VBCAZaSMJSkzUPA6KyPM_simg_de2fe0_500x500_maxb.jpg')}}">--}}
{{--                            </a>--}}
{{--                            <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>--}}
{{--                            <div class="price">--}}
{{--                                <span class="new">17.900.000đ</span>--}}
{{--                                <span class="old">20.900.000đ</span>--}}
{{--                            </div>--}}
{{--                            <div class="action clearfix">--}}
{{--                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>--}}
{{--                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">

            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
