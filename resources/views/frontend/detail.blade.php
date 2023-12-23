<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
    .premium-seat {
        background-color: yellow !important;
    }

    .form-check-input {
        margin-left: 10px;
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
        <a href="{{route('login')}}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Đăng nhập <i
                class="fa-solid fa-arrow-right-to-bracket"></i></a>
    </div>
</nav>
<!-- Navbar End -->
<div class="container">
    <div class="row">
        @foreach($pitches as $item)
            <div class="col-md-3">
                <div class="mySlides">
                    <img src="{{asset($item->images)}}" style="width:100%">
                </div>
                <div class="pt-3 mt-3">
                    <div>
                        <div class="stars">
                            <div>
                                <p class="card-title">Tên sân : {{$item->name_pitch}}</p>
                                <p class="card-title">Địa chỉ : {{$item->address}}</p>
                                <p class="card-title">Số điện thoại : {{$item->phone_number}}</p>
                                <p class="card-title">Đánh giá : {{$item->star_rating}}</p>
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
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="mySlides">
                    <img src="{{asset($item->images)}}" style="width:100%">
                </div>
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
                    </div>
                </div>
            </div> -->

            <!-- left-content -->
            <div class="col-md-9">
                <h1>Lịch đá</h1>
                <div id='calendar'></div>
            </div>
    </div>
    <div class="row pt-4">
        <div class="col-md-6">
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
        <div class="col-md-6">
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
    <div class="row pt-4">
        <div class="col-md-12">
            <div id="map-container-google-1" class="z-depth-1-half map-container" style="width: 100%; ">
                <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0" style="border: 0" allowfullscreen></iframe>
            </div>
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

    // $(function () {
    //     $('.add-to-modal').on('click', addToCart);
    // });

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

    $(".addPitches").click(function () {
        var _token = $('input[name="_token"]').val();
        var pich_id = $('#pich_id').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var total_price = price;
        var radios = document.getElementsByName('pay');
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                var pay = radios[i].value;
                break;
            }
        }
        var time = new Array();
        $.each(selected, function (index, value) {
            time.push(value.id)
        });
        $.ajax({
            url: '{{route("create-oder")}}',
            type: 'post',
            data: {
                name: name,
                phone: phone,
                email: email,
                address: address,
                time: time,
                pich_id: pich_id,
                total_price: total_price,
                pay: pay,
                _token: _token
            },
            dataType: 'json',
            success: function (data) {
                if (data != "") {
                    alert(data);
                } else {
                    window.location = "http://localhost/the-gioi-bong-da/checkout/pitches";
                }
            }
        });
    });
</script>
<script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });
        var list_schedules;
        var list_new_data;
        const id = location.pathname.split('/').pop();
        document.addEventListener('DOMContentLoaded', function() {
            display_event();
        });

        // Lấy dữ liệu lịch đá
        async function display_event() {
            $.ajax({
                url: "/get-soccer-schedule/" + id,
                type: "get",
                dataType: "json",
                data: {},
                success: function(data) {
                    if (data.schedules) {
                        list_schedules = data.schedules;
                    }
                    renderCalendar();
                },
            });
        }

        // Hiển thị dữ liệu theo lịch đá
        function renderCalendar(){
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "vi",
                events: list_schedules,
                editable: true,
                selectable: true,
                dayMaxEvents: true,
                displayEventTime: false,
                eventDisplay: 'block',
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    var event_id = info.event.id;
                    var price = info.event.extendedProps.price;
                    var status = info.event.extendedProps.status;
                    if(status != 1) {
                        alertError('Thời gian đang không trống');
                        return;
                    }
                    $.ajax({
                        url: '{{route("create-oder")}}',
                        type: 'post',
                        data: {
                            time: [event_id],
                            pich_id: id,
                            total_price: price,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data != "") {
                                alert(data);
                            } else {
                                window.location = "http://localhost/the-gioi-bong-da/checkout/pitches";
                            }
                        }
                    });
                },
            });
            calendar.render();
        }


        function alertSuccess(message) {
            swal("Thành công", message, "success");
        }

        function alertError(message){
            swal("Đã xảy ra lỗi!", message, "warning");
        }

    </script>
</body>
<script src="{{ asset('asset/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</html>
