@extends('master')
@section('content')
	<section id="advertisement">
		<div class="container">
			<img src="{{ URL::asset('images/shop/advertisement.jpg') }}" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				@include('left')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							$linkRow =0;
						?>
						@if(isset($type))
							@foreach($listProduct as $product)
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img style="height: 255px" src="../../{{$product->AnhDaiDien}}" alt="" />
												@if(Session::has('userName'))
													<h2> {{number_format($product->Gia-round($product->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
													<h4 style="text-decoration: line-through"> {{number_format($product->Gia, 0, ',', '.')}} VND</h4>
												@else
													<h2> {{number_format($product->Gia, 0, ',', '.')}} VND</h2>
												@endif
												<p class="compact">{{ $product->TenPhuKien }}</p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													@if(Session::has('userName'))
														<h2> {{number_format($product->Gia-round($product->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
														<h4 style="text-decoration: line-through"> {{number_format($product->Gia, 0, ',', '.')}} VND</h4>
													@else
														<h2> {{number_format($product->Gia, 0, ',', '.')}} VND</h2>
													@endif
													<p>{{ $product->TenSanPham }}</p>
													<a href="{{route('add-cart',$product->IDPhuKien)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
												</div>
											</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
												<li><a href="{{route('detail-product',$product->IDPhuKien)}}"><i class="fa fa-plus-square"></i>Chi tiết</a></li>
											</ul>
										</div>
									</div>
								</div>
                                <?php
                                $linkRow++;
                                ?>
							@endforeach
						@else
							@foreach($listProduct as $product)
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">

												<img style="height: 255px" src="../../{{$product->AnhDaiDien}}" alt="" />
												@if(Session::has('userName'))
													<h2> {{number_format($product->Gia-round($product->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
													<h4 style="text-decoration: line-through"> {{number_format($product->Gia, 0, ',', '.')}} VND</h4>
												@else
													<h2> {{number_format($product->Gia, 0, ',', '.')}} VND</h2>
												@endif
												<p class="compact">{{ $product->TenSanPham }}</p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													@if(Session::has('userName'))
														<h2> {{number_format($product->Gia-round($product->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
														<h4 style="text-decoration: line-through"> {{number_format($product->Gia, 0, ',', '.')}} VND</h4>
													@else
														<h2> {{number_format($product->Gia, 0, ',', '.')}} VND</h2>
													@endif
													<p>{{ $product->TenSanPham }}</p>
													<a href="{{route('add-cart',$product->IDSanPham)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
												</div>
											</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
												<li><a href="{{route('detail-product',$product->IDSanPham)}}"><i class="fa fa-plus-square"></i>Chi tiết</a></li>
											</ul>
										</div>
									</div>
								</div>
                                <?php
                                $linkRow++;
                                ?>
							@endforeach
						@endif
						<div style="clear: both">
						<ul class="pagination">
							{{ $listProduct->links() }}
						</ul>
						</div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	@endsection