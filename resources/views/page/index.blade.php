@extends('master')
@section('content')
	@php
		$contents = Storage::get('countVisitor.log');
        $contents++;
        Storage::put('countVisitor.log',$contents);
	@endphp
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
									@if(Session::has('userName'))
										<h2 style="color: red"> {{number_format($slide[0]->Gia-round($slide[0]->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
										<p style="text-decoration: line-through"> {{number_format($slide[0]->Gia, 0, ',', '.')}} VND</p>
									@else
										<p> {{number_format($slide[0]->Gia, 0, ',', '.')}} VND</p>
									@endif
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{$slide[0]->AnhDaiDien}}" class="girl img-responsive" style="height: 490px;width: 490px" alt="" />

								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>{{$slide[1]->HangSanXuat}}</span></h1>
									<h2>{{$slide[1]->TenSanPham}}</h2>
									@if(Session::has('userName'))
										<h2 style="color: red"> {{number_format($slide[1]->Gia-round($slide[1]->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
										<p style="text-decoration: line-through"> {{number_format($slide[1]->Gia, 0, ',', '.')}} VND</p>
									@else
										<p> {{number_format($slide[1]->Gia, 0, ',', '.')}} VND</p>
									@endif
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ $slide[1]->AnhDaiDien }}" class="girl img-responsive" style="height: 490px;width: 490px" alt="" />

								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>{{$slide[2]->HangSanXuat}}</span></h1>
									<h2>{{$slide[2]->TenSanPham}}</h2>
									@if(Session::has('userName'))
										<h2 style="color: red"> {{number_format($slide[2]->Gia-round($slide[2]->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
										<p style="text-decoration: line-through"> {{number_format($slide[2]->Gia, 0, ',', '.')}} VND</p>
									@else
										<p> {{number_format($slide[2]->Gia, 0, ',', '.')}} VND</p>
									@endif
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ $slide[2]->AnhDaiDien }}" class="girl img-responsive" style="height: 490px;width: 490px" alt="" />

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
				@include('left')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">SẢN PHẨM MỚI</h2>

						@foreach($newProducts as $newProduct)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{$newProduct->AnhDaiDien}}" alt="" />
											@if(Session::has('userName'))
												<h2> {{number_format($newProduct->Gia-round($newProduct->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
												<h4 style="text-decoration: line-through"> {{number_format($newProduct->Gia, 0, ',', '.')}} VND</h4>
											@else
												<h2> {{number_format($newProduct->Gia, 0, ',', '.')}} VND</h2>
											@endif
											<p>{{$newProduct->TenSanPham}}</p>

										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												@if(Session::has('userName'))
													<h2> {{number_format($newProduct->Gia-round($newProduct->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
													<h4 style="text-decoration: line-through"> {{number_format($newProduct->Gia, 0, ',', '.')}} VND</h4>
												@else
													<h2> {{number_format($newProduct->Gia, 0, ',', '.')}} VND</h2>
												@endif
												<p>{{$newProduct->TenSanPham}}</p>
												<a href="{{route('add-cart',$newProduct->IDSanPham)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
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
								@php
									function convert_vi_to_en($str) {
                                        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
                                        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
                                        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
                                        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
                                        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
                                        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
                                        $str = preg_replace("/(đ)/", 'd', $str);
                                        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
                                        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
                                        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'I', $str);
                                        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
                                        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
                                        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
                                        $str = preg_replace("/(Đ)/", 'D', $str);
                                        $str = preg_replace("/( )/", '', $str);
                                        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
                                        return $str;
                                        }
								@endphp
								<li class="active"><a href="#{{$tabTitle[0]->LoaiPhuKien}}" data-toggle="tab">{{$tabTitle[0]->LoaiPhuKien}}</a></li>
								@for($i =1;$i< count($tabTitle);$i++)
									<li><a href="#{{convert_vi_to_en($tabTitle[$i]->LoaiPhuKien)}}" data-toggle="tab">{{$tabTitle[$i]->LoaiPhuKien}}</a></li>
								@endfor

							</ul>
						</div>

						<div class="tab-content">

							<div class="tab-pane fade active in" id="{{convert_vi_to_en($tabTitle[0]->LoaiPhuKien)}}" >
								@foreach($tabContent as $tc)
									@if($tc->LoaiPhuKien==$tabTitle[0]->LoaiPhuKien)
										<a href="{{route('detail-product',$tc->IDPhuKien)}}">
											<div class="col-sm-3">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{ $tc->AnhDaiDien }}" alt=""  style="height: 183px;width: 183px"/>
															<h2>$56</h2>
															<p class="compact">{{ $tc->TenPhuKien }}</p>
															<a href="{{route('add-cart',$tc->IDPhuKien)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
														</div>

													</div>
												</div>
											</div>
										</a>
									@endif
								@endforeach
							</div>

							@for($i =1;$i< count($tabTitle);$i++)

								<div class="tab-pane fade " id="{{convert_vi_to_en($tabTitle[$i]->LoaiPhuKien)}}" >
									@foreach($tabContent as $tc)
										@if($tc->LoaiPhuKien==$tabTitle[$i]->LoaiPhuKien)
											<a href="{{route('detail-product',$tc->IDPhuKien)}}">
											<div class="col-sm-3">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{ $tc->AnhDaiDien }}" alt="" style="height: 183px;width: 183px"/>
															<h2>$56</h2>
															<p class="compact">{{ $tc->TenPhuKien }}</p>
															<a href="{{route('add-cart',$tc->IDPhuKien)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ Hàng</a>
														</div>

													</div>
												</div>
											</div>
											</a>
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