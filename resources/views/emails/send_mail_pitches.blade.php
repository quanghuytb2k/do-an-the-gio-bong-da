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

    <title>Admintrator</title>
</head>
<body>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content-detail" class="detail-exhibition">
            <div class="section" id="info">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <ul class="list-item">
                    <li>
                        <h4 class="title">Mã đơn hàng</h4>
                        <span class="detail text-success">{{$pitches->id}}</span>
                    </li>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Thông tin sân đặt</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                        <tr>
                            <th class="thead-text">STT</th>
                            <th class="thead-text">Tên người đặt sân</th>
                            <th class="thead-text">email</th>
                            <th class="thead-text">Tên sân</th>
                            <th class="thead-text">Địa chỉ</th>
                            <th class="thead-text">Tổng gía tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $ordinal=0;
                        @endphp
                        @foreach($pitch as $item)
                            @php
                                $ordinal++;
                            @endphp
                            <tr>
                                <td class="thead-text">{{$ordinal}}</td>
                                <td class="thead-text">{{$pitches->name_customer}}</td>
                                <td class="thead-text">{{$item->name_pitch}}</td>
                                <td class="thead-text">{{$item->address}}</td>
                                <td class="thead-text">{{$item->email}}</td>
                                <td class="thead-text">{{number_format($pitches->price)}} VNĐ</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<body>
