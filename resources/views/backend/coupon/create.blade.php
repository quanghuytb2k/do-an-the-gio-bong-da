{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm mã khuyễn mãi
        </div>
        <div class="card-body">
            <form action="{{ route('coupon.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên mã khuyễn mãi</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="code">Mã khuyến mãi</label>
                    <input class="form-control" type="text" name="code" id="code">
                </div>
                <div class="form-group">
                    <label for="quantily">Số lượng</label>
                    <input class="form-control" type="quantily" name="quantily" id="quantily">
                </div>
                <div class="form-group">
                    <label for="feature">Số tiền hoặc số phần trăm giảm</label>
                    <input class="form-control" type="feature" name="feature" id="feature">
                </div>

                <div class="form-group">
                    <label for="">loại tính năng giảm</label>
                    <select class="form-control" id="" name="condition">
                        <option >Chọn loại giảm giá</option>
                        <option value="1">Giảm giá theo %</option>
                        <option value="2">Giảm giá theo tiền mặt</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="time_start">Ngày bất đầu</label>
                    <input class="form-control" type="date" name="time_start" id="time_start">
                </div>
                <div class="form-group">
                    <label for="time_end">Ngày kết thúc</label>
                    <input class="form-control" type="date" name="time_end" id="time_end">
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection

