@extends('master')
@section('content')
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>{{$slide[0]->HangSanXuat}}</span></h1>
									<h2>{{$slide[0]->TenSanPham}}</h2>
									<p>{{$slide[0]->Gia}} VND</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{$slide[0]->link}}" class="girl img-responsive" alt="" />

								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>{{$slide[1]->HangSanXuat}}</span></h1>
									<h2>{{$slide[1]->TenSanPham}}</h2>
									<p>{{$slide[1]->Gia}} VND</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ $slide[1]->link }}" class="girl img-responsive" alt="" />

								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>{{$slide[2]->HangSanXuat}}</span></h1>
									<h2>{{$slide[2]->TenSanPham}}</h2>
									<p>{{$slide[2]->Gia}} VND</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ $slide[2]->link }}" class="girl img-responsive" alt="" />

								</div>
							</div>

						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Điện Thoại
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="shop.html">Apple</a></li>
											<li><a href="product-details.html">SamSung</a></li>
											<li><a href="checkout.html">ASUS</a></li>
											<li><a href="cart.html">OPPO</a></li>
											<li><a href="login.html">Sony</a></li>
											<li><a href="login.html">Xiao Mi</a></li>
											<li><a href="login.html">Vivo</a></li>
											<li><a href="login.html">HTC</a></li>
											<li><a href="login.html">Huawei</a></li>
											<li><a href="login.html">Lenovo</a></li>
											<li><a href="login.html">Pantech</a></li>
											<li><a href="login.html">Coolpad</a></li>
											<li><a href="login.html">Itel</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Máy Tính Bảng
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="blog.html">Apple-Ipad</a></li>
											<li><a href="blog-single.html">SamSung</a></li>
											<li><a href="blog-single.html">Sony</a></li>
											<li><a href="blog-single.html">ASUS</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Phụ Kiện
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="blog.html">Apple-Ipad</a></li>
											<li><a href="blog-single.html">SamSung</a></li>
											<li><a href="blog-single.html">Sony</a></li>
											<li><a href="blog-single.html">ASUS</a></li>
										</ul>
									</div>
								</div>
							</div>

						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Hãng</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($left as $l)
										<li><a href="#"> <span class="pull-right">({{$l -> Count}})</span>{{$l -> HangSanXuat}}</a></li>
									@endforeach

								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{ URL::asset('images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">SẢN PHẨM MỚI</h2>

						@foreach($newProducts as $newProduct)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{$newProduct->link}}" alt="" />
											<h2>{{$newProduct->Gia}} VND</h2>
											<p>{{$newProduct->TenSanPham}}</p>

										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{$newProduct->Gia}}</h2>
												<p>{{$newProduct->TenSanPham}}</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
										<img src="{{ URL::asset('images/home/new.png') }}" class="new" alt="" />
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="{{route('detail-product',$newProduct->IDSanPham)}}"><i class="fa fa-plus-square"></i>Chi tiết</a></li>
										</ul>
									</div>
								</div>
							</div>

						@endforeach

						
					</div><!--features_items-->
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">KHUYẾN MÃI</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend1.jpg') }}" alt="" />

													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend2.jpg') }}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend3.jpg') }}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend1.jpg') }}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend2.jpg') }}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::asset('images/home/recommend3.jpg') }}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</div><!--/recommended_items-->
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">

								<li class="active"><a href="#{{$tabTitle[0]->LoaiPhuKien}}" data-toggle="tab">{{$tabTitle[0]->LoaiPhuKien}}</a></li>
								@for($i =1;$i< count($tabTitle);$i++)
									<li><a href="#{{$tabTitle[$i]->LoaiPhuKien}}" data-toggle="tab">{{$tabTitle[$i]->LoaiPhuKien}}</a></li>
								@endfor

							</ul>
						</div>

						<div class="tab-content">

							<div class="tab-pane fade active in" id="{{$tabTitle[0]->LoaiPhuKien}}" >
								@foreach($tabContent as $tc)
									@if($tc->LoaiPhuKien==$tabTitle[0]->LoaiPhuKien)
										<div class="col-sm-3">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{ $tc->link }}" alt="" />
														<h2>$56</h2>
														<p>Easy Polo Black Edition</p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>

												</div>
											</div>
										</div>
									@endif
								@endforeach
							</div>

							@for($i =1;$i< count($tabTitle);$i++)

								<div class="tab-pane fade " id="{{$tabTitle[$i]->LoaiPhuKien}}" >
									@foreach($tabContent as $tc)
										@if($tc->LoaiPhuKien==$tabTitle[$i]->LoaiPhuKien)
											<div class="col-sm-3">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{ $tc->link }}" alt="" />
															<h2>$56</h2>
															<p>Easy Polo Black Edition</p>
															<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
														</div>

													</div>
												</div>
											</div>
										@endif
									@endforeach
								</div>


								@endfor

						</div>
					</div><!--/category-tab-->
					

					
				</div>
			</div>
		</div>
	</section>
	@endsection