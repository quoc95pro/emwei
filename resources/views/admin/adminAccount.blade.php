@extends('admin.master')
@section('script')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-editable.css')}}">
    <script src="{{ URL::asset('js3/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('js3/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
    <script src="{{ URL::asset('js3/bootstrap-table-editable.js')}}"></script>
    <script src="{{ URL::asset('js3/bootstrap-editable.js')}}"></script>
@stop
@section('content')
    <script>
        document.getElementById("Account").className += " active";
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
                <h1 class="page-header">Quản Lý Tài Khoản Admin</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Danh Sách</div>
                    <div class="panel-body">
                        <div id="toolbar">
                            <button type="button" class="btn btn-primary" onclick="formInseart()">Thêm Mới</button>
                            {{--<button id="button" class="btn btn-default">Xóa</button>--}}
                        </div>
                        <table id="table"
                               data-toggle="table"
                               data-pagination="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-show-columns="true"
                               data-search="true"
                               data-toolbar="#toolbar"
                               data-sort-name="name"
                               data-height="450"
                               data-click-to-select="true"
                               data-sort-order="desc"
                               class="table table-hover"
                               data-url="http://localhost:8080/emwei/public/jsonAccountAdmin">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" ></th>
                                <th data-field="IDAdmin" data-sortable="true">Mã Nhân Viên</th>
                                <th data-field="TenAdmin" data-sortable="true" data-editable="true">Tên Nhân Viên</th>
                                <th data-field="NamSinh"  data-sortable="true" data-editable="true">Ngày Sinh</th>
                                <th data-field="Loai" data-sortable="true" data-editable="true">Chức Vụ</th>
                                <th data-field="TrangThai" data-sortable="true" data-editable="true">Trạng Thái</th>
                            </tr>
                            </thead>
                        </table>
                        <script>


                            // delete row
//                            var $table = $('#table'),
//                                $button = $('#button');
//                            $(function () {
//                                $button.click(function () {
//                                    var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
//                                        return row.IDAdmin;
//                                    });
//                                    $table.bootstrapTable('remove', {
//                                        field: 'IDAdmin',
//                                        values: ids
//                                    });
//                                });
//                            });
                            // end delete row


                            $('#table').on('editable-save.bs.table', function (field, row, oldValue, $el) {
                                $.ajax({
                                    url : "{{route('editAdminAccount')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        id : oldValue.IDAdmin,
                                        name : oldValue.TenAdmin,
                                        dob : oldValue.NamSinh,
                                        accountType : oldValue.Loai,
                                        status : oldValue.TrangThai
                                    },
                                    success : function (result){
                                        document.getElementById('Message').innerHTML = result;
                                        $('#resultModal').modal('show')
                                    },error:function (data) {
                                        var errors = '';
                                        for(datos in data.responseJSON){
                                            errors += data.responseJSON[datos];
                                        }
                                        document.getElementById('Message').innerHTML = errors;
                                        $('#resultModal').modal('show')
                                    }
                                });
                            });

                            function formInseart() {
                                $.ajax({
                                    url : "{{route('getNextAdminID')}}",
                                    type : "get",
                                    success : function (result){
                                        document.getElementById('idNhanVien').value = result;
                                        $('#myModal').modal('show')
                                    }
                                });
                            }

                            $(function () {
                                $( "#datepicker" ).datepicker({
                                    format:'yyyy-mm-dd',
                                    startDate:'1900-01-01',
                                    endDate:'1999-12-31',
                                    defaultDate:'1999-12-31'
                                });

                            });
                            
                            function insertAdmin() {
                                var id = document.getElementById('idNhanVien').value;
                                var name = document.getElementById('tenNhanVien').value;
                                var pass = document.getElementById('mkNhanVien').value;
                                var repass = document.getElementById('mkNhanVien2').value;
                                var dob = document.getElementById('datepicker').value;
                                var type = document.getElementById('type').value;
                                var status = document.getElementById('status').value;
                                $.ajax({
                                    url : "{{route('insertAdminAccount')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        id : id,
                                        name : name,
                                        pass:pass,
                                        repass:repass,
                                        dob : dob,
                                        accountType : type,
                                        status : status
                                    },
                                    success : function (result){
                                        document.getElementById('tenNhanVien').value='';
                                        document.getElementById('mkNhanVien').value='';
                                        document.getElementById('mkNhanVien2').value='';
                                        document.getElementById('datepicker').value='';
                                        document.getElementById('status').value='';
                                        $('#myModal').modal('hide')
                                        document.getElementById('Message').innerHTML = result;
                                        $('#resultModal').modal('show')

                                        $('#table').bootstrapTable('refresh',{
                                            url: "http://localhost:8080/emwei/public/jsonAccountAdmin"
                                        });

                                    },error:function (data) {
                                        var errors = '';
                                        for(datos in data.responseJSON){
                                            errors += data.responseJSON[datos]+'<br/>';
                                        }
                                        document.getElementById('Message').innerHTML = errors;
                                        $('#resultModal').modal('show')
                                    }
                                });

                            }

                        </script>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 style="color: #30a5ff" class="modal-title">Thêm Mới</h2>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label>Mã Nhân Viên</label>
                                                <input class="form-control" id="idNhanVien" readonly placeholder="Placeholder">
                                            </div>
                                            <div class="form-group">
                                                <label>Tên Nhân Viên</label>
                                                <input class="form-control" id="tenNhanVien" required placeholder="Họ và Tên">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật Khẩu</label>
                                                <input class="form-control" type="password" required id="mkNhanVien">
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập Lại Mật Khẩu</label>
                                                <input class="form-control" type="password" required id="mkNhanVien2">
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày Sinh</label>
                                                <input class="form-control" readonly required id="datepicker" placeholder="Năm-Tháng-Ngày">
                                            </div>
                                            <div class="form-group">
                                                <label>Loại Tài Khoản</label>
                                                <select class="form-control" id="type">
                                                    <option>Administrator</option>
                                                    <option>Staff</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Trạng Thái</label>
                                                <select class="form-control" id="status">
                                                    <option selected>Active</option>
                                                    <option>InActive</option>
                                                </select>
                                            </div>
                                            <center>
                                                <button type="button" class="btn btn-primary" onclick="insertAdmin()">Thêm</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            </center>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{--result Modal--}}
                        <div class="modal fade" id="resultModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <center><p id="Message">Sửa Thành Công</p></center>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
@endsection
