@extends('master')
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng Ký tài Khoản Mới</h2>
						<form action="{{route('post-signup')}}" method="post" id="commentForm">
							{{csrf_field()}}
							<input type="email" placeholder="Địa Chỉ Email (*)" name="mail"  required/>
							<input type="password" placeholder="Mật Khẩu (*)" name="pass" required/>
							<input type="password" placeholder="Nhập Lại Mật Khẩu (*)" name="rePass" required/>
							<input type="number" placeholder="Điện thoại di động (*)" name="phone"/>
							<input type="text" placeholder="Họ Và Tên (*)" name="name" required/>
							<p><span style="float: left">Giới tính : &nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="radio" checked name="sex" placeholder="ok" value="Nam" class="radio-inline" style="float: left;width: 22px;margin: 2px;height: 16px"><span style="float: left">Nam</span><input type="radio" class="radio-inline" value="Nữ" style="float: left;width: 22px;margin: 2px;height: 16px" name="sex">Nữ</p>
							<p><input type="text" id="datepicker" name="dob"  placeholder="Ngày-Tháng-Năm Sinh" size="30"></p>
							<input type="text" placeholder="Địa Chỉ" name="add" />
							<div class="g-recaptcha" data-sitekey="6LdmNSMUAAAAAMVpqHFmTjVs4JN1xWSBPWa9IAit"></div>

							<button type="submit" class="btn btn-default">Signup</button>
						</form>

						@if(count($errors)>0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $err)
									{{$err}}<br/>
								@endforeach
							</div>
						@endif
						@if(Session::has('thanhcong'))
							<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
						@endif
						@if(Session::has('flag'))
							<div class="alert alert-danger">{{Session::get('message')}}</div>
						@endif
					</div><!--/sign up form-->
				</div>
				<script src='https://www.google.com/recaptcha/api.js'></script>

				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-5 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2 style="margin-top: 90px"><a href="{{route('dang-nhap')}}"> Bạn Đã Có Tài Khoản ? Đăng Nhập Tại Đây !!</a></h2>
					</div><!--/login form-->
				</div>

			</div>
		</div>
	</section><!--/form-->
@endsection

