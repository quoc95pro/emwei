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
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                    @php
                    $i = 0;
                    @endphp
						@foreach($listProduct as $product)
							<tr class="rowId{{$i}}">
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
										<a class="cart_quantity_up" onclick="cart_add_ajax('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}')"> + </a>
										<input class="cart_quantity_input" type="number" min="1" style="width:38px" id="qtyValue{{$i}}"  onchange="cart_set_qty('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}')" name="quantity" value="{{$product->qty}}" autocomplete="off" size="2">
                                        <input value="{{$product->rowId}}" id="rowId{{$i}}" style="display: none">
										<a class="cart_quantity_down" onclick="cart_minus_ajax('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}')"> - </a>
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
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection