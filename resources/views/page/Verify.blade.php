@extends('master')
@section('content')
	<section id="form" style="margin-top: 0px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="signup-form"><!--sign up form-->
						<center><h2 style="font-size: xx-large">Chúng Tôi Đã Gửi Mã Xác Nhận Vào Số Điện Thoại Của Bạn</h2>
						<form id="commentForm" >
							{{csrf_field()}}
							<input class="form-control" type="text" id="maXacNhan" style="text-align: center">
							<a class="btn btn-primary" onclick="ok()" id="clickButton">Xác Nhận</a>
							<a class="btn btn-primary" onclick="sendCode()">Gửi Lại Mã Xác Nhận</a>
							<div class="alert alert-success" id="alert" style="display: none;margin-top: 20px">

							</div>
							<script language="javascript">

                                function ok() {
									var  maXN =	document.getElementById("maXacNhan").value;
									if(maXN==''){
									    alert('Mã Xác Nhận Không Chính Xác');
									}else{
									    window.location ='{{route('discount')}}';
									}
                                }
                                function sendCode() {
                                    document.getElementById("alert").style.display='block';
									document.getElementById("alert").innerHTML='Đã Gửi Lại Mã Xác Nhận Vào Số Điện Thoại Của Quý Vị';
                                }

							</script>
						</form>
						</center>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection

