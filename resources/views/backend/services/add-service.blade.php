{{-- @extends('layouts.backend.master') --}}\
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="header font-weight-bold">
            Thêm dịch vụ
        </div>
        <div class="content">
            <form action="{{url('admin/services/store')}} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên dịch vụ</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <input class="form-control" type="text" name="description" id="description">
                    @error('description')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection

