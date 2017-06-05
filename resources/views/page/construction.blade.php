@extends('master')
@section('content')
	 <div id="contact-page" class="container" style="margin-bottom: 200px ">
    		<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab1" data-toggle="tab">Khách Hàng Không Đăng Ký Tài Khoản</a></li>
								<li><a href="#tab2" data-toggle="tab">Khách Hàng Có Đăng Ký Tài Khoản</a></li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab1">
									<h4>Bước 1 : Thêm Sản Phẩm Cần Mua Vào Giỏ Hàng</h4>
									<img style="width: 100%" src="images/addCart.png">
									<h4>Bước 2 : Kiểm Tra Giỏ Hàng Điều Chỉnh Sản Phẩm Cần Mua</h4>
									<img style="width: 100%" src="images/checkCart.png">
									<h4>Bước 3 : Thanh Toán : Thanh Toán Tại Cửa Hàng Hoặc Thanh Toán Tại Nơi Giao Hàng</h4>
									<img style="width: 100%" src="images/checkout.png">
									<h4>Bước 4 : Chờ Cuộc Gọi Xác Nhận Của Nhân Viên</h4>
								</div>
								<div class="tab-pane fade" id="tab2">
									<h3>Với khách hàng đăng ký tài khoản cách thức đặt hàng tương tự như khách hàng không đăng ký tài khoản ngoài ra khách hàng còn được hưởng các ưu đãi :</h3>
									<h4>+ Chiết Khấu 0,5 % -> 2.0 % Giá trị mỗi sản phẩm</h4>
									<h4>+ Hệ thống phân loại tài khoản : </h4>
									<h5>- Khởi tạo : Đồng</h5>
									<h5>- Tổng Giá Trị Các Đơn Hàng Đã Mua Trên 10.000.000 Triệu Đồng : Bạc : Chiết Khấu thêm 1.0 % Giá trị mỗi sản phẩm</h5>
									<h5>- Tổng Giá Trị Các Đơn Hàng Đã Mua Trên 50.000.000 Triệu Đồng : Vàng : Chiết Khấu thêm 2.0 % Giá trị mỗi sản phẩm</h5>
									<h5>- Tổng Giá Trị Các Đơn Hàng Đã Mua Trên 100.000.000 Triệu Đồng : Kim Cương : Chiết Khấu thêm 3.0 % Giá trị mỗi sản phẩm</h5>
									<h4>+ Giới thiệu bạn bè đăng ký tài khoản : Chiết khấu 0,02 % với mỗi tài khoản xác thực thành công !</h4>
								</div>
							</div>
						</div>
					</div><!--/.panel-->
				</div><!--/.col-->
			</div>
    	</div>	
    </div><!--/#contact-page-->
	
	@endsection