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
                <h1 class="page-header">Quản Lý Tài Khoản User</h1>
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
                               data-url="http://localhost/emwei/public/jsonAccountUser">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" ></th>
                                <th data-field="Email" data-sortable="true">Email Khách Hàng</th>
                                <th data-field="TenKhachHang" data-sortable="true" data-editable="true">Tên Khách Hàng</th>
                                <th data-field="NamSinh"  data-sortable="true" data-editable="true">Ngày Sinh</th>
                                <th data-field="GioiTinh" data-sortable="true" data-editable="true">Giới Tính</th>
                                <th data-field="SoDienThoai" data-sortable="true" data-editable="true">Số Điện Thoại</th>
                                <th data-field="DiaChi" data-sortable="true" data-editable="true">Địa Chỉ</th>
                                <th data-field="LoaiTaiKhoan" data-sortable="true" data-editable="true">Loại Tài Khoản</th>
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
                                    url : "{{route('editUserAccount')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        email : oldValue.Email,
                                        name : oldValue.TenKhachHang,
                                        dob : oldValue.NamSinh,
                                        sex : oldValue.GioiTinh,
                                        phone : oldValue.SoDienThoai,
                                        add : oldValue.DiaChi,
                                        type : oldValue.LoaiTaiKhoan,
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
                                        $('#myModal').modal('show')
                            }

                            $(function () {
                                $( "#datepicker" ).datepicker({
                                    format:'yyyy-mm-dd',
                                    startDate:'1900-01-01',
                                    endDate:'1999-12-31',
                                    defaultDate:'1999-12-31'
                                });

                            });

                            function insertUser() {
                                var email = document.getElementById('email').value;
                                var name = document.getElementById('tenKhachhang').value;
                                var pass = document.getElementById('mkKhachHang').value;
                                var repass = document.getElementById('mkKhachHang2').value;
                                var dob = document.getElementById('datepicker').value;
                                var sex = 'Nam';
                                if(!document.getElementById('gioiTinh').checked){
                                    sex = 'Nữ';
                                }
                                var phone = document.getElementById('phone').value;
                                var add = document.getElementById('diaChi').value;
                                var type = document.getElementById('type').value;
                                var status = document.getElementById('status').value;

                                $.ajax({
                                    url : "{{route('insertUserAccount')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        email : email,
                                        name : name,
                                        pass:pass,
                                        repass:repass,
                                        dob : dob,
                                        sex : sex,
                                        phone : phone,
                                        add : add,
                                        accountType : type,
                                        status : status
                                    },
                                    success : function (result){
                                        document.getElementById('email').value='';
                                        document.getElementById('tenKhachhang').value='';
                                        document.getElementById('mkKhachHang').value='';
                                        document.getElementById('mkKhachHang2').value='';
                                        document.getElementById('datepicker').value='';
                                        document.getElementById('phone').value='';
                                        document.getElementById('diaChi').value='';
                                        document.getElementById('status').value='';
                                        $('#myModal').modal('hide')
                                        document.getElementById('Message').innerHTML = result;
                                        $('#resultModal').modal('show')

                                        $('#table').bootstrapTable('refresh',{
                                            url: "http://localhost/emwei/public/jsonAccountUser"
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
                                                <label>Email Khách Hàng</label>
                                                <input class="form-control" type="email" id="email" placeholder="Email (*)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tên Khách Hàng</label>
                                                <input class="form-control" id="tenKhachhang" required placeholder="Họ và Tên (*)">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật Khẩu</label>
                                                <input class="form-control" type="password" required id="mkKhachHang" placeholder="Mật Khẩu (*)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập Lại Mật Khẩu</label>
                                                <input class="form-control" type="password" required id="mkKhachHang2" placeholder="Nhập Lại Mật Khẩu (*)">
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày Sinh</label>
                                                <input class="form-control" readonly required id="datepicker" placeholder="Năm-Tháng-Ngày">
                                            </div>
                                            <div class="form-group">
                                                <label>Giới Tính</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" id="gioiTinh" value="Nam" checked>Nam
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios"  value="Nữ">Nữ
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Số Điện Thoại</label>
                                                <input class="form-control" type="number" id="phone" required  placeholder="Số điện thoại (*)">
                                            </div>
                                            <div class="form-group">
                                                <label>Địa Chỉ</label>
                                                <input class="form-control" id="diaChi" placeholder="Địa Chỉ">
                                            </div>
                                            <div class="form-group">
                                                <label>Loại Tài Khoản</label>
                                                <select class="form-control" id="type">
                                                    <option selected>Đồng</option>
                                                    <option>Bạc</option>
                                                    <option>Vàng</option>
                                                    <option>Bạch Kim</option>
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
                                                <button type="button" class="btn btn-primary" onclick="insertUser()">Thêm</button>
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
