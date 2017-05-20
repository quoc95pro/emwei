@extends('master')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<img src="{{ URL::asset('images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->

					</div>
				</div>
				@foreach($product as $p)
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
									<img src="../{{$p->AnhDaiDien}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
											@if(count($listImage)>3)
												<a><img src="../{{$listImage[0]->link}}" alt="" height="85" width="84"></a>
												<a><img src="../{{$listImage[1]->link}}" alt="" height="85" width="84"></a>
												<a><img src="../{{$listImage[2]->link}}" alt="" height="85" width="84"></a>
												@else
										  <a href=""><img src="{{ URL::asset('images/product-details/similar1.jpg') }}" alt=""></a>
										  <a href=""><img src="{{ URL::asset('images/product-details/similar2.jpg') }}" alt=""></a>
										  <a href=""><img src="{{ URL::asset('images/product-details/similar3.jpg') }}" alt=""></a>
												@endif
										</div>
										<div class="item">
											<a href=""><img src="{{ URL::asset('images/product-details/similar1.jpg') }}" alt=""></a>
											<a href=""><img src="{{ URL::asset('images/product-details/similar2.jpg') }}" alt=""></a>
											<a href=""><img src="{{ URL::asset('images/product-details/similar3.jpg') }}" alt=""></a>
										</div>
										<div class="item">
											<a href=""><img src="{{ URL::asset('images/product-details/similar1.jpg') }}" alt=""></a>
											<a href=""><img src="{{ URL::asset('images/product-details/similar2.jpg') }}" alt=""></a>
											<a href=""><img src="{{ URL::asset('images/product-details/similar3.jpg') }}" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{ URL::asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
								<h2>{{$p->TenSanPham}}</h2>
								<p>Mã Sản Phẩm: {{$p->IDSanPham}}</p>
								<img src="{{ URL::asset('images/product-details/rating.png') }}" alt="" />
								<span>
									<span>{{number_format($p->Gia, 0, ',', '.')}} VND</span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									<a href="{{route('add-cart',$p->IDSanPham)}}" type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</a>
								</span>
								<p><b>Tình trạng:</b> {{$p->TinhTrang}}</p>
								<p><b>Hãng:</b>{{$p->HangSanXuat}}</p>
								<a href=""><img src="{{ URL::asset('images/product-details/share.png') }}" class="share img-responsive" alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li  class="active"><a href="#details" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh Giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >

									<div class="panel panel-default">
										<div class="panel-heading">Mô Tả</div>
										<div class="panel-body">
											<table data-toggle="table" >
												<thead>
												<tr>
													<th data-field="id" data-align="left">Mô Tả</th>
													<th data-field="name">Giá Trị</th>
												</tr>
												</thead>
												<tbody>
                                                <?php
                                                $x = preg_split("/;/", $p->MoTa);
                                                $a= array();
                                                foreach ($x as $b){
                                                    $c = preg_split("/:/",$b);
                                                    $arr1 = array($c[0] => $c[1]);
                                                    $a+=$arr1;
                                                }
                                                ?>
													@foreach($a as $key=>$test)
														<tr>
															<td>{{$key}}</td>
															<td>{{$test}}</td>
														</tr>
													@endforeach

												</tbody>
											</table>
										</div>
									</div>

							</div>
							


							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="{{ URL::asset('images/product-details/rating.png') }}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản Phẩm Cùng Loại</h2>


						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">

								<div class="item active">
									@for($i=0;$i<3;$i++)
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													@if(isset($relateProduct[$i]))
													<div class="productinfo text-center">
														<img src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
														<h2>{{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h2>
														<p>{{$relateProduct[$i]->TenSanPham}}</p>
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</div>
													@endif
												</div>
											</div>
										</div>
									@endfor
								</div>


								<div class="item">
									@for($i=3;$i<6;$i++)
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													@if(isset($relateProduct[$i]))
													<div class="productinfo text-center">
														<img src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
														<h2>{{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h2>
														<p>{{$relateProduct[$i]->TenSanPham}}</p>
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</div>
														@endif
												</div>
											</div>
										</div>
									@endfor



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
					
				</div>
				@endforeach
			</div>
		</div>
	</section>
@endsection
