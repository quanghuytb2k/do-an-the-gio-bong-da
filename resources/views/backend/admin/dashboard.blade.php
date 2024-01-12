
    {{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-white bg-primary mb-3" style="padding: 10px !important">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title text-info">{{$count_orders_process ? number_format($count_orders_process, 0, ',', '.') : 0}}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-danger mb-3" style="padding: 10px !important">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{$count_orders_transport ? number_format($count_orders_transport, 0, ',', '.') : 0}}</h5>
                        <p class="card-text">Số lượng đơn hàng đang chưa thanh toán</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card text-white bg-success mb-3" style="padding: 10px !important">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title text-success">{{$proceeds ? number_format($proceeds, 0, ',', '.') : 0}}</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-dark mb-3" style="padding: 10px !important">
                    <div class="card-header">Tổng đơn hàng</div>
                    <div class="card-body">
                        <h5 class="card-title text-info">{{$count_orders_success ? number_format($count_orders_success, 0, ',', '.') : 0}}</h5>
                        <p class="card-text">Số đơn hàng trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="content">
            <div class="fresh-datatables">


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">email</th>
                        <th scope="col">Tên sân</th>
                        <th scope="col">Chủ sân</th>
                        <th scope="col">Giá tiền sân</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Chi tết</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $items = DB::table('order_pitch')->orderBy('order_pitch.id', 'desc')
                                ->join('football_pitches', 'order_pitch.pitch_id', '=', 'football_pitches.id');
                        if(auth()->user()->role == App\User::USER_CUSTOMER_ROLE){
                            $items = $items->where('football_pitches.user_id', auth()->user()->id);
                        }
                        $items = $items->select('order_pitch.*')->get();
                    @endphp
                    @foreach ($items as $item ) @php
                            $pitches = DB::table('football_pitches')->where('id',$item->pitch_id)->first();
                        @endphp

                    <tr>
                        <td scope="col"></td>
                        <td>
                            {{$item->name_customer}} <br>
                            {{$item->phone}}
                        </td>
                        <td>{{$item->email}}</td>
                        <td>{{$pitches->name_pitch ?? null }}</td>
                        <td>{{$pitches->name ?? null}}</td>
                        <td>{{$item->price ? number_format($item->price, 0, ',', '.') : null}}</td>
                        <td>{{$item->created_at}}</td>
                        <td><a href="{{route('admin-detail-order',$item->id)}}">Chi tiết</a></td>
                        <td>
                            @if($item->status)
                                <span class="badge badge-danger text-dark">Đã hủy</span>
                            @else
                                <span class="badge badge-success text-dark">Đã thanh toán</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin-edit-pitches',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(!$item->status)
                                <a href="javascript:void(0)" onclick="cancel({{$item->id}})" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Cancel">
                                    <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('css')
<style>
    .badge-success{
        background-color: #dff0d8 !important;
    }
    .badge-danger {
        background-color: #f2dede !important;
    }
    .text-dark{
        color: #000000 !important;
    }
</style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });

        function cancel(id) {
            $.ajax({
                url: "/cancel-order",
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                },
                success: function(data) {
                    let message = data.message ? data.message : null;
                    if(data.code == 200){
                        location.reload();
                        alertSuccess(message);
                    }else if(data.code == 404){
                        alertError("Không tìm thấy");
                    }else{
                        alertError(message);
                    }

                },
            }).catch(error=>{
                if(error && error.responseJSON){
                    error.responseJSON.errors['data'].forEach(el => {
                        alertError(el);
                    });
                }
            });
        }

        function alertSuccess(message) {
            swal("Thành công", message, "success");
        }

        function alertError(message){
            swal("Đã xảy ra lỗi!", message, "warning");
        }
    </script>
@endpush
