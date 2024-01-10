{{-- @extends('layouts.backend.master') --}}\
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="header font-weight-bold">
            Thêm gói dịch vụ
        </div>
        <div class="content">
            <form action="{{url('admin/services-pack/store')}} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên gói</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit">Giá tiền</label>
                    <input type="text" name="price" id="price" class="form-control" oninput="localStringToNumber('price')">
                </div>
                <div class="form-group">
                    <label for="unit">Loại gói</label>
                    <select class="form-control" id="unit" name="unit">
                        <option value="">Chọn gói</option>
                        <option value="{{App\ServicePack::PACK_WEEK_VALUE}}">Theo tuần</option>
                        <option value="{{App\ServicePack::PACK_MONTH_VALUE}}">Theo tháng</option>
                        <option value="{{App\ServicePack::PACK_YEAR_VALUE}}">Theo năm</option>
                    </select>
                    @error('unit')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit">Dịch vụ</label>
                    <select class="form-control" id="service" name="service">
                        <option value="">Chọn dịch vụ</option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                    @error('service')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function localStringToNumber(id){
        var number = $('#' + id).val();
        number = number.replaceAll(",", '');
        var format_number = new Intl.NumberFormat('en-US').format(+number);
        $('#' + id).val(format_number);
    }
</script>
@endpush

