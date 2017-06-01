@extends('master')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				@include('left')
				@foreach($product as $p)
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
									<img id="mainImg" src="../{{$p->AnhDaiDien}}" alt="" />
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
											@if(count($listImage)>0)
												@if(count($listImage)>3)
												@for($i=0;$i<3;$i++)
														<a><img class="img-hover" style="width: 85px;height: 85px" src="../{{$listImage[$i]->link}}" alt="" height="85" width="84"></a>
												@endfor

												@else
													@for($i=0;$i<count($listImage);$i++)
														<a><img class="img-hover" style="width: 85px;height: 85px" src="../{{$listImage[$i]->link}}" alt="" height="85" width="84"></a>
													@endfor

												@endif
											@endif
										</div>
											@if(count($listImage)>3)
												@for($i=3;$i<count($listImage);$i+=3)
													<div class="item">
														@if(count($listImage)>$i+3)
													@for($j=$i;$j<$i+3;$j++)
														<a><img class="img-hover" style="width: 85px;height: 85px" src="../{{$listImage[$j]->link}}" alt="" height="85" width="84"></a>
													@endfor
														@else
															@for($j=$i;$j<count($listImage);$j++)
																<a><img class="img-hover" style="width: 85px;height: 85px" src="../{{$listImage[$j]->link}}" alt="" height="85" width="84"></a>
															@endfor
														@endif
													</div>
												@endfor
											@endif

										
									</div>
								<script>
                                    $( ".img-hover" ).hover(
                                        function() {
                                          $a=  $( this ).attr("src");
                                          $("#mainImg").attr("src",$a);
                                        });

                                    $( "li.fade" ).hover(function() {
                                        $( this ).fadeOut( 100 );
                                        $( this ).fadeIn( 500 );
                                    });
								</script>

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
								@if(isset($p->TenPhuKien))
									<h2>{{$p->TenPhuKien}}</h2>
								@else
									<h2>{{$p->TenSanPham}}</h2>
								@endif
								@if(isset($p->TenPhuKien))
									<p>Mã Phụ Kiện: {{$p->IDPhuKien}}</p>
								@else
									<p>Mã Sản Phẩm: {{$p->IDSanPham}}</p>
								@endif

								<img src="{{ URL::asset('images/product-details/rating.png') }}" alt="" />
								<span>
									@if(Session::has('userName'))
										<span style="color: red"> {{number_format($p->Gia-round($p->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</span>
										<span style="text-decoration: line-through;color: black;font-size: 25px"> {{number_format($p->Gia, 0, ',', '.')}} VND</span>
									@else
										<span> {{number_format($p->Gia, 0, ',', '.')}} VND</span>
									@endif
										@if(isset($p->TenPhuKien))
											<a href="{{route('add-cart',$p->IDPhuKien)}}" type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm Giỏ Hàng
									</a>
										@else
											<a href="{{route('add-cart',$p->IDSanPham)}}" type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm Giỏ Hàng
									</a>
										@endif

								</span>
								<p><b>Tình trạng:</b> {{$p->TinhTrang}}</p>
								@if(isset($p->TenPhuKien))
									<p><b>Phụ Kiện Cho : </b>{{$mainProduct->TenSanPham}}</p>
								@else
									<p><b>Hãng:</b>{{$p->HangSanXuat}}</p>
								@endif
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
										<div class="panel-body">
											@if(isset($p->TenPhuKien))
												{{$p->Mota}};
											@else
												<table data-toggle="table">
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
											@endif


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
						@if(isset($p->TenPhuKien))
							<h2 class="title text-center">Phụ Kiện Cùng Sản Phẩm Khác</h2>
						@else
							<h2 class="title text-center">Sản Phẩm Cùng Loại</h2>
						@endif


						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">

								<div class="item active">
									@for($i=0;$i<3;$i++)

										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													@if(isset($relateProduct[$i]))
													<div class="productinfo text-center">
														@if(isset($relateProduct[$i]->TenPhuKien))
															<a href="{{route('detail-product',$relateProduct[$i]->IDPhuKien)}}">
																<img style="height: 255px;width: 255px" src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
															</a>
														@else
														    <a href="{{route('detail-product',$relateProduct[$i]->IDSanPham)}}">
																<img style="height: 255px;width: 255px" src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
															</a>
														@endif

														@if(Session::has('userName'))
															<h2 style="color: red"> {{number_format($relateProduct[$i]->Gia-round($relateProduct[$i]->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
															<h4 style="text-decoration: line-through"> {{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h4>
														@else
															<h2> {{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h2>
														@endif
														@if(isset($p->TenPhuKien))
															<p class="compact">{{$relateProduct[$i]->TenPhuKien}}</p>
														@else
															<p class="compact">{{$relateProduct[$i]->TenSanPham}}</p>
														@endif
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</div>
													@endif
												</div>
											</div>
										</div>
									@endfor
								</div>

								@if(count($relateProduct)>3)
								<div class="item">
									@for($i=3;$i<6;$i++)
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													@if(isset($relateProduct[$i]))
													<div class="productinfo text-center">
														@if(isset($relateProduct[$i]->TenPhuKien))
															<a href="{{route('detail-product',$relateProduct[$i]->IDPhuKien)}}">
																<img style="height: 255px;width: 255px" src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
															</a>
														@else
															<a href="{{route('detail-product',$relateProduct[$i]->IDSanPham)}}">
																<img style="height: 255px;width: 255px" src="../{{$relateProduct[$i]->AnhDaiDien}}" alt="" />
															</a>
														@endif
															@if(Session::has('userName'))
																<h2 style="color: red"> {{number_format($relateProduct[$i]->Gia-round($relateProduct[$i]->Gia/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</h2>
																<h4 style="text-decoration: line-through"> {{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h4>
															@else
																<h2> {{number_format($relateProduct[$i]->Gia, 0, ',', '.')}} VND</h2>
															@endif
															@if(isset($p->TenPhuKien))
																<p class="compact">{{$relateProduct[$i]->TenPhuKien}}</p>
															@else
																<p class="compact">{{$relateProduct[$i]->TenSanPham}}</p>
															@endif
														<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													</div>
														@endif
												</div>
											</div>
										</div>
										</a>
									@endfor



								</div>
							@endif
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
