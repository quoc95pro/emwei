<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/prettyPhoto.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/price-range.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
	<script src="{{ URL::asset('js/html5shiv.js') }}"></script>
	<script src="{{ URL::asset('js/respond.min.js') }}"></script>
	<![endif]-->
    <link rel="shortcut icon" href="{{ URL::asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +84 89 98 89 989</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> emwei@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.blade.php"><img src="{{ URL::asset('images/home/logo.gif') }}" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="{{route('dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{route('trang-chu')}}" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="#">Điện Thoại<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
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
                                </li> 
								<li class="dropdown"><a href="#">Máy Tính Bảng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="blog.html">Apple-Ipad</a></li>
										<li><a href="blog-single.html">SamSung</a></li>
										<li><a href="blog-single.html">Sony</a></li>
										<li><a href="blog-single.html">ASUS</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Phụ Kiện<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="blog.html">Apple-Ipad</a></li>
										<li><a href="blog-single.html">SamSung</a></li>
										<li><a href="blog-single.html">Sony</a></li>
										<li><a href="blog-single.html">ASUS</a></li>
									</ul>
								</li>

							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
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
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
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
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::asset('images/home/iframe1.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::asset('images/home/iframe2.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::asset('images/home/iframe3.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::asset('images/home/iframe4.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{ URL::asset('images/home/map.png') }}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ URL::asset('js/price-range.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
</body>
</html>