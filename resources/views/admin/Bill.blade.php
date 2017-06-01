@extends('admin.master')
@section('script')
    <script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
@stop
@section('css')
    .table-hover>tbody>tr>td{
    height:50px;
    padding-top:16px;
    }
@stop
@section('content')
    <script>
        document.getElementById("Bills").className += " active";
        document.getElementById("Dashboard").className -= "active";
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Đơn Hàng</li>
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
                        <div id="toolbar">
                            <button type="button" class="btn btn-primary" onclick="addProduct()">Thêm Mới</button>
                            <button id="button" class="btn btn-default">Sửa Tình Trạng</button>
                            <select class="form-control" id="optionUpdate" >
                                <option>Đã Hủy</option>
                            </select>
                        </div>
                        <table data-toggle="table" id="table" data-url="http://localhost:8080/emwei/public/jsonBill" data-show-refresh="true" data-page-list="[10, 20,50]" data-height="760"
                               data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-select-item-name="toolbar1" data-click-to-select="true" data-page-size="10"
                               data-search="true"  data-pagination="true" data-filter-control="true" data-filter-show-clear="true" data-sort-name="name" data-sort-order="desc"  class="table table-hover">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" data-align="center"></th>
                                <th data-field="MaDonHang" data-sortable="true" data-align="center">Mã Đơn Hàng</th>
                                <th data-field="TenKhachHang"  data-sortable="true" data-align="center">Tên Khách Hàng</th>
                                <th data-field="Gia" data-sortable="true" data-align="center">Giá</th>
                                <th data-field="NgayTao" data-sortable="true" data-align="center">Ngày Tạo</th>
                                <th data-field="TinhTrang" data-filter-control="select" data-sortable="true" data-align="center" >Tình Trạng</th>
                                <th data-formatter="operateFormatter" data-events="operateEvents" data-align="center" >Tùy Chọn</th>
                            </tr>
                            </thead>
                        </table>
                        <script>


                            var $table = $('#table'),
                                $button = $('#button');
                            $(function () {
                                $button.click(function () {
                                    var a=document.getElementById('optionUpdate').value;
                                    for(var i=0;i<$table.bootstrapTable('getAllSelections').length;i++){
//                                        a+=$table.bootstrapTable('getAllSelections')[i].IDSanPham;
                                        $.ajax({
                                            url : "{{route('updateStatusBill')}}",
                                            type : "post",
                                            dateType:"text",
                                            data : {
                                                id : $table.bootstrapTable('getAllSelections')[i].MaDonHang,
                                                status : a
                                            },
                                            success : function (result){
                                                $table.bootstrapTable('refresh',{
                                                    url: "http://localhost:8080/emwei/public/jsonBill"
                                                });
                                            }
                                        });
                                    }
                                });
                            });

                            window.operateEvents = {
                                'click .hoanTat': function (e, value, row){
                                    window.location.href = "http://localhost:8080/emwei/public/done-bill/"+row.MaDonHang;
                                },
                                'click .duyetDonHang': function (e, value, row){
                                    window.location.href = "http://localhost:8080/emwei/public/detail-bill/"+row.MaDonHang;
                                },
                                'click .chiTiet': function (e, value, row) {
                                    window.location.href = "http://localhost:8080/emwei/public/detail-bill/"+row.MaDonHang;
                                },
                                'click .huy': function (e, value, row) {
                                    var r= confirm('Bạn Có Chắc Muốn Xóa ?');
                                    if (r == true) {
                                        window.location.href = "http://localhost:8080/emwei/public/remove-bill/"+row.MaDonHang;
                                    } else {
                                    }

                                }
                            };

                            function addProduct() {
                                window.location.href = "{{route('adminAddProduct')}}";
                            }

                            function operateFormatter(value, row, index) {
                                if(row.TinhTrang=='Đã Hủy'){
                                    return [
                                        '<div class="center-block">',
                                        '<a class="chiTiet" href="javascript:void(0)" title="Chi Tiết">',
                                        '<i class="glyphicon glyphicon-zoom-in"></i>',
                                        '</a>  ',
                                        '</div>'
                                    ].join('')
                                }

                                if(row.TinhTrang=='Đang Giao Hàng'){
                                    return [
                                        '<div class="center-block">',
                                        '<a class="hoanTat" href="javascript:void(0)" title="Hoàn Tất">',
                                        '<i class="glyphicon glyphicon-ok"></i>',
                                        '</a>  ',
                                        '<a class="chiTiet" href="javascript:void(0)" title="Chi tiết">',
                                        '<i class="glyphicon glyphicon-zoom-in"></i>',
                                        '</a>',
                                        '<a class="huy" href="javascript:void(0)" title="Hủy">',
                                        '<i class="glyphicon glyphicon-remove"></i>',
                                        '</a>',
                                        '</div>'
                                    ].join('')
                                }

                                if(row.TinhTrang=='Đã Giao Hàng'){
                                    return [
                                        '<div class="center-block">',
                                        '<a class="chiTiet" href="javascript:void(0)" title="Chi tiết">',
                                        '<i class="glyphicon glyphicon-zoom-in"></i>',
                                        '</a>',
                                        '</div>'
                                    ].join('')
                                }

                                return [
                                    '<div class="center-block">',
                                    '<a class="duyetDonHang" href="javascript:void(0)" title="Duyệt Đơn Hàng">',
                                    '<i class="glyphicon glyphicon-edit"></i>',
                                    '</a>  ',
                                    '<a class="huy" href="javascript:void(0)" title="Hủy">',
                                    '<i class="glyphicon glyphicon-remove"></i>',
                                    '</a>',
                                    '</div>'
                                ].join('');
                            }

                        </script>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
    <script src="js/bootstrap-table.js"></script>
@endsection
