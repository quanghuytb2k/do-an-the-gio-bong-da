<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}} ">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/03vjjkv59uvqj4oy2r733miqbkspcof5omxzn0my2lwpia7j/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript"> var editor_config = {
            path_absolute : "http://localhost/doan-laravel-ajax/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);</script>

    <title>Admintrator</title>
</head>
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
@if(session()->has('jsAlert'))
<script type="text/javascript" >
    let msg = '{{Session::get('jsAlert')}}';;
    alert(msg);
</script>
@endif 


<div id="warpper" class="nav-fixed">
    <nav class="topnav shadow navbar-light bg-white d-flex">


    </nav>
    <div id="page-body" class="d-flex">
        <div id="sidebar" class="bg-white">
            <ul id="sidebar-menu">
                <li class="nav-link">
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
                        <li><a href="">Thêm mới</a></li>
                        <li><a href=" ">Danh sách</a></li>
                        <li><a href="">Danh mục</a></li>
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
                <li class="nav-link ">
                    <a href="{{route('admin/user/list-user')}}  " >
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
                    <a href="{{route('coupon.index')}}" >
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
                        <li><a href="{{route('create-pitches')}}">Tạo sân bóng</a></li>
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

        </div>
        <div id="wp-content">
            <div class="container-fluid py-5">
                <div class="row">
                    <div class="col">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_orders_process}}</h5>
                                <p class="card-text">Đơn hàng giao dịch thành công</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">ĐANG XỬ LÝ</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_orders_transport}}</h5>
                                <p class="card-text">Số lượng đơn hàng đang chưa thanh toán</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">DOANH SỐ</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$proceeds}}</h5>
                                <p class="card-text">Doanh số hệ thống</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">Tổng đơn hàng</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_orders_success}}</h5>
                                <p class="card-text">Số đơn hàng trong hệ thống</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold">
                    ĐƠN HÀNG MỚI
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">email</th>
                            <th scope="col">Tên sân</th>
                            <th scope="col">Chủ sân</th>
                            <th scope="col">Gía tiền sân</th>
                            <th scope="col"> Chi tết </th>
                            <th scope="col"> Trạng thái </th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $items = DB::table('order_pitch')->get();
                            $stt = 0;
                        @endphp
                        @foreach ($items as $item ) @php
                                $stt ++ ;
                                $pitches = DB::table('football_pitches')->where('id',$item->pitch_id)->first();
                            @endphp

                        <tr>
                            <th scope="row">{{$stt}} </th>
                            <td>
                                {{$item->name_customer}} <br>
                                {{$item->phone}}
                            </td>
                            <td><a href="#">{{$item->address}}</a></td>
                            <td>{{$item->email}}</td>
                            <td>{{$pitches->name_pitch ?? null }}</td>
                            <td>{{$pitches->name ?? null}}</td>
                            <td>{{$item->price ?? null}}</td>
                            <td><a href="{{route('admin-detail-order',$item->id)}}">Chi tiết</a></td>
                            <td><span class="badge badge-warning">Đang xử lý</span></td>
                            <td>
                                <a href="{{route('admin-edit-pitches',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
    {{--                        <td>{{$item->created_at}}</td>--}}
    {{--                        <td><a href="{{route('detail',$item->id)}}">Chi tiết</a></td>--}}
    {{--                        <td>--}}
    {{--                            <a href="{{route('admin_order',$item->id)}} " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>--}}
    {{--                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>--}}
    {{--                        </td>--}}
                        </tr>
                        @endforeach



                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">Trước</span>
                                    <span class="sr-only">Sau</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
        <!-- end analytic  -->

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('js/app.js')}} "></script>
    <script type=”text/javascript” src=”http://code.jquery.com/jquery-2.0.3.min.js”></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
