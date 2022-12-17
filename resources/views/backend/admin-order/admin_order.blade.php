@extends('layouts.backend.master')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật đơn hàng
        </div>
        <div class="card-body">
            <form action='{{route('update_order',$order->id)}} ' method="POST" files = true enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">Mã đơn hàng</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{$order->id}}" readonly="readonly">
                            @error('id')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer">Tên khách hàng</label>
                            <input class="form-control" type="text" name="customer" id="customer" value="{{$order->name}}" readonly="readonly">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{$order->phonenumber}}">
                            @error('phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{$order->email}}" readonly="readonly">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input class="form-control" type="text" name="addres" id="addres" value="{{$order->addres}}">
                            @error('addres')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_qty">Số lượng</label>
                            <input class="form-control" type="text" name="soluong" id="soluong" value="{{$order->soluong}}" readonly="readonly">
                            @error('soluong')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="đang xử lý" @if($order->status=='đang sử lý')
                                checked
                            @endif
                             @if(old('status') =='đang sử lý') checked @endif>
                                <label class="form-check-label" for="status1">
                                    Đang sử lý
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status2" value="đang vận chuyển" @if($order->status=='đang vận chuyển')
                                checked
                            @endif
                             @if(old('status')== 'đang vận chuyển') checked @endif>
                                <label class="form-check-label" for="status2">
                                    Đang vận chuyển
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status3" value="Hoàn thành" @if($order->status=='Hoàn thành')
                                checked
                            @endif
                             @if(old('status')== 'Hoàn thành') checked @endif>
                                <label class="form-check-label" for="status3">
                                    Hoàn thành
                                </label>
                            </div>
                            @error('status')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@endsection
