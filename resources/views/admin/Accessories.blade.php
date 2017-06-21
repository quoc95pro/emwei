@extends('admin.master')
@section('script')
    <script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
    @stop
@section('css')
    .table-hover>tbody>tr>td>a{
    display: none;
    text-decoration: dashed;
    float: left;
    margin: 3px;
    border-right: solid 1px #c1c1c1;
    padding-right: 4px;
    }

    .table-hover>tbody>tr>td>a:hover{
    color: red;
    }


    .table-hover>tbody>tr:hover>td>a{
    display: block;
    text-decoration: none;
    }

    .table-hover>tbody>tr>td>a.view-button{
    border-right: none;
    padding-right: 4px;
    }
    .table-hover>tbody>tr>td{
     height:60px;
     line-height:48px;
    }
@stop
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}
            @endforeach
        </div>
    @endif
    @if(Session::has('thanhcong'))
        <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif
    <script>
        document.getElementById("Product").className += " active";
        document.getElementById("Dashboard").className -= "active";
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Phụ Kiện</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Phụ Kiện</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tất Cả Phụ Kiện</div>
                    <div class="panel-body">
                        <div id="toolbar">
                            <button type="button" class="btn btn-primary" onclick="addAccessory()">Thêm Mới</button>
                            <button id="button" class="btn btn-default">Sửa Tình Trạng</button>
                            <select class="form-control" id="optionUpdate" >
                                <option>Đã Xóa</option>
                                <option>Còn Hàng</option>
                                <option>Hết Hàng</option>
                            </select>
                        </div>
                        <table data-toggle="table" id="table" data-url="http://emwei.tk/allAccessoriesJson" data-show-refresh="true" data-page-list="[20, 50,60]" data-height="760"
                               data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-select-item-name="toolbar1" data-click-to-select="true" data-page-size="20"
                               data-search="true"  data-pagination="true" data-filter-control="true" data-filter-show-clear="true" data-sort-name="name" data-sort-order="desc"  class="table table-hover">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" data-align="center"></th>
                                <th data-field="IDPhuKien" data-sortable="true" data-align="center">Mã Phụ Kiện</th>
                                <th data-field="TenPhuKien"  data-sortable="true" data-align="center">Tên Phụ Kiện</th>
                                <th data-field="TenSanPham"  data-sortable="true" data-align="center">Phụ Kiện Cho</th>
                                <th data-field="Gia" data-sortable="true" data-align="center">Giá</th>
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
                                            url : "{{route('updateStatusAccessory')}}",
                                            type : "post",
                                            dateType:"text",
                                            data : {
                                                id : $table.bootstrapTable('getAllSelections')[i].IDPhuKien,
                                                status : a
                                            },
                                            success : function (result){
                                                $table.bootstrapTable('refresh',{
                                                    url: "http://emwei.tk/allAccessoriesJson"
                                                });
                                            }
                                        });
                                    }
                                });
                            });

                            window.operateEvents = {
                                'click .chiTiet': function (e, value, row){
                                window.location.href = "http://emwei.tk/edit-accessory/"+row.IDPhuKien;
                                },
                                'click .sua': function (e, value, row) {
                                    window.location.href = "http://emwei.tk/edit-accessory/"+row.IDPhuKien;
                                },
                                'click .xoa': function (e, value, row) {
                                    var r= confirm('Bạn Có Chắc Muốn Xóa ?');
                                    if (r == true) {
                                        window.location.href = "http://emwei.tk/delete-accessory/"+row.IDPhuKien;
                                    } else {
                                    }

                                }
                            };

                            function addAccessory() {
                                window.location.href = "{{route('adminAddAccessory')}}";
                            }

                            function operateFormatter(value, row, index) {
                                if(row.TinhTrang=='Đã Xóa'){
                                    return [
                                        '<div class="center-block">',
                                        '<a class="chiTiet" href="javascript:void(0)" title="Chi Tiết">',
                                        '<i class="glyphicon glyphicon-zoom-in"></i>',
                                        '</a>  ',
                                        '<a class="sua" href="javascript:void(0)" title="Sửa">',
                                        '<i class="glyphicon glyphicon-edit"></i>',
                                        '</a>  ',
                                        '</div>'
                                    ].join('')
                                }
                                return [
                                    '<div class="center-block">',
                                    '<a class="chiTiet" href="javascript:void(0)" title="Chi Tiết">',
                                    '<i class="glyphicon glyphicon-zoom-in"></i>',
                                    '</a>  ',
                                    '<a class="sua" href="javascript:void(0)" title="Sửa">',
                                    '<i class="glyphicon glyphicon-edit"></i>',
                                    '</a>  ',
                                    '<a class="xoa" href="javascript:void(0)" title="Xóa">',
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
