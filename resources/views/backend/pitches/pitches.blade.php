{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
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
                        <input type="text" name="name_pitches" id="name_pitches" class="form-control" placeholder='Nhập tên sân bóng'>
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
                                <select name="commune" class="commune form-control" id="commune">
                                    <option value="">-- Chọn Xã/Phường --</option>
                                </select>
                            </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên chủ sân</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder='Tên chủ sân'>
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại chủ sân</label>
                        <input type="telephone" name="telephone" id="telephone" class="form-control"
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
                    <div class="form-group">
                        <label for="images">Hình ảnh sân bóng</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <label for="images">Lịch đá</label>
                    <div id='calendar'></div>

                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <input type="submit" onclick="createStadium()" name="sm-add" class="fbtn btn-danger" value="Thêm mới"> --}}
                        <input type="submit" name="sm-add" class="fbtn btn-success" value="Thêm mới">
                    </div>
                </div>
            </div>
        </form>
        {{-- <div class="modal" id="insertForm" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <h4 class="modal-title">Thêm mới lịch đá</h4>
                    </div>
                    <div class="modal-body overflow-auto">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ngày:</label>
                                        <input type="date" id="date-start" name="date-start" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Chọn loại sân:</label>
                                        <select class="form-control" id="stadium-type">
                                            <option value="2">Sân 7</option>
                                            <option value="3">Sân 11</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Chọn giờ</p>
                                </div>
                            </div>
                            <div id="calendar-form">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-submit">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div> --}}
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

{{-- <script>
    var list_data;
    var list_new_data;
    document.addEventListener('DOMContentLoaded', function () {
        display_event();
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "vi",
            events: list_data,
            editable: true,
            selectable: true,
            dayMaxEvents: true,
            displayEventTime: false,
            eventDisplay: 'block',
            // dateClick: function(info) {
            //     console.log('date click', info);
            // },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                var event_id = info.event.id;
                var start_time = info.event.startStr;
                var end_time = info.event.endStr;
                var status = info.event.extendedProps.status;
                console.log('id:', event_id,
                    'start_time:', moment(start_time).format('H:mm'),
                    'end_time:', moment(end_time).format('H:mm'),
                    'status', status);
            },
            select: async function (info) {
                info.start = moment(info.start).format('YYYY-MM-DD');
                info.end = moment(info.end).format('YYYY-MM-DD');
                if(info.start < moment().format('YYYY-MM-DD')){
                    swal("Đã xảy ra lỗi!", "Không thể thêm lịch đá trước ngày " + moment().format('YYYY-MM-DD'), "warning");
                    return;
                }
                $('#stadium-type').val(2);
                $('#date-start').val(info.start);
                let append_form = ``;

                append_form +=
                    `<div class="row" id="1">
                        <form>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Từ:</label>
                                    <input type="time" class="form-control" id="time_from-1">
                                    <span class="text-danger error-text time_from_error-1" style="font-size:15px"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Đến:</label>
                                    <input type="time" class="form-control" id="time_to-1">
                                    <span class="text-danger error-text time_to_error-1" style="font-size:15px"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Giá:</label>
                                    <input type="number" id="price-1" pattern="[0-9]*" class="form-control">
                                    <span class="text-danger error-text price_error-1" style="font-size:15px"></span>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <i class="fa fa-plus-circle" onclick="appendForm()"></i>
                            </div>
                        </form>
                    </div>
                `;
                $('#calendar-form').html(append_form);

                $("#insertForm").modal();

                $('#btn-submit').on('click', function(event) {
                    event.preventDefault();
                    const date_start = $('#date-start').val();
                    const stadium_type = $('#stadium-type').val();
                    const form = document.getElementById('calendar-form');
                    let form_data = [];
                    for (const child of form.children) {
                        $('.time_from_error-' + child.id).html('');
                        $('.time_to_error-' + child.id).html('');
                        $('.price_error-' + child.id).html('');
                        if(!$('#time_from-' + child.id).val()){
                            $('.time_from_error-' + child.id).html('Chưa chọn thời gian bắt đầu');
                            return;
                        }
                        if(!$('#time_to-' + child.id).val()){
                            $('.time_to_error-' + child.id).html('Chưa chọn thời gian kết thúc');
                            return;
                        }
                        if(!$('#price-' + child.id).val()){
                            $('.price_error-' + child.id).html('Chưa nhập giá tiền');
                            return;
                        }
                        form_data.push({
                            'date_start' : $('#date-start').val(),
                            'time_from' : $('#time_from-' + child.id).val(),
                            'time_to' : $('#time_to-' + child.id).val(),
                            'price' : $('#price-' + child.id).val(),
                        })
                        calendar.addEvent({
                            title: $('#time_from-' + child.id).val() + ' - ' + $('#time_to-' + child.id).val(),
                            start: date_start + " " + $('#time_from-' + child.id).val(),
                            end: date_start + " " + $('#time_to-' + child.id).val(),
                            color: "green",
                        });
                        console.log(123123, form_data)
                    }
                    calendar.refetchEvents();
                    $("#insertForm").modal('hide');
                });
            },

        });
        calendar.render();
    });

    function display_event() {
        var stadium_id = Math.floor(Math.random() * (5 - 1)) + 1;
        let searchParams = new URLSearchParams(window.location.search);
        if(searchParams.has('id')){
            let param = searchParams.get('id');
            stadium_id = param ? param :stadium_id;
        }
        data.forEach(el => {
            if(el.id == stadium_id && el.details){
                list_data = el.details;
                var findType = type_options.find(option => option.id == el.type);
                $('.stadium-name').html(el.name);
                $('.stadium-address').html(el.address);
                $('.stadium-type').html(findType && findType.name ? 'Loại: ' + findType.name : null);
                $('.stadium-rate').html('Đánh giá: ');
                var stadium_available = 0;
                var stadium_ordered = 0;
                var stadium_choosing = 0;
                el.details.forEach(detail => {
                    stadium_available += detail.status == 1 ? 1 : 0;
                    stadium_ordered += detail.status == 2 ? 1 : 0;
                    stadium_choosing += detail.status == 3 ? 1 : 0;
                });
                $('#status-available-number').html('(' + stadium_available + ')');
                $('#status-ordered-number').html('(' + stadium_ordered + ')');
                $('#status-choosing-number').html('(' + stadium_choosing + ')');
            }
        });
    }

    function appendForm(){
        var get_form = document.querySelector('#calendar-form');
        let append_form = ``;
        append_form +=
            `<div class="row" id="${get_form.lastElementChild.id + 1}">
                <form>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Từ:</label>
                            <input type="time" class="form-control" id="time_from-${get_form.lastElementChild.id + 1}">
                            <span class="text-danger error-text time_from_error-${get_form.lastElementChild.id + 1}" style="font-size:15px"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Đến:</label>
                            <input type="time" class="form-control" id="time_to-${get_form.lastElementChild.id + 1}">
                            <span class="text-danger error-text time_to_error-${get_form.lastElementChild.id + 1}" style="font-size:15px"></span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Giá:</label>
                            <input type="number" id="price-${get_form.lastElementChild.id + 1}" pattern="[0-9]*" class="form-control">
                            <span class="text-danger error-text price_error-${get_form.lastElementChild.id + 1}" style="font-size:15px"></span>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <i class="fa fa-trash" onclick="removeForm(${get_form.lastElementChild.id + 1})"></i>
                    </div>
                </form>
            </div>
        `;
        $('#calendar-form').append(append_form);
    }

    function removeForm(id){
        $('#' + id + '').remove();
    }

    function addStadiumType(){
        $("#insertFormType").modal();
        $("#insertForm").modal('hide');
    }

    function showModalInsertCalendar(){
        $("#insertForm").modal();
        $("#insertFormType").modal('hide');
    }

    function createStadiumType(){
        var name = $('#type_name').val();
        var description = $('#type_description').val();
        alertSuccess("Thêm loại sân thành công");
        showModalInsertCalendar();
    }

    function alertSuccess(message){
        swal("Thành công", message, "success");
    }

    function createStadium() {
        var name =
        alertSuccess("Thêm thành công sân bóng mới");
    }

    var data = [
        {
            id: 1,
            name: "Sân bóng 1",
            address: "158 Phạm Văn Đồng",
            type: 1,
            details: [
                {
                    id: 1,
                    title: "08:00 - 10:00 (Sân 5)",
                    start: "2023-12-01 08:00",
                    end: "2023-12-01 10:00",
                    backgroundColor: "gray",
                    borderColor: "gray",
                    extendedProps: {
                        type: 1,
                        status: 1,
                    },
                },
                {
                    id: 2,
                    title: "10:00 - 10:30 (Sân 5)",
                    start: "2023-12-01 10:00",
                    end: "2023-12-01 10:30",
                    color: "gray",
                    extendedProps: {
                        type: 1,
                        status: 1,
                    },
                },
                {
                    id: 3,
                    title: "11:00 - 11:30 (Sân 5)",
                    start: "2023-12-01 11:00",
                    end: "2023-12-01 11:30",
                    color: "gray",
                    extendedProps: {
                        type: 1,
                        status: 1,
                    },
                },
                {
                    id: 4,
                    title: "14:00 - 15:00 (Sân 5)",
                    start: "2023-12-01 14:00",
                    end: "2023-12-01 15:00",
                    color: "gray",
                    extendedProps: {
                        type: 1,
                        status: 1,
                    },
                },
                {
                    id: 5,
                    title: "13:00 - 15:00 (Sân 5)",
                    start: "2023-12-01 13:00",
                    end: "2023-12-01 15:00",
                    color: "gray",
                    extendedProps: {
                        type: 1,
                        status: 1,
                    },
                },
                {
                    id: 6,
                    title: "16:00 - 17:00 (Sân 5)",
                    start: "2023-12-05 16:00",
                    end: "2023-12-05 17:00",
                    color: "green",
                    extendedProps: {
                        type: 1,
                        status: 3,
                    },
                },
                {
                    id: 7,
                    title: "08:00 - 10:00 (Sân 5)",
                    start: "2023-12-23 08:00",
                    end: "2023-12-23 10:00",
                    color: "red",
                    extendedProps: {
                        type: 1,
                        status: 2,
                    },
                },
            ],
        },
        {
            id: 2,
            name: "Sân bóng 2",
            address: "158 Phạm Văn Đồng",
            type: 3,
            details: [
                {
                    id: 1,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-07",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 2,
                    title: "13:00 - 15:00 (Sân 11)",
                    start: "2023-12-01",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 3,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-16",
                    color: "green",
                    extendedProps: {
                        type: 1,
                        status: 3,
                    },
                },
                {
                    id: 4,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-29",
                    color: "red",
                    extendedProps: {
                        type: 1,
                        status: 2,
                    },
                },
            ],
        },
        {
            id: 3,
            name: "Sân bóng 3",
            address: "158 Phạm Văn Đồng",
            type: 1,
            details: [
                {
                    id: 1,
                    title: "08:00 - 10:00 (Sân 5)",
                    start: "2023-12-24",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 2,
                    title: "13:00 - 15:00 (Sân 5)",
                    start: "2023-12-09",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 3,
                    title: "08:00 - 10:00 (Sân 5)",
                    start: "2023-12-02",
                    color: "green",
                    extendedProps: {
                        type: 1,
                        status: 3,
                    },
                },
                {
                    id: 4,
                    title: "08:00 - 10:00 (Sân 5)",
                    start: "2023-12-10",
                    color: "red",
                    extendedProps: {
                        type: 1,
                        status: 2,
                    },
                },
            ],
        },
        {
            id: 4,
            name: "Sân bóng 4",
            address: "158 Phạm Văn Đồng",
            type: 3,
            details: [
                {
                    id: 1,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-03",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 2,
                    title: "13:00 - 15:00 (Sân 11)",
                    start: "2023-12-01",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 3,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-06",
                    color: "green",
                    extendedProps: {
                        type: 1,
                        status: 3,
                    },
                },
                {
                    id: 4,
                    title: "08:00 - 10:00 (Sân 11)",
                    start: "2023-12-10",
                    color: "red",
                    extendedProps: {
                        type: 1,
                        status: 2,
                    },
                },
            ],
        },
        {
            id: 5,
            name: "Sân bóng 5",
            address: "158 Phạm Văn Đồng",
            type: 2,
            details: [
                {
                    id: 1,
                    title: "08:00 - 10:00 (Sân 7)",
                    start: "2023-12-01",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 2,
                    title: "13:00 - 15:00 (Sân 7)",
                    start: "2023-12-10",
                    color: "gray",
                    status: 1,
                },
                {
                    id: 3,
                    title: "08:00 - 10:00 (Sân 7)",
                    start: "2023-12-05",
                    color: "green",
                    extendedProps: {
                        type: 1,
                        status: 3,
                    },
                },
                {
                    id: 4,
                    title: "08:00 - 10:00 (Sân 7)",
                    start: "2023-12-07",
                    color: "red",
                    extendedProps: {
                        type: 1,
                        status: 2,
                    },
                },
            ],
        },
    ];

    var type_options = [
        { id: 1, name: "Sân 5" },
        { id: 2, name: "Sân 7" },
        { id: 3, name: "Sân 11" },
    ];

    var list_times = [
        { id: 1, name: "00:00" },
        { id: 2, name: "00:30" },
        { id: 3, name: "01:00" },
        { id: 4, name: "01:30" },
        { id: 5, name: "02:00" },
        { id: 6, name: "02:30" },
        { id: 7, name: "03:00" },
        { id: 8, name: "03:30" },
        { id: 9, name: "04:00" },
    ];

</script> --}}

@endsection
