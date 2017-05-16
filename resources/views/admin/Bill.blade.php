@extends('admin.master')
@section('content')
    <script>
        document.getElementById("Bills").className += " active";
        document.getElementById("Dashboard").className -= "active";
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Icons</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh Sách Các Đơn Đặt Hàng</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-hover">
                            <thead>
                            <tr>
                                <th  data-sortable="true">Duyệt Đơn Hàng</th>
                                <th  data-sortable="true">Mã Đơn Hàng</th>
                                <th  data-sortable="true">Tên Khách Hàng</th>
                                <th  data-sortable="true">Tổng Giá</th>
                                <th  data-sortable="true">Thời Gian Tạo Đơn</th>
                                <th  data-sortable="true">Tình Trạng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listBill as $bill)
                                <tr>
                                    <td><p style="font-size: 20px;line-height: normal"><a style="text-decoration: none;color: black" href="{{route('check-bill',$bill->MaDonHang)}}">Duyệt</a></p></td>
                                    <td>{{$bill->MaDonHang}}</td>
                                    <td>{{$bill->TenKhachHang}}</td>
                                    <td>{{$bill->Gia}}</td>
                                    <td>{{$bill->NgayTao}}</td>
                                    <td>{{$bill->TinhTrang}}</td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table.js"></script>
@endsection
