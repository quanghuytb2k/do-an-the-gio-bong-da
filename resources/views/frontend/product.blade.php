<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Solartec - Renewable Energy Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    {{--    <link href=" {{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
{{--<div class="container-fluid bg-dark p-2">--}}
{{--    <div class="row gx-0 d-none d-lg-flex">--}}
{{--        <div class="col-lg-7 px-5 text-start">--}}
{{--            <div class="h-100 d-inline-flex align-items-center me-4">--}}
{{--                <small class="fa fa-map-marker-alt text-white me-2"></small>--}}
{{--                <small class="text-white">123 Street, New York, USA</small>--}}
{{--            </div>--}}
{{--            <div class="h-100 d-inline-flex align-items-center">--}}
{{--                <small class="far fa-clock text-white me-2"></small>--}}
{{--                <small class="text-white">Mon - Fri : 09.00 AM - 09.00 PM</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-5 px-5 text-end">--}}
{{--            <div class="h-100 d-inline-flex align-items-center me-4">--}}
{{--                <small class="fa fa-phone-alt text-white me-2"></small>--}}
{{--                <small class="text-white">+012 345 6789</small>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{route('index')}}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0 text-primary">Thethao24h</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{route('index')}}" class="nav-item nav-link ">Trang chủ</a>
            <a href="{{route('service')}}" class="nav-item nav-link">Đặt sân</a>
            <a href="" class="nav-item nav-link">Tìm đối</a>
            <a href="" class="nav-item nav-link">Lịch thi đấu</a>
            <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="feature.html" class="dropdown-item">Feature</a>
                    <a href="quote.html" class="dropdown-item">Free Quote</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> -->
            <a href="{{route('product')}}" class="nav-item nav-link">Sản phẩm</a>
        </div>
        <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Đăng nhập <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
    </div>
</nav>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Sản phẩm</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Trang chủ</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-4">Tất cả sản phẩm</h1>
        </div>

        <div class="row g-4">
            @foreach($products as $item)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s" for>
                    <div class="service-item rounded overflow-hidden">
                        <div class="service-item-img">
                            <a href="" class="img-link">
                                <img class="img-fluid" src="{{asset($item->thumbnail)}}" alt="">
                            </a>
                        </div>
                        <div class="position-relative p-4 pt-4">
                            <h4 class="mb-3">{{$item->name}}</h4>
                            <p>{{number_format($item->price).'đ'}}</p>
                            <a class="small fw-medium" href="">Chi tiết<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Footer Start -->
<div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Thethao24h</h5>
                <p class="mb-2" style="color: #ffffff;">Thể thao 24h kết nối niềm đam mê với trái bóng</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Liên hệ</h5>
                <a class="btn btn-link" href="">tavanhunglc2000@gmail.com</a>
                <a class="btn btn-link" href="">385 Hoàng Quốc Việt, Bắc Từ Liêm, Hà Nội</a>
                <a class="btn btn-link" href="">0368573521</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Project Gallery</h5>
                <div class="row g-2">
                    <div class="col-4">
                        <img class="img-fluid rounded" src="{{asset('img/san-bong-da-o-quan.jpg')}}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded" src="img/san-nguyen-chi-thanh.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded" src="img/san-thien-truong.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded" src="img/san-bong-da-o-quan.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded" src="img/san-cau-giay.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Newsletter</h5>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0" style="color: #ffffff;">
                    ©Thethao24hFooball
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>
