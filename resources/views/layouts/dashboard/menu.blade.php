<div class="sidebar" data-color="none" data-image="">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="{{route('dashboard')}}" class="simple-text logo-mini">
            QL
        </a>

        <a href="{{route('dashboard')}}" class="simple-text logo-normal">
            Quản lý
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="{{ asset('img/AngelRosé.jpg') }}" />
                </div>

                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        {{-- <li>
                            <a href="javascript:void(0)">
                                {{ __('Tài khoản') }}
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            @if(Auth::user()->role == App\User::USER_ADMIN_ROLE)
            <li>
                <a data-toggle="collapse" href="#users">
                    <i class="pe-7s-note2"></i>
                    <p>Users
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin/user/add-user')}}">
                                <span class="sidebar-mini">NUR</span>
                                <span class="sidebar-normal">Thêm mới</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/user/list-user')}}">
                                <span class="sidebar-mini">LUR</span>
                                <span class="sidebar-normal">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#serivce">
                    <i class="pe-7s-note2"></i>
                    <p>service
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="serivce">
                    <ul class="nav">
                        <li>
                            <a href="">
                                <span class="sidebar-mini">NSV</span>
                                <span class="sidebar-normal">Thêm mới</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-mini">LSV</span>
                                <span class="sidebar-normal">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#service-pack">
                    <i class="pe-7s-note2"></i>
                    <p>Service pack
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="service-pack">
                    <ul class="nav">
                        <li>
                            <a href="">
                                <span class="sidebar-mini">NSVP</span>
                                <span class="sidebar-normal">Thêm mới</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin/user/list-user')}}">
                                <span class="sidebar-mini">LSVP</span>
                                <span class="sidebar-normal">Danh sách</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @else
                @php
                    $service = DB::table('service_users')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
                    // $stt = 0;
                @endphp
                <li>
                    <a data-toggle="collapse" href="#chart">
                        <i class="pe-7s-note2"></i>
                        <p>Dashboard
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="chart">
                        <ul class="nav">
                            @if($service && ($service->service_id == App\Service::BOOKING || $service->service_id == App\Service::ALL))
                                <li>
                                    <a href="{{route('dashboard')}}">
                                        <span class="sidebar-mini">DHB</span>
                                        <span class="sidebar-normal">Dashboard</span>
                                    </a>
                                </li>
                            @elseif($service && ($service->service_id == App\Service::SELL || $service->service_id == App\Service::ALL))
                                <li>
                                    <a href="{{route('dashboard2')}}">
                                        <span class="sidebar-mini">DBP</span>
                                        <span class="sidebar-normal">Dashboard-Products</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if($service && ($service->service_id == App\Service::SELL || $service->service_id == App\Service::ALL))
                    <li>
                        <a data-toggle="collapse" href="#pages">
                            <i class="pe-7s-note2"></i>
                            <p>Trang
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="pages">
                            <ul class="nav">
                                <li>
                                    <a href="?view=add-post">
                                        <span class="sidebar-mini">NPG</span>
                                        <span class="sidebar-normal">Thêm mới</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?view=list-post">
                                        <span class="sidebar-mini">LDB</span>
                                        <span class="sidebar-normal">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#posts">
                            <i class="pe-7s-note2"></i>
                            <p>Bài viết
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="posts">
                            <ul class="nav">
                                <li>
                                    <a href="?view=add-post">
                                        <span class="sidebar-mini">NPS</span>
                                        <span class="sidebar-normal">Thêm mới</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?view=list-post">
                                        <span class="sidebar-mini">LPS</span>
                                        <span class="sidebar-normal">Danh sách</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="?view=cat">
                                        <span class="sidebar-mini">CAT</span>
                                        <span class="sidebar-normal">Danh mục</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#products">
                            <i class="pe-7s-note2"></i>
                            <p>Sản phẩm
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="products">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('add-product')}}">
                                        <span class="sidebar-mini">NPD</span>
                                        <span class="sidebar-normal">Thêm mới</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('list-product')}}">
                                        <span class="sidebar-mini">LPD</span>
                                        <span class="sidebar-normal">Danh sách</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="sidebar-mini">CAT</span>
                                        <span class="sidebar-normal">Danh mục</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#orders">
                            <i class="pe-7s-note2"></i>
                            <p>Bán hàng
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="nav">
                                <li>
                                    <a href="?view=list-order">
                                        <span class="sidebar-mini">ORD</span>
                                        <span class="sidebar-normal">Đơn hàng</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#coupon">
                            <i class="pe-7s-note2"></i>
                            <p>Khuyễn mãi
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="coupon">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('coupon.create')}}">
                                        <span class="sidebar-mini">NCP</span>
                                        <span class="sidebar-normal">Thêm mới</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('coupon.index')}}">
                                        <span class="sidebar-mini">LCP</span>
                                        <span class="sidebar-normal">Danh sách</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if($service && ($service->service_id == App\Service::BOOKING || $service->service_id == App\Service::ALL))
                    <li>
                        <a data-toggle="collapse" href="#stadium">
                            <i class="pe-7s-note2"></i>
                            <p>Sân bóng
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="stadium">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('list-pitches')}}">
                                        <span class="sidebar-mini">LST</span>
                                        <span class="sidebar-normal">Danh sách</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('create-pitches')}}">
                                        <span class="sidebar-mini">NST</span>
                                        <span class="sidebar-normal">Tạo sân bóng</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
@push('js')
{{-- <script>
        getInfo();

        function getInfo() {
            $.ajax({
                url: "/api/get-status-room",
                type: "get",
                dataType: "json",
                success: function(rs) {
                    var htmlCheckin = `(${rs.checkin})`;
                    $('#numb-room-checkin').html(htmlCheckin);

                    var htmlRoom = `(${rs.room})`;
                    $('#numb-rooms').html(htmlRoom);

                    var htmlCheckout = `(${rs.checkout})`;
                    $('#numb-room-checkout').html(htmlCheckout);

                    var htmlClean = `(${rs.clean})`;
                    $('#numb-room-clean').html(htmlClean);
                },
            });
        }
    </script> --}}
@endpush
