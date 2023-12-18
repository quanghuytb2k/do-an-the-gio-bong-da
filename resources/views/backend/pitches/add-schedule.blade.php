@extends('layouts.backend.master')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <h1>Thêm lịch đá</h1>
        <div class="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
        <div class="modal" id="insertForm" tabindex="-1" role="dialog" data-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="date" id="date-start" name="date-start" class="form-control"
                                            readonly>
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
        </div>

        <div class="modal" id="editForm" tabindex="-1" role="dialog" data-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <h4 class="modal-title">Cập nhật lịch đá</h4>
                    </div>
                    <div class="modal-body overflow-auto">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ngày:</label>
                                        <input type="date" id="date-start-edit" name="date-start" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Trạng thái:</label>
                                        <select class="form-control" id="stadium-status-edit">
                                            <option value="1">Còn trống</option>
                                            <option value="2">Đang chọn</option>
                                            <option value="3">Đã đặt</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Chọn loại sân:</label>
                                        <select class="form-control" id="stadium-type-edit">
                                            <option value="1">Sân 5</option>
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
                            <div id="edit-calendar-form">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-submit-edit">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    var start_time = info.event.startStr;
                    var end_time = info.event.endStr;
                    var status = info.event.extendedProps.status;
                    var type = info.event.extendedProps.type;
                    var day_year = info.event.extendedProps.day;
                    var price = info.event.extendedProps.price;
                    var default_time_start = info.event.extendedProps.start;
                    var default_time_end = info.event.extendedProps.end;

                    // if (moment(end_time).format('YYYY-MM-DD H:mm') < moment().format('YYYY-MM-DD H:mm')) {
                    //     alertError("Không thể sửa lịch đá trước " + moment().format('YYYY-MM-DD H:mm'));
                    //     return;
                    // }
                    $('#date-start-edit').val(day_year);
                    $('#stadium-status-edit').val(status);
                    $('#stadium-type-edit').val(type);
                    $('#edit-calendar-form').html('');
                    $('#calendar-form').html('');
                    let append_form = ``;

                        append_form +=
                            `<div class="row" id="1">
                                <form>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Từ:</label>
                                            <input type="hidden" value="${event_id}" class="form-control" id="schedule_id">
                                            <input type="time" value="${default_time_start}" class="form-control" id="time_from-1" oninput="changeStartTime(1, true)">
                                            <span class="text-danger error-text time_from_error-1" style="font-size:15px"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Đến:</label>
                                            <input type="time" value="${default_time_end}" class="form-control" id="time_to-1" oninput="changeStartTime(1)">
                                            <span class="text-danger error-text time_to_error-1" style="font-size:15px"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Giá:</label>
                                            <input type="number" value="${price}" id="price-1" pattern="[0-9]*" class="form-control">
                                            <span class="text-danger error-text price_error-1" style="font-size:15px"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        `;
                    $('#edit-calendar-form').html(append_form);
                    $("#editForm").modal();
                },
                select: async function(info) {
                    info.start = moment(info.start).format('YYYY-MM-DD');
                    info.end = moment(info.end).format('YYYY-MM-DD');
                    if (info.start < moment().format('YYYY-MM-DD')) {
                        alertError("Không thể thêm lịch đá trước ngày " + moment().format('YYYY-MM-DD'));
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
                                            <input type="time" class="form-control" id="time_from-1" oninput="changeStartTime(1, true)">
                                            <span class="text-danger error-text time_from_error-1" style="font-size:15px"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Đến:</label>
                                            <input type="time" class="form-control" id="time_to-1" oninput="changeStartTime(1)">
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
                },

            });
            calendar.render();
        }

        function appendForm() {
            var get_form = document.querySelector('#calendar-form');
            let append_form = ``;
            append_form +=
                `<div class="row" id="${get_form.lastElementChild.id + 1}">
                <form>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Từ:</label>
                            <input type="time" class="form-control" id="time_from-${get_form.lastElementChild.id + 1}" oninput="changeStartTime(${get_form.lastElementChild.id + 1}, true)">
                            <span class="text-danger error-text time_from_error-${get_form.lastElementChild.id + 1}" style="font-size:15px"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Đến:</label>
                            <input type="time" class="form-control" id="time_to-${get_form.lastElementChild.id + 1}" oninput="changeStartTime(${get_form.lastElementChild.id + 1})">
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

        function changeStartTime(index, isStart = false){
            if(isStart){
                $(".time_from_error-" + index).html('');
            }else{
                $(".time_to_error-" + index).html('');
            }
        }

        function removeForm(id) {
            $('#' + id + '').remove();
        }

        // Thêm mới lịch đá
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
                if (!$('#time_from-' + child.id).val()) {
                    $('.time_from_error-' + child.id).html(
                        'Chưa chọn thời gian bắt đầu');
                    return;
                }
                if (!$('#time_to-' + child.id).val()) {
                    $('.time_to_error-' + child.id).html(
                        'Chưa chọn thời gian kết thúc');
                    return;
                }
                if (!$('#price-' + child.id).val()) {
                    $('.price_error-' + child.id).html('Chưa nhập giá tiền');
                    return;
                }
                form_data.push({
                    'date_start': $('#date-start').val(),
                    'time_from': $('#time_from-' + child.id).val(),
                    'time_to': $('#time_to-' + child.id).val(),
                    'price': $('#price-' + child.id).val(),
                })
            }

            $.ajax({
                url: "/add-soccer-schedule",
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                    day_year: date_start,
                    type: stadium_type,
                    data: form_data
                },
                success: function(data) {
                    if(data == 200){
                        alertSuccess("");
                        display_event();
                        $("#insertForm").modal('hide');
                    }else{
                        alertError("");
                    }

                },
            }).catch(error=>{
                if(error && error.responseJSON){
                    error.responseJSON.errors['data'].forEach(el => {
                        alertError(el);
                    });
                }
            });
        });

        // Cập nhật lịch đá
        $('#btn-submit-edit').on('click', function(event) {
            event.preventDefault();
            const schedule_id = $('#schedule_id').val();
            const stadium_type = $('#stadium-type-edit').val();
            const stadium_status = $('#stadium-status-edit').val();
            const form = document.getElementById('edit-calendar-form');
            let form_data = [];
            for (const child of form.children) {
                $('.time_from_error-' + child.id).html('');
                $('.time_to_error-' + child.id).html('');
                $('.price_error-' + child.id).html('');
                if (!$('#time_from-' + child.id).val()) {
                    $('.time_from_error-' + child.id).html(
                        'Chưa chọn thời gian bắt đầu');
                    return;
                }
                if (!$('#time_to-' + child.id).val()) {
                    $('.time_to_error-' + child.id).html(
                        'Chưa chọn thời gian kết thúc');
                    return;
                }
                if (!$('#price-' + child.id).val()) {
                    $('.price_error-' + child.id).html('Chưa nhập giá tiền');
                    return;
                }
                form_data.push({
                    'date_start': $('#date-start-edit').val(),
                    'time_from': $('#time_from-' + child.id).val(),
                    'time_to': $('#time_to-' + child.id).val(),
                    'price': $('#price-' + child.id).val(),
                })
            }
            $.ajax({
                url: "/edit-soccer-schedule",
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                    schedule_id: schedule_id,
                    type: stadium_type,
                    status: stadium_status,
                    data: form_data,
                    is_update: true,
                },
                success: function(data) {
                    if(data == 200){
                        alertSuccess("");
                        display_event();
                        $("#editForm").modal('hide');
                    }else if(data == 404){
                        alertError("Không tìm thấy");
                    }else{
                        alertError("");
                    }

                },
            }).catch(error=>{
                if(error && error.responseJSON){
                    error.responseJSON.errors['data'].forEach(el => {
                        alertError(el);
                    });
                }
            });
        });

        function alertSuccess(message) {
            swal("Thành công", message, "success");
        }

        function alertError(message){
            swal("Đã xảy ra lỗi!", message, "warning");
        }

    </script>
@endsection
