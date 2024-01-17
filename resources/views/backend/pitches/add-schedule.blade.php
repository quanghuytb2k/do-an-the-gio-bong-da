{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div>
    <h1 class="text-bold">Thêm lịch đá</h1>
    <button type="button" class="btn btn-primary" onclick="handleGenerateSchedule()">Tự động tạo lịch</button>
    <div class="row">
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>
    <div class="modal" id="generateForm" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title">
                        <b>
                            Tự động tạo lịch
                        </b>
                    </h4>
                    <p style="color:red">Các lịch được tạo tự động sẽ có thời gian là 1 tiếng rưỡi, và các lịch đá cách nhau 30 phút</p>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
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
                                <div class="form-group">
                                    <label>Giá:</label>
                                    <input type="text" id="price-generate" pattern="[0-9]*" class="form-control" oninput="localStringToNumber('price-generate')">
                                    <span class="text-danger error-text price_generate_error" style="font-size:15px"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="generate_time_from">Giờ bắt đầu:</label>
                                    <input type="time" class="form-control" id="generate_time_from">
                                    <span class="text-danger error-text generate-time-from-error" style="font-size:15px"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="generate_time_to">Giờ kết thúc:</label>
                                    <input type="time" class="form-control" id="generate_time_to">
                                    <span class="text-danger error-text generate-time-to-error" style="font-size:15px"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="generate_date_from">Từ:</label>
                                    <input type="date" class="form-control" id="generate_date_from">
                                    <span class="text-danger error-text generate-date-from-error" style="font-size:15px"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="generate_date_to">Đến:</label>
                                    <input type="date" class="form-control" id="generate_date_to">
                                    <span class="text-danger error-text generate-date-to-error" style="font-size:15px"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-generate">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="insertForm" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title">
                        <b>
                            Thêm mới lịch đá
                        </b>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="content" style="height:100%" id="new-form">
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
                                    <select class="form-control" id="stadium-type-create">
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="repeat">
                                    <label class="form-check-label" for="repeat">
                                        Lặp lại:
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none;" id="repeat-form">
                            <div style="display: flex; justify-content: space-between;" class="col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="monday" value="monday">
                                    <label class="form-check-label" for="monday">
                                        Thứ 2:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tuesday" value="tuesday">
                                    <label class="form-check-label" for="tuesday">
                                        Thứ 3:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wednesday" value="wednesday">
                                    <label class="form-check-label" for="wednesday">
                                        Thứ 4:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="thursday" value="thursday">
                                    <label class="form-check-label" for="thursday">
                                        Thứ 5:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="friday" value="friday">
                                    <label class="form-check-label" for="friday">
                                        Thứ 6:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="saturday" value="saturday">
                                    <label class="form-check-label" for="saturday">
                                        Thứ 7:
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sunday" value="sunday">
                                    <label class="form-check-label" for="sunday">
                                        Chủ nhật:
                                    </label>
                                </div>
                                <span class="text-danger error-text week-error" style="font-size:15px"></span>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Thời gian kết thực lặp lại:</label>
                                            <input type="date" class="form-control" id="repeat_time_to">
                                            <span class="text-danger error-text repeat-time-to-error" style="font-size:15px"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <div class="modal" id="editForm" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title text-bold">
                        <b>
                            Cập nhật lịch đá
                        </b>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ngày:</label>
                                    <input type="date" id="date-start-edit" name="date-start" class="form-control" readonly>
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
    $(document).ready(function() {
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

    function handleGenerateSchedule() {
        $('#generate_time_from').val('')
        $('#generate_time_to').val('')
        $('#generate_date_from').val('')
        $('#generate_date_to').val('')
        $('#price-generate').val('')

        $('.generate-time-from-error').html('');
        $('.generate-time-to-error').html('');
        $('.generate-date-from-error').html('');
        $('.generate-date-to-error').html('');

        $('#generateForm').modal()
    }

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
    function renderCalendar() {
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
            buttonText: {
                today: 'Hôm nay',
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                var event_id = info.event.id;
                var start_time = info.event.startStr;
                var end_time = info.event.endStr;
                var status = info.event.extendedProps.status;
                var type = info.event.extendedProps.type;
                var day_year = info.event.extendedProps.day;
                var price = info.event.extendedProps.price;
                price = new Intl.NumberFormat('en-US').format(+price);
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
                                            <input type="text" value="${price}" id="price-1" pattern="[0-9]*" class="form-control" onkeydown="keyDown(event)" oninput="localStringToNumber('price-1')">
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
                                            <input type="text" id="price-1" pattern="[0-9]*" class="form-control" oninput="localStringToNumber('price-1')">
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
                $('#repeat_time_to').val('');
                $('.repeat_time_to-error').html('');

                $('#repeat').prop('checked', false);
                $('#monday').prop('checked', false);
                $('#tuesday').prop('checked', false);
                $('#wednesday').prop('checked', false);
                $('#thursday').prop('checked', false);
                $('#friday').prop('checked', false);
                $('#saturday').prop('checked', false);
                $('#sunday').prop('checked', false);
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
                            <input type="text" id="price-${get_form.lastElementChild.id + 1}" pattern="[0-9]*" class="form-control" oninput="localStringToNumber('price-${get_form.lastElementChild.id + 1}')">
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

    function changeStartTime(index, isStart = false) {
        if (isStart) {
            $(".time_from_error-" + index).html('');
        } else {
            $(".time_to_error-" + index).html('');
        }
    }

    function removeForm(id) {
        $('#' + id + '').remove();
    }

    //Thêm nhiều lịch
    $('#repeat').on('change', function(event) {
        event.preventDefault()
        if (event.target.checked) {
            $('#repeat-form').show()
            // $('#new-form').css("height", "30vh")
        } else {
            $('#repeat-form').hide()
            // $('#new-form').css("height", "")
        }
    })

    $('#btn-generate').on('click', function(event) {
        event.preventDefault()
        const generate_time_from = $('#generate_time_from').val()
        const generate_time_to = $('#generate_time_to').val()
        const generate_date_from = $('#generate_date_from').val()
        const generate_date_to = $('#generate_date_to').val()
        const stadium_type = $('#stadium-type').val();
        const price = $('#price-generate').val().replaceAll(",", '');

        $('.generate-time-from-error').html('');
        $('.generate-time-to-error').html('');
        $('.generate-date-from-error').html('');
        $('.generate-date-to-error').html('');

        if (!generate_time_from) {
            return $('.generate-time-from-error').html('Chưa chọn thời gian bắt đầu');
        }
        if (!generate_time_to) {
            return $('.generate-time-to-error').html('Chưa chọn thời gian kết thúc');
        }
        if (!generate_date_from) {
            return $('.generate-date-from-error').html('Chưa chọn ngày bắt đầu');
        }
        if (!generate_date_to) {
            return $('.generate-date-to-error').html('Chưa chọn ngày kết thúc');
        }
        if (generate_time_from > generate_time_to) {
            return $('.generate-time-to-error').html('Thời gian kết thúc phải lớn hơn thời gian bắt đầu');
        }
        if (generate_date_from > generate_date_to) {
            return $('.generate-date-to-error').html('Ngày kết thúc phải lớn hơn ngày bắt đầu');
        }

        $.ajax({
            url: "/generate-soccer-schedule",
            type: "post",
            dataType: "json",
            data: {
                id: id,
                type: stadium_type,
                price: price,
                generate_time_from: generate_time_from,
                generate_time_to: generate_time_to,
                generate_date_from: generate_date_from,
                generate_date_to: generate_date_to
            },
            success: function(data) {
                if (data == 200) {
                    alertSuccess("");
                    display_event();
                    $('#generate_time_from').val('')
                    $('#generate_time_to').val('')
                    $('#generate_date_from').val('')
                    $('#generate_date_to').val('')
                    $("#generateForm").modal('hide');
                } else {
                    alertError("");
                }

            },
        }).catch(error => {
            if (error && error.responseJSON) {
                error.responseJSON.errors['data'].forEach(el => {
                    alertError(el);
                });
            }
        });
    })

    // Thêm mới lịch đá
    $('#btn-submit').on('click', function(event) {
        event.preventDefault();
        const date_start = $('#date-start').val();
        const stadium_type = $('#stadium-type-create').val();
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
                'price': $('#price-' + child.id).val().replaceAll(",", ''),
            })
        }
        const repeat = $('#repeat').is(':checked');

        const monday = $('#monday');
        const tuesday = $('#tuesday');
        const wednesday = $('#wednesday');
        const thursday = $('#thursday');
        const friday = $('#friday');
        const saturday = $('#saturday');
        const sunday = $('#sunday');

        const repeat_time_to = $('#repeat_time_to').val();

        let week = [];

        if (repeat) {
            if (!repeat_time_to) {
                $('.repeat-time-to-error').html(
                    'Chưa chọn thời gian kết thúc lặp');
                return;
            } else {
                $('.repeat-time-to-error').html('');
            }
            if (monday.is(':checked')) {
                week.push(monday.val())
            }
            if (tuesday.is(':checked')) {
                week.push(tuesday.val())
            }
            if (wednesday.is(':checked')) {
                week.push(wednesday.val())
            }
            if (thursday.is(':checked')) {
                week.push(thursday.val())
            }
            if (friday.is(':checked')) {
                week.push(friday.val())
            }
            if (saturday.is(':checked')) {
                week.push(saturday.val())
            }
            if (sunday.is(':checked')) {
                week.push(sunday.val())
            }
            if(week.length <=0 ){
                $('.week-error').html(
                    'Vui lòng chọn các ngày lặp lại trong tuần');
                return;
            }
        }

        $.ajax({
            url: "/add-soccer-schedule",
            type: "post",
            dataType: "json",
            data: {
                id: id,
                day_year: date_start,
                type: stadium_type,
                data: form_data,
                repeat: repeat,
                repeat_info: {
                    time_to: repeat_time_to,
                    week: week,
                }
            },
            success: function(data) {
                if (data == 200) {
                    alertSuccess("");
                    display_event();
                    $("#insertForm").modal('hide');
                    $('#repeat-form').hide();
                } else {
                    alertError("");
                }

            },
        }).catch(error => {
            if (error && error.responseJSON) {
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
                'price': $('#price-' + child.id).val().replaceAll(",", ''),
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
                if (data == 200) {
                    alertSuccess("");
                    display_event();
                    $("#editForm").modal('hide');
                } else if (data == 404) {
                    alertError("Không tìm thấy");
                } else {
                    alertError("");
                }

            },
        }).catch(error => {
            if (error && error.responseJSON) {
                error.responseJSON.errors['data'].forEach(el => {
                    alertError(el);
                });
            }
        });
    });

    function alertSuccess(message) {
        swal("Thành công", message, "success");
    }

    function alertError(message) {
        swal("Đã xảy ra lỗi!", message, "warning");
    }

    function keyDown(evt) {
        if ((evt.keyCode < 48 || evt.keyCode > 57) && evt.keyCode != 8 && evt.keyCode != 13) {
            evt.preventDefault();
        }
    }

    function localStringToNumber(id) {
        var number = $('#' + id).val();
        number = number.replaceAll(",", '');
        var format_number = new Intl.NumberFormat('en-US').format(+number);
        $('#' + id).val(format_number);
    }
</script>
@endsection
