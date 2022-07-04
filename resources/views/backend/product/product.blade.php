@extends('layouts.backend.master')
@section('content')

    <div class="container">
        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>
        @endif
        <h1>thêm sản phẩm</h1>


        <form action="{{route('store-product')}}" method="POST" files=true enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder='tên sản phẩm'>
                @error('name')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder='mã sản phẩm'>
                @error('code')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" id="desc" cols="30" rows="5">{{ old('desc') }} </textarea>

                @error('content')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="file" name="file" class="form-control-file" value="{{ old('file') }}">
            </div>
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder='giá sản phẩm'>
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="old_price" class="form-control" placeholder='giá cũ sản phẩm'>
            </div>
            <div class="form-group">
                <input type="text" name="amount" class="form-control" placeholder='số lượng'>
                @error('amount')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            {{--            <div class="form-group">--}}
            {{--                <label for="cat" class="font-weight-bold">Danh mục </label>--}}
            {{--                <select class="form-control" id="" name="cat">--}}
            {{--                    <option value=''>Chọn danh mục</option>--}}
            {{--                    @foreach($cats as $cat)--}}
            {{--                        <option value="{{$cat->id}}" @if($cat->id == old('cat'))--}}
            {{--                            selected='selected'--}}
            {{--                            @endif>{{str_repeat('-- ', $cat->level).' '.$cat->name}}</option>--}}
            {{--                    @endforeach--}}
            {{--                </select>--}}
            {{--                @error('cat')--}}
            {{--                <small class="text-danger">{{$message}}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}
            <div class="form-group">
                <input type="text" name="trademake" class="form-control" placeholder='thuong hieu'>
                @error('trademake')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="origin" class="form-control" placeholder='xuat xu'>
                @error('origin')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="size" class="form-control" placeholder='kich co'>
                @error('size')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="type_sole" class="form-control" placeholder='loai de giay'>
                @error('type_sole')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" name="sm-add" class=" btn-danger" value="Thêm mới">
            </div>
    </div>
@endsection
