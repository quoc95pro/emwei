@extends('master')
@section('content')
	<section id="cart_items">
		<div class="container">
			<form method="post" id="ok" action="{{route('postCheckOut')}}" >
				{{csrf_field()}}
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			@if(Session::has('userName'))

			@else
				<div class="register-req">
					<p>Đăng Nhập Để Được Hưởng Ưu Đãi Khi Thanh Toán</p>
				</div><!--/register-req-->
			@endif
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">

						<div class="shopper-info">
							<p>Thông Tin Khách Hàng</p>
							<div>
								@if(Session::has('userName'))
									<input type="text" class="checkout-input" placeholder="Họ Và Tên (*)" readonly id="userName" name="userName" value="{{Session::get('userName')->TenKhachHang}}" required>
									<input type="text" class="checkout-input" placeholder="Địa Chỉ Mail (*)" readonly id="userMail" name="userMail" value="{{Session::get('userName')->Email}}" required>
									<input type="text" class="checkout-input" placeholder="Số Điện Thoại (*)" readonly id="userPhone" name="userPhone" value="{{Session::get('userName')->SoDienThoai}}" required>
									<input type="text" class="checkout-input" placeholder="Địa chỉ (số nhà, đường, tỉnh) (*)" id="userAddress" name="userAddress"
										   @if(Session::get('userName')->DiaChi!='') readonly @endif value="{{Session::get('userName')->DiaChi}}" required>
								@else
									<input type="text" class="checkout-input" placeholder="Họ Và Tên (*)" id="userName" name="userName" required>
									<input type="text" class="checkout-input" placeholder="Địa Chỉ Mail (*)" id="userMail" name="userMail" required>
									<input type="number" class="checkout-input" placeholder="Số Điện Thoại (*)" id="userPhone" name="userPhone" required>
									<input type="text" class="checkout-input" placeholder="Địa chỉ (số nhà, đường, tỉnh) (*)" id="userAddress" name="userAddress" required>
								@endif
							</div>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Hình Thức Thanh Toán</p>
									<p style="font-size: 15px"><input style="width: auto" type="radio" name="httt" value="tructiep" checked onclick ="show(this.value)"> Thanh Toán Trực Tiếp</p>
									<p style="font-size: 15px"><input style="width: auto" type="radio" name="httt" value="giaohang" onclick ="show(this.value)"> Thanh Toán Tại Nơi Giao Hàng</p>
							<script>
                                function show(val) {
                                    if (val == "giaohang"){
                                        document.getElementById('giaohang').style.display = 'block';
                                    document.getElementById('nameUser').setAttribute('required', 'true');
                                    document.getElementById('mailUser').setAttribute('required', 'true');
                                    document.getElementById('phoneUser').setAttribute('required', 'true');
                                    document.getElementById('addressUser').setAttribute('required', 'true');
                                }
									else{
                                    document.getElementById('giaohang').style.display = 'none';
                                    document.getElementById('nameUser').removeAttribute('required');
                                    document.getElementById('mailUser').removeAttribute('required');
                                    document.getElementById('phoneUser').removeAttribute('required');
                                    document.getElementById('addressUser').removeAttribute('required');

                                }}
							</script>
						</div>
					</div>
					<div class="col-sm-4" id="giaohang" style="display: none">
						<div class="shopper-info" >
								<p>Địa Chỉ Giao Hàng</p>
								<input type="checkbox" id="same" style="width: auto" onclick="check()">  Giao Hàng Tới Cùng Địa Chỉ
								<input type="text" class="checkout-input" id="nameUser" name="nameUser" placeholder="Họ Và Tên (*)" >
								<input type="text" class="checkout-input" id="mailUser" name="mailUser" placeholder="Địa Chỉ Mail (*)" >
								<input type="text" class="checkout-input" id="phoneUser" name="phoneUser" placeholder="Số Điện Thoại (*)" >
								<input type="text" class="checkout-input" id="addressUser" name="addressUser" placeholder="Địa chỉ (số nhà, đường, tỉnh) (*)" >
							<script>
								function check() {
								    if(document.getElementById('same').checked) {
                                        document.getElementById('nameUser').value = document.getElementById('userName').value;
                                        document.getElementById('mailUser').value = document.getElementById('userMail').value;
                                        document.getElementById('phoneUser').value = document.getElementById('userPhone').value;
                                        document.getElementById('addressUser').value = document.getElementById('userAddress').value


                                    }
                                }
							</script>
						</div>
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Đơn Hàng</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Giá</td>
						</tr>
					</thead>
					<tbody>
					@php
                        $total=0;
					@endphp
					@foreach($listProduct as $product)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{$product->options->img}}" alt="" width="50px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{route('detail-product',$product->id)}}">{{$product->name}}</a></h4>
								<p>Mã SP: {{$product->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($product->price, 0, ',', '.')}} VND</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<p style="font-size: 15px">{{$product->qty}}</p>

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($product->price*$product->qty, 0, ',', '.')}}</p>
							</td>
						</tr>
						@php
                            $total+=$product->price*$product->qty;
						@endphp
					@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr class="shipping-cost">
										<td>Phí Vận Chuyển</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Tổng Tiền</td>
										<td><span>{{number_format($total, 0, ',', '.')}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-4"></div>
			<div class="payment-options col-sm-4">
					<center><span>
						<input type="submit" class="btn btn-primary" style="width:100%" value="Đặt Hàng"/>
					</span></center>
				</div>
			<div class="col-sm-4"></div>
			</form>
		</div>

	</section> <!--/#cart_items-->
@endsection
	



