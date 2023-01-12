<ul id="sidebar-menu">
    <li class="nav-link {{ $module_active == 'dashboard'?'active':''}}">
        <a href="{{route('dashboard')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Dashboard
        </a>
        <i class="arrow fas fa-angle-right"></i>
        <ul class="sub-menu">
            <li><a href="{{route('dashboard2')}}">Dashboard-Products</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href="?view=list-post">
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Trang
        </a>
        <i class="arrow fas fa-angle-right"></i>

        <ul class="sub-menu">
            <li><a href="?view=add-post">Thêm mới</a></li>
            <li><a href="?view=list-post">Danh sách</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href="?view=list-post">
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Bài viết
        </a>
        <i class="arrow fas fa-angle-right"></i>
        <ul class="sub-menu">
            <li><a href="?view=add-post">Thêm mới</a></li>
            <li><a href="?view=list-post">Danh sách</a></li>
            <li><a href="?view=cat">Danh mục</a></li>
        </ul>
    </li>
    <li class="nav-link ">
        <a href=" ">
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Sản phẩm
        </a>
        <i class="arrow fas fa-angle-down"></i>
        <ul class="sub-menu">
            <li><a href="{{route('add-product')}}">Thêm mới</a></li>
            <li><a href="{{route('list-product')}}">Danh sách</a></li>
            <li><a href="">Danh mục</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href="?view=list-order">
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Bán hàng
        </a>
        <i class="arrow fas fa-angle-right"></i>
        <ul class="sub-menu">
            <li><a href="?view=list-order">Đơn hàng</a></li>
        </ul>
    </li>
    <li class="nav-link {{$module_active=='user'?'active':''}}">
        <a href=" " >
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Users
        </a>
        <i class="arrow fas fa-angle-right"></i>

        <ul class="sub-menu">
            <li class=" "><a href="{{route('admin/user/add-user')}}">Thêm mới</a></li>
            <li><a href="{{route('admin/user/list-user')}}">Danh sách</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href=" " >
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Khuyễn mãi
        </a>
        <i class="arrow fas fa-angle-right"></i>

        <ul class="sub-menu">
            <li class=""><a href="{{route('coupon.create')}}">Thêm mới</a></li>
            <li><a href="{{route('coupon.index')}}">Danh sách</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href="{{route('list-pitches')}}" >
            <div class="nav-link-icon d-inline-flex">
                <i class="far fa-folder"></i>
            </div>
            Sân bóng
        </a>
        <i class="arrow fas fa-angle-right"></i>

        <ul class="sub-menu">
            {{--                        <li class=""><a href="{{route('coupon.create')}}">Thêm mới</a></li>--}}
            <li><a href="{{route('list-pitches')}}">Danh sách</a></li>
        </ul>
    </li>

    <!-- <li class="nav-link"><a>Bài viết</a>
        <ul class="sub-menu">
            <li><a>Thêm mới</a></li>
            <li><a>Danh sách</a></li>
            <li><a>Thêm danh mục</a></li>
            <li><a>Danh sách danh mục</a></li>
        </ul>
    </li>
    <li class="nav-link"><a>Sản phẩm</a></li>
    <li class="nav-link"><a>Đơn hàng</a></li>
    <li class="nav-link"><a>Hệ thống</a></li> -->

</ul>
