@extends('layouts.backend.master')
@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
    <div class="container">
        <h1>Thêm sân bóng</h1>
        <form action="{{route('store-pitches')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nhập tên sân bóng</label>
                        <input type="text" name="name_pitches" class="form-control" placeholder='Nhập tên sân bóng'>
                        @error('name_pitches')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                        <div class="form-col " style="width: 100%;
                        padding-right: 0;">
                            <label for="addres">Địa chỉ</label>
                            <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                                <label for="province">Tỉnh/Thành Phố</label>
                                <select name="province" class="province form-control" id="province">
                                    <option value="">-- Chọn Tỉnh/Thành Phố--</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->name}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                                <label for="district">Quận/Huyện</label>
                                <select name="district" class="district form-control" id="district">
                                    <option value="">-- Chọn Quận/Huyện --</option>
                                </select>
                            </div>
                            <div class="form-col fl-left" style="width: 100%;
                            padding-right: 0;">
                                <label for="commune">Xã/Phường</label>
                                <select name="commune" class="commune form-control">
                                    <option value="">-- Chọn Xã/Phường --</option>
                                </select>
                            </div>

                    </div>
                    <div class="form-group">
                        <label for="images">Hình ảnh sân bóng</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="description">Miêu tả sân bóng</label>
                        <textarea name="description" class="form-control" id="description" cols="30"
                                  rows="5">{{ old('description') }} </textarea>

                        @error('description')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="price">Gía sân</label>--}}
{{--                        <input type="text" name="price" class="form-control" placeholder='giá sân bóng'>--}}
{{--                        @error('price')--}}
{{--                        <small class="form-text text-danger">{{$message}}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên chủ sân</label>
                        <input type="text" name="name" class="form-control" placeholder='Tên chủ sân'>
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại chủ sân</label>
                        <input type="telephone" name="telephone" class="form-control"
                               placeholder='Số điện thoại chủ sân '>
                        @error('telephone')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email chủ sân</label>
                        <input type="email" name="email" class="form-control"
                               placeholder='Số điện thoại chủ sân '>
                        @error('telephone')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group booking-date" id="5">
                        <label for="">Khung giờ đá của sân</label><br>
                        <label for="start">Ngày chọn sân</label>
                        <input type="date" id="start" multiple="multiple" name="date"><br><br>
                        <label for="">Giờ bắt đầu sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-start" name="time_start[]">
                        <label for="">Giờ kết thúc sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-end" name="time_end[]">
                        <label for="" style="margin-left: 160px">Gía sân</label>
                        <input class="pitches-price" type="text" id="pitches-price" name="price[]">
                        <hr>
                        <p id="add-time"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" name="sm-add" class="fbtn btn-danger" value="Thêm mới">
                </div>
            </div>
        </form>
    </div>

    <script>
        $('#add-time').on('click', function () {
            var input_time = document.getElementsByName("time");
            let html = '';
            html += `
                        <hr>
                        <label for="">Giờ bắt đầu sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-start" name="time_start[]">
                        <label for="">Giờ kết thúc sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-end" name="time_end[]">
                        <label for="" style="margin-left: 110px">Gía sân</label>
                        <input class="pitches-price" type="text" id="pitches-price" name="price[]">

                    `;
            $("#pitches-price").after(html);

        });

        $("#province").change(function (){
            var _token = $('input[name="_token"]').val();
            var province = $(this).val();
            var data = {province: province, _token:_token};
            console.log(data);
            $.ajax({
                url: "{{route('district')}}",
                method: 'POST',
                data: data,
                dataType: 'json',
                success:function(data){
                    $('.district').html(data);
                }
            });
        });
        $("#district").change(function(){
            var _token = $('input[name="_token"]').val();
            var commune = $(this).val();
            var data = {commune:commune, _token:_token};
            $.ajax({
                url:"{{route('commune')}}",
                method :'POST',
                data:data,
                dataType: 'json',
                success:function(data){
                    $('.commune').html(data);
                }
            });
        });

    </script>

@endsection
