@extends('master')
@section('script')
	<script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
@stop
@section('content')
	<section>
		<div class="container">
			<div class="row">
				@include('leftMenuUser')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1">
						<h2 class="title text-center">Thông Tin Khách Hàng</h2>
						<div class="signup-form"><!--sign up form-->
							<form action="{{route('post-edit')}}" method="post" id="commentForm">
								{{csrf_field()}}

								@if(count($errors)>0)
									<div class="alert alert-danger">
										@foreach($errors->all() as $err)
											{{$err}}<br/>
										@endforeach
									</div>
								@endif
								@if(Session::has('flag'))
									<div class="alert alert-danger">{{Session::get('message')}}</div>
								@endif
								<label>Email</label>
								<input type="email"  value="{{$user->Email}}" readonly/>
								<label>Mật Khẩu</label>
								<input type="password"  name="pass" required value="{{$user->MatKhau}}"/>
								<label>Nhập Lại Mật Khẩu</label>
								<input type="password" name="rePass" required value="{{$user->MatKhau}}"/>
								<label>Số Điện Thoại</label>
								<input type="number" readonly value="{{$user->SoDienThoai}}"/>
								<label>Tên Khách Hàng</label>
								<input type="text"  name="name" required value="{{$user->TenKhachHang}}"/>
								<label>Email Giới Thiệu</label>
								<input type="email" value="{{$user->EmailGioiThieu}}" readonly/>
								<p><span style="float: left">Giới tính : &nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="radio" @if($user->GioiTinh=='Nam') checked @endif name="sex" placeholder="ok" value="Nam" class="radio-inline" style="float: left;width: 22px;margin: 2px;height: 16px"><span style="float: left">Nam</span><input type="radio" @if($user->GioiTinh=='Nữ') checked @endif class="radio-inline" value="Nữ" style="float: left;width: 22px;margin: 2px;height: 16px" name="sex">Nữ</p>
								<label>Ngày Tháng Năm Sinh</label>
								<p><input type="text" id="datepicker" name="dob" value="{{$user->NamSinh}}"  size="30"></p>
								<label>Địa Chỉ</label>
								<input type="text"  name="add" value="{{$user->DiaChi}}"/>
								<label>Ngày Tạo</label>
								<input type="text" readonly  value="{{$user->NgayTao}}"/>
								<label>Chiết Khấu</label>
								<input type="text"   readonly value="{{$user->ChietKhau}}"/>
								<label>Loại Tài Khoản</label>
								<input type="text" readonly  value="{{$user->LoaiTaiKhoan}}"/>
								<button type="submit" class="btn btn-default">Sửa</button>
							</form>
						</div><!--/sign up form-->
							</div>

							<div class="tab-pane fade" id="tab2">
								<div class="panel-body">
								<table data-toggle="table" id="table" data-url="{{route('CustomerBill')}}"  data-page-list="[20, 50,60]"
									   data-show-toggle="true"  data-toolbar="#toolbar"  data-page-size="20"
									   data-search="true"  data-pagination="true"  data-sort-name="name" data-sort-order="desc"  class="table table-hover">
									<thead>
									<tr>
										<th data-field="MaDonHang" data-sortable="true" data-align="center">Mã Đơn Hàng</th>
										<th data-field="GhiChu"  data-sortable="true" data-align="center">Ghi Chú</th>
										<th data-field="Gia" data-sortable="true" data-align="center">Tổng Giá</th>
										<th data-field="ChietKhau"  data-sortable="true" data-align="center" >Chiết Khấu</th>
										<th data-field="NgayTao" data-sortable="true" data-align="center" >Ngày Tạo</th>
										<th data-field="TinhTrang"  data-sortable="true" data-align="center" >Tình Trạng</th>
										<th data-formatter="operateFormatter" data-events="operateEvents" data-align="center" >Chi Tiết Mặt Hàng</th>
									</tr>
									</thead>
								</table>
								</div>
							</div>
						</div>
						<script type="text/javascript">

                            window.operateEvents = {
                                'click .chiTiet': function (e, value,oldValue, row){
                                    $('#data').bootstrapTable('refresh',{
                                        url: "http://emwei.tk/testImg/"+oldValue.MaDonHang+""
                                    });
                                    $('#resultModal').modal('show')

                                }
                            };


                            function operateFormatter(value, row, index) {
                                return [
                                    '<div class="center-block">',
                                    '<a class="chiTiet" href="javascript:void(0)" title="Chi Tiết">',
                                    '<i class="glyphicon glyphicon-zoom-in" style="color: red"></i>',
                                    '</a>  ',
                                    '</div>'
                                ].join('');
                            }

                                function imageFormatter(value, row, index) {
                                    return [
                                        '<div class="center-block">',
                                        '<img style="width: 50px;height: 50px" src="'+row.AnhDaiDien+'">',
                                        '</div>'
                                    ].join('');
                                }

						</script>

						<div class="modal fade" id="resultModal" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-body">
										<table data-toggle="table" id="data"  data-page-list="[20, 50,60]"
											   data-show-toggle="true"  data-toolbar="#toolbar"  data-page-size="3"
											   data-search="true"  data-pagination="true"  data-sort-name="name" data-sort-order="desc"  class="table table-hover">
											<thead>
											<tr>
												<th data-field="AnhDaiDien" data-sortable="true" data-align="center" data-formatter="imageFormatter">Ảnh</th>
												<th data-field="MaSanPham"  data-sortable="true" data-align="center">Mã Mặt Hàng</th>
												<th data-field="TenSanPham"  data-sortable="true" data-align="center">Tên Mặt Hàng</th>
												<th data-field="LoaiSanPham"  data-sortable="true" data-align="center">Loại</th>
												<th data-field="SoLuong"  data-sortable="true" data-align="center">Số Lượng</th>
											</tr>
											</thead>
										</table>
									</div>

								</div>

							</div>
						</div>

						<div style="clear: both">
						<ul class="pagination">
						</ul>
						</div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	@endsection