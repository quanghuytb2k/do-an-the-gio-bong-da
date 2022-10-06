<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    {{--    <link href=" {{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset/css.css') }}">
    <link rel="stylesheet prefetch" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chi tiet san</title>
</head>

<body>
<style>
    .premium-seat{
        background-color: yellow !important;
    }
</style>
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
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>
        @endif
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
        <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Đăng nhập <i
                class="fa-solid fa-arrow-right-to-bracket"></i></a>
    </div>
</nav>
<!-- Navbar End -->
<div class="container">
    <div class="row">
        @foreach($pitches as $item)
            <div class="col-md-6">
                <div class="mySlides">
                    <img src="{{asset($item->images)}}" style="width:100%">
                </div>
                {{--            <div class="row">--}}
                {{--                <div class="column col-md-4">--}}
                {{--                    <img class="demo cursor"--}}
                {{--                         src="https://www.sanbongconhantao.vn/image/data/kich-thuoc-san-bong.jpg" style="width:100%"--}}
                {{--                         onclick="currentSlide(1)" alt="Anh 1">--}}
                {{--                </div>--}}

                {{--            </div>--}}
                <div class="pt-3 mt-3">
                    <div>
                        <div class="stars">
                            <div>
                                <h5 class="card-title">Tên sân : {{$item->name_pitch}}</h5>
                                <h5 class="card-title">Địa chỉ : {{$item->address}}</h5>
                                <h5 class="card-title">Số điện thoại : {{$item->phone_number}}</h5>
                                <h5 class="card-title">Đánh giá : {{$item->star_rating}}</h5>
                            </div>
                            <form action="">
                                <div>
                                    <input class="star star-5" id="star-5" type="radio" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                            </form>
                        </div>
                        <div id="map-container-google-1" class="z-depth-1-half map-container" style="width: 550px; ">
                            <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" style="border: 0" allowfullscreen></iframe>
                        </div>
                        <div>
                            <h2>Tiện ích</h2>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Wifi</td>
                                    <td>Căng tin</td>
                                    <td>Giữ xe</td>
                                </tr>
                                <tr>
                                    <td>Tìm đối</td>
                                    <td>Shop thể thao</td>
                                    <td>Livestream</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- left-content -->
            <div class=" col-md-6">
                <div class="row">
                    <div class="col-md" style="background-color:rgb(234, 220, 220) ;">
                        <div>
                            <div>

                                <div class="cinema-container">
                                    <div class="text-choose">
                                        <h1>Ngày đặt sân</h1>
                                    </div>
                                    <div style="width: 100px">
                                        <div
                                            style="width: 200px; text-align: center; line-height: 50px; margin-left: -40px"
                                            class="seat">{{$day_year}}</div>
                                    </div>

                                    <div class="text-choose">
                                        <h1>Chọn giờ</h1>
                                    </div>

                                    <div class="row">
                                        @foreach($times as $value)
                                            <div
                                                style="line-height: 50px; width: 120px; height: 60px; margin-right: 10px">
                                                <div id="time"
                                                     class="time "
                                                     type="ratio"
                                                     style="text-align: center; font-size: 15px;width: 120px; height: 50px; margin-right: 10px">
                                                    <input id="{{$value->id}}" data-id="{{$value->id}}"  <?php if($value['status'] == '0') echo "disabled"; ?>
                                                           data-start="{{$value['time_start']}}"
                                                           data-end="{{$value['time_end']}}" type="checkbox"
                                                           class="input time-pitches" value="{{$value->price}}"
                                                           name="time"/>
                                                    <label class="<?php if($value['status'] == '0') echo "premium-seat"; ?>" id="value-label"
                                                           for="{{$value->id}}">{{$value['time_start']}}
                                                        - {{$value['time_end']}}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div>
                                        <p>Giờ mà bạn chọn sân là : <span id="selectedtext"></span></p>
                                        <p>Số tiền là: <span id="total-price"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="showcase">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary add-to-modal" data-toggle="modal"
                                        id="addCart"
                                        data-target="#exampleModal"
                                        data-url="{{ route('add.to.cart', $value->pivot->pitches_id) }}">
                                    {{-- <a href="{{ route('add.to.cart', $value->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> --}}
                                    ĐẶT SÂN
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thanh toán</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{--                                                    <h4>Array gio da chon : <span id="chk_values">--</span></h4>--}}
                                                <form>
                                                    <input  id="pich_id" type="hidden" name="star" value="{{$item->id}}"/>
                                                    <div class="form-group">
                                                        <label for="name">Tên </label>
                                                        <input type="text" class="form-control"
                                                               id="name" aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Số điện thoại</label>
                                                        <input type="text" class="form-control"
                                                               id="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control"
                                                               id="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Địa chỉ </label>
                                                        <input type="text" class="form-control"
                                                               id="address">
                                                    </div>
                                                    {{--                                                        <div class="form-check">--}}
                                                    {{--                                                            <input class="form-check-input" type="radio"--}}
                                                    {{--                                                                   name="flexRadioDefault" id="flexRadioDefault1">--}}
                                                    {{--                                                            <label class="form-check-label" for="flexRadioDefault1">--}}
                                                    {{--                                                                Liên hệ </label>--}}
                                                    {{--                                                        </div>--}}
                                                    <div class="form-check">
                                                        <input class="momo" type="radio"
                                                               name="flexRadioDefault" id="momo" value="1"
                                                               checked>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Đặt Online thanh toán qua momo
                                                        </label>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" id="btn-submit" class="btn-submit btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>Các đối đặt sân</h2>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Wifi</td>
                            <td>Căng tin</td>
                            <td>Giữ xe</td>
                        </tr>
                        <tr>
                            <td>Tìm đối</td>
                            <td>Shop thể thao</td>
                            <td>Livestream</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    @endforeach
</div>


<script>
    // $("#time").click(function(){
    //     document.getElementById('time').style.backgroundColor = "green";
    //     if($('#time').hasClass('premium-seat')) {
    //     }
    // });
    $('.time').click(function () {
        $('.checked').toggleClass('checked');
        $(this).toggleClass('checked');
    });
    var price = '';
    $(document).ready(function () {
        $('.input').click(function () {
            var text = "";
            $('.input:checked').each(function () {
                text += document.getElementById('value-label').innerHTML + ', ';
            });
            text = text.substring(0, text.length - 1);
            document.getElementById("selectedtext").innerHTML = text;

            $('input[type="checkbox"]').on("change", function () {
                count = 0;
                if ($(this).hasClass('check_all')) {

                    $('input[type="checkbox"][class=".input"]').prop('checked', true);
                    $('input[type="checkbox"][class=".input"]').each(function () {

                        count += parseInt($(this).val());

                    });

                } else {
                    $('input[type="checkbox"]:checked').each(function () {

                        count += parseInt($(this).val());
                    });
                }
                price = Number((count).toFixed(1)).toLocaleString();
                //   document.getElementById("total-price").innerHTML = count.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                document.getElementById("total-price").innerHTML = Number((count).toFixed(1)).toLocaleString()
            });

        })
    })

    // function addToCart(event){
    //     event.preventDefault();
    //     let $url = $(this).data('url');
    //     alert($url);
    // }

    $(function () {
        $('.add-to-modal').on('click', addToCart);
    });

    /**
     * Get value when checked
     *
     * **/
    var selected = new Array();
    $('#addCart').click(function () {
         selected = new Array();
        // var time_id = [];
        // var time_start = [];
        // var time_end = [];

        $("input[type=checkbox]:checked").each(function () {

            selected.push($(this).data());
            // time_id.push($(this).data('id'));
            // time_start.push($(this).data('start'));
            // time_end.push($(this).data('end'));
            // console.log("id",time_id);
            // console.log("start",time_start);
            // console.log("end",time_end);
        });
        console.log("data", selected);
        // if (selected.length > 0) {
        //     document.getElementById("chk_values").innerHTML = JSON.stringify(selected);
        // }
    });


</script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-submit").click(function () {
        var pich_id = $('#pich_id').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var total_price = price;
        var time = new Array();
        $.each(selected, function (index, value) {
            time.push(value.id)
        });
        $.ajax({
            url: "http://localhost:8080/create-oder",
            method: 'POST',
            data: {name: name, phone: phone, email: email, address:address, time:time, pich_id:pich_id, total_price : total_price },
            dataType: 'json',
            success: function (data) {
                alert(data);
                window.location="http://localhost:8080/home";
            }
        });
    });
</script>

</body>
<script src="{{ asset('asset/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</html>
