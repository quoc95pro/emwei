@extends('master')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản Phẩm</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                    @php
                    $i = 0;
					$total=0;
                    @endphp
						@foreach($listProduct as $product)
							<tr class="rowId{{$i}}">
								<td class="cart_product">
									<a href="{{route('detail-product',$product->id)}}"><img src="{{$product->options->img}}" alt="" width="50px"></a>
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
										<a class="cart_quantity_up" onclick="cart_add_ajax('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')"> + </a>
										<input class="cart_quantity_input" type="number" min="1" style="width:38px" id="qtyValue{{$i}}"  onchange="cart_set_qty('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')" name="quantity" value="{{$product->qty}}" autocomplete="off" size="2">
                                        <input value="{{$product->rowId}}" id="rowId{{$i}}" style="display: none">
										<a class="cart_quantity_down" onclick="cart_minus_ajax('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')"> - </a>
										<input value="{{$product->price}}"class="cart-product-price" id="idPrice{{$i}}" style="display: none">
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price" id="totalProductPrice{{$i}}">{{number_format($product->price*$product->qty, 0, ',', '.')}}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" onclick="cart_delete('rowId{{$i}}')"><i class="fa fa-times"></i></a>
								</td>
							</tr>
                            @php
                                $i ++;
								$total+=$product->price*$product->qty;
                            @endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">

			</div>
			<div class="row">
				<div class="col-sm-9">
					<div class="total_area">
						<ul>
							@if(Session::has('userName'))
								<li>Tổng Giá : <span id="showTotal" style="text-decoration: line-through">{{number_format($total, 0, ',', '.')}} VND</span></li>
								<li>Chiết Khấu : <span>%</span><span id="ck">{{Session::get('userName')->ChietKhau}}</span></li>
								<li>Giá Sau Chiết Khấu : <span id="showTotal2">{{number_format($total-round($total/100*Session::get('userName')->ChietKhau/1000)*1000, 0, ',', '.')}} VND</span></li>

							@else
								<li>Tổng Giá : <span id="showTotal">{{number_format($total, 0, ',', '.')}} VND</span></li>
							@endif
						</ul>
						@if($i>0)
							<a class="btn btn-default check_out" id="check-out" href="{{route('checkout')}}">Thanh Toán</a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection