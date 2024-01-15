{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')

<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="card text-white bg-primary mb-3" style="padding: 10px !important">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title text-info">2.680</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-white bg-danger mb-3" style="padding: 10px !important">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title text-warning">10</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card text-white bg-success mb-3" style="padding: 10px !important">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title text-success">2.5 tỷ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-white bg-dark mb-3" style="padding: 10px !important">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title text-danger">125</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom:30px">
        <button type="button" class="btn btn-primary" onclick="openModal()">Thiết lập giá giờ cao điểm, cuối tuần</button>
    </div>
    <div class="modal" id="price-modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title">
                        <b>
                            Thiết lập giá giờ cao điểm, cuối tuần
                        </b>
                    </h4>
                </div>
                <div class="modal-body" style="height: 20vh;">
                    <div class="content" style="display:flex; flex-direction:column">
                        <div class="col-lg-6">
                            <label>Giá giờ cao điểm (% tăng so với thường):</label>
                            <input value="{{$priceSetup->price_peak}}" type="text" id="price-peak" pattern="[0-9]*" class="form-control" oninput="localStringToNumber('price-peak')">
                            <span class="text-danger error-text price_peak_error" style="font-size:15px"></span>
                        </div>
                        <div class="col-lg-6">
                            <label>Giá cuối tuần (% tăng so với thường):</label>
                            <input value="{{$priceSetup->price_weekend}}" type="text" id="price-weekend" pattern="[0-9]*" class="form-control" oninput="localStringToNumber('price-weekend')">
                            <span class="text-danger error-text price_weekend_error" style="font-size:15px"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-setup-price">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        {{-- <div class="card-header font-weight-bold">
                Danh sách sân bóng
            </div> --}}
        <div class="header">
            <legend>Danh sách sân bóng</legend>
        </div>
        <div class="content">
            <div class="fresh-datatables">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sân</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Miêu tả</th>
                            <th scope="col">Tên chủ sân</th>
                            <th scope="col"> Chi tết </th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $items = DB::table('checkouts')->get();
                        $stt = 0;
                        @endphp
                        @foreach ($pitches as $item ) @php
                        $stt ++ ;
                        @endphp



                        <tr>
                            {{-- <th scope="row">{{$stt}} </th> --}}
                            <th scope="row"></th>
                            <td>{{$item->name_pitch}}</td>
                            <td>
                                {{$item->address}}
                            </td>
                            <td>{!!$item->description!!}</a></td>
                            <td>{{$item->name}}</td>
                            <td><a href="{{route("admin-list-pitches",$item->id)}}">Chi tiết</a></td>
                            <td>
                                <a href="{{ route('add-soccer-schedule', $item->id) }}" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Add calendar"><i class="fa fa-plus"></i></a>
                                <a href="{{route("edit-pitches",$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="removePitches({{$item->id}})" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $('.table').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Tất cả"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Tìm kiếm",
            }

        });
    });

    function openModal() {
        $('#price-modal').modal()
    }

    function removePitches(id) {
        $.ajax({
            url: "/remove-pitches",
            type: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                let message = data.message ? data.message : null;
                if (data.code == 200) {
                    location.reload();
                    alertSuccess(message);
                } else {
                    alertError(message);
                }

            },
        }).catch(error => {
            if (error && error.responseJSON) {
                error.responseJSON.errors['data'].forEach(el => {
                    alertError(el);
                });
            }
        });
    }

    function alertSuccess(message) {
        swal("Thành công", message, "success");
    }

    function alertError(message) {
        swal("Đã xảy ra lỗi!", message, "warning");
    }

    function localStringToNumber(id) {
        var number = $('#' + id).val();
        number = number.replaceAll(",", '');
        var format_number = new Intl.NumberFormat('en-US').format(+number);
        $('#' + id).val(format_number);
    }

    $('#btn-setup-price').on('click', function(event) {
        event.preventDefault();
        const price_peak = $('#price-peak').val();
        const price_weekend = $('#price-weekend').val();
        $('.price_peak_error').html('');
        $('.price_weekend_error').html('');
        if(!price_peak){
            $('.price_peak_error').html('Vui lòng nhập giá giờ cao điểm');
        }
        if(!price_weekend){
            $('.price_weekend_error').html('Vui lòng nhập giá cuối tuần');
        }
        $.ajax({
            url: "/setup-price",
            type: "post",
            dataType: "json",
            data: {
                price_peak: price_peak,
                price_weekend: price_weekend
            },
            success: function(data) {
                if (data == 200) {
                    alertSuccess("");
                    $('#price-modal').modal('hide')
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
</script>
@endpush