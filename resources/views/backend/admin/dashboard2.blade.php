{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-white bg-primary mb-3" style="padding: 10px !important">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">2.680</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-danger mb-3" style="padding: 10px !important">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">10</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card text-white bg-success mb-3" style="padding: 10px !important">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">2.5 tỷ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-dark mb-3" style="padding: 10px !important">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">125</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
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
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col"> Chi tết </th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $items = DB::table('checkouts')->get();
                            // $stt = 0;
                        @endphp
                        @foreach ($items as $item ) @php
                            // $stt ++ ;
                        @endphp



                        <tr>
                            <th scope="row"></th>
                            <td>{{$item->code}}</td>
                            <td>
                                {{$item->name}} <br>
                                {{$item->phonenumber}}
                            </td>
                            <td><a href="#">{{$item->product}}</a></td>
                            <td>{{$item->soluong}}</td>
                            <td>{{$item->giatri}}</td>
                            <td><span class="badge badge-warning">{{$item->status}}</span></td>
                            <td>{{$item->created_at}}</td>
                            <td><a href="{{route('detail',$item->id)}}">Chi tiết</a></td>
                            <td>
                                <a href="{{route('admin_order',$item->id)}} " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
                {{-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Trước</span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>

    </div>
@endsection

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
        });
    </script>
@endpush
