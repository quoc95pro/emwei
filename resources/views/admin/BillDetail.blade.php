@extends('admin.master')
@section('content')

    <script>
        document.getElementById("Bills").className += " active";
        document.getElementById("Dashboard").className -= "active";
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Chi Tiết Đơn Hàng</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi Tiết Đơn Hàng</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <form enctype="multipart/form-data"  action="{{route('edit-bill')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <div class="panel-heading">Thông Tin Khách Hàng</div>
                                <div class="form-group">
                                    <label>Tên Khách Hàng</label>
                                    <input class="form-control" value="{{$bill[0]->TenKhachHang}}" name="tenKhachHang" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email Khách Hàng</label>
                                    <input class="form-control" type="email" value="{{$bill[0]->EmailKhachHang}}" name="mailKhachHang" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Số Điện Thoại</label>
                                    <input class="form-control" value="{{$bill[0]->SoDienThoai}}" name="soDienThoai" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Địa Chỉ</label>
                                    <input class="form-control" value="{{$bill[0]->DiaChi}}" name="diaChi" readonly >
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading">Thông Tin Đơn Hàng</div>
                                <div class="form-group">
                                    <label>Mã Đơn Hàng</label>
                                    <input class="form-control"  value="{{$bill[0]->MaDonHang}}" name="maDonHang"  readonly >
                                </div>
                                <div class="form-group">
                                    <label>Giá</label>
                                    <input class="form-control" value="{{number_format($bill[0]->Gia, 0, ',', '.')}}" name="gia" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Chiết Khấu (%)</label>
                                    <input class="form-control" id="ck" value="{{$bill[0]->ChietKhau}}" name="ck" readonly>
                                </div>
                                <div class="form-group" >
                                    <label>Ngày Tạo</label>
                                    <input class="form-control" value="{{$bill[0]->NgayTao}}" readonly>
                                </div>
                                <div class="form-group" >
                                    <label>Tình Trạng</label>
                                    <input class="form-control" value="{{$bill[0]->TinhTrang}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel-heading">Ghi Chú</div>
                                <div class="form-group">
                                    <textarea class="form-control" name="ghiChu" readonly>{{$bill[0]->GhiChu}}</textarea>
                                </div>
                            </div>
                            <div id="cart_items">
                                <div class="table-responsive cart_info">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Sản Phẩm</td>
                                            <td class="description"></td>
                                            <td class="price">Giá</td>
                                            <td class="quantity">Số Lượng</td>
                                            <td class="total">Tổng Giá</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0;
                                            $total=0;
                                        @endphp
                                        @foreach($cart as $product)
                                            <tr class="rowId{{$i}}">
                                                <td class="cart_product">
                                                    <a href=""><img src="../{{$product->options->img}}" alt="" width="50px"></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a href="{{route('detail-product',$product->id)}}" style="text-decoration: none">{{$product->name}}</a></h4>
                                                    <p>Mã SP: {{$product->id}}</p>
                                                </td>
                                                <td class="cart_price">
                                                    <p>{{number_format($product->price, 0, ',', '.')}} VND</p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        <a class="cart_quantity_up" style="text-decoration: none;display: none" onclick="cart_add_ajax_admin('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')"> + </a>
                                                        <input class="cart_quantity_input" type="number" min="1" readonly style="width:38px" id="qtyValue{{$i}}"  onchange="cart_set_qty_admin('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')" name="quantity" value="{{$product->qty}}" autocomplete="off" size="2">
                                                        <input value="{{$product->rowId}}" id="rowId{{$i}}" style="display: none">
                                                        <a class="cart_quantity_down" style="text-decoration: none;display: none"  onclick="cart_minus_ajax_admin('rowId{{$i}}','qtyValue{{$i}}','totalProductPrice{{$i}}','idPrice{{$i}}')"> - </a>
                                                        <input value="{{$product->price}}"class="cart-product-price" id="idPrice{{$i}}" style="display: none">
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price" id="totalProductPrice{{$i}}">{{number_format($product->price*$product->qty, 0, ',', '.')}}</p>
                                                </td>
                                                <td class="cart_delete">
                                                    <a class="cart_quantity_delete" style="display: none" onclick="cart_delete_admin('rowId{{$i}}')"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $i ++;
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

                                                        @if($bill[0]->ChietKhau>0)
                                                        <tr>
                                                            <td>Tổng Tiền</td>
                                                            <td><span style="color: #30a5ff;text-decoration: line-through" id="showTotal">{{number_format($total, 0, ',', '.')}} VND</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chiết Khấu</td>
                                                            <td><span style="color: #30a5ff" id="ck">{{$bill[0]->ChietKhau}}</span><span style="color: #30a5ff"> %</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giá Sau Chiết Khấu</td>
                                                            <td><span style="color: #30a5ff" id="showTotal2">{{number_format($bill[0]->Gia-round($bill[0]->Gia/100*$bill[0]->ChietKhau/1000)*1000, 0, ',', '.')}} VND</span></td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td>Tổng Tiền</td>
                                                            <td><span style="color: #30a5ff" id="showTotal">{{number_format($total, 0, ',', '.')}}</span></td>
                                                        </tr>
                                                        @endif

                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12" @if($type=='detail') style="display: none" @endif>
                                <div class="checkbox">
                                    <label style="font-size: 20px">
                                        <input type="checkbox" id="chkChinhSua" name="chkChinhSua" onchange="chkChinhSuaChecked()" style="height: 20px">Chỉnh Sửa Thông Tin
                                    </label>
                                </div>
                                <center><button type="submit" name="Submit" class="btn btn-primary">Xác Nhận Đơn Hàng</button>
                                <button  class="btn btn-default">Xóa Đơn Hàng</button></center>
                            </div>

                        </form>
                        <script>
                            function chkChinhSuaChecked() {
                                if(document.getElementById("chkChinhSua").checked){
                                    document.getElementsByName("tenKhachHang")[0].readOnly =false;
                                    document.getElementsByName("mailKhachHang")[0].readOnly =false;
                                    document.getElementsByName("soDienThoai")[0].readOnly =false;
                                    document.getElementsByName("diaChi")[0].readOnly =false;
                                    document.getElementsByName("ghiChu")[0].readOnly =false;

                                    for(var i=0;i<'{{$i}}';i++){
                                        document.getElementsByClassName("cart_quantity_up")[i].style.display ='block';
                                        document.getElementsByClassName("cart_quantity_down")[i].style.display ='block';
                                        document.getElementsByClassName("cart_quantity_delete")[i].style.display ='block';
                                    }
                                }else{
                                    document.getElementsByName("tenKhachHang")[0].readOnly =true;
                                    document.getElementsByName("mailKhachHang")[0].readOnly =true;
                                    document.getElementsByName("soDienThoai")[0].readOnly =true;
                                    document.getElementsByName("diaChi")[0].readOnly =true;
                                    document.getElementsByName("ghiChu")[0].readOnly =true;

                                    for(var i=0;i<'{{$i}}';i++){
                                        document.getElementsByClassName("cart_quantity_up")[i].style.display ='none';
                                        document.getElementsByClassName("cart_quantity_down")[i].style.display ='none';
                                        document.getElementsByClassName("cart_quantity_delete")[i].style.display ='none';
                                    }
                                }
                            }


                            function cart_add_ajax_admin(_rowId,_qty,_productPrice,price){
                                var rowId = document.getElementById(_rowId).value;
                                var qty = document.getElementById(_qty).value;
                                var price = document.getElementById(price).value;
                                qty = parseInt(qty);
                                qty++;
                                price = parseInt(price);
                                $.ajax({
                                    url : "{{route('cart-update-qty-admin')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        number : qty,
                                        id : rowId
                                    },
                                    success : function (result){
                                        document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                                        var a  =document.getElementById('ck').value;
                                        var b =result-Math.floor(result/100*a/1000)*1000;
                                        document.getElementById('showTotal2').innerHTML=accounting.formatMoney(b,'',0,'.',',')+' VND';
                                    }
                                });

                                document.getElementById(_qty).value = qty;
                                document.getElementById(_productPrice).innerHTML=accounting.formatMoney(price*qty,'',0,'.',',');

                            }

                            function cart_minus_ajax_admin(_rowId,_qty,_productPrice,price){
                                var rowId = document.getElementById(_rowId).value;
                                var qty = document.getElementById(_qty).value;
                                var price = document.getElementById(price).value;
                                qty = parseInt(qty);
                                if(qty>1)
                                    qty--;
                                price = parseInt(price);
                                $.ajax({
                                    url : "{{route('cart-update-qty-admin')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        number : qty,
                                        id : rowId
                                    },
                                    success : function (result){
                                        document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                                        var a  =document.getElementById('ck').value;
                                        var b =result-Math.floor(result/100*a/1000)*1000;
                                        document.getElementById('showTotal2').innerHTML=accounting.formatMoney(b,'',0,'.',',')+' VND';
                                    }
                                });
                                document.getElementById(_qty).value = qty;
                                document.getElementById(_productPrice).innerHTML=accounting.formatMoney(price*qty,'',0,'.',',');
                            }

                            function cart_set_qty_admin(_rowId,_qty,_productPrice,price){
                                var rowId = document.getElementById(_rowId).value;
                                var qty = document.getElementById(_qty).value;
                                var p = document.getElementById(price).value;
                                qty = parseInt(qty);
                                if(qty>0) {

                                    $.ajax({
                                        url: "{{route('cart-update-qty-admin')}}",
                                        type: "post",
                                        dateType: "text",
                                        data: {
                                            number: qty,
                                            id: rowId
                                        },
                                        success: function (result) {
                                            document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                                            var a  =document.getElementById('ck').value;
                                            var b =result-Math.floor(result/100*a/1000)*1000;
                                            document.getElementById('showTotal2').innerHTML=accounting.formatMoney(b,'',0,'.',',')+' VND';
                                        }
                                    });
                                    document.getElementById(_qty).value = qty;
                                    document.getElementById(_productPrice).innerHTML = accounting.formatMoney(p*qty,'',0,'.',',');
                                }else {
                                    document.getElementById(_qty).value = '1';
                                    cart_set_qty(_rowId,_qty,_productPrice,price);
                                }
                            }

                            function cart_delete_admin(_rowId){
                                var rowId = document.getElementById(_rowId).value;
                                $.ajax({
                                    url : "{{route('cart-delete-admin')}}",
                                    type : "post",
                                    dateType:"text",
                                    data : {
                                        id : rowId
                                    },
                                    success : function (result){
                                        document.getElementsByClassName(_rowId)[0].innerHTML = '';
                                        document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                                        var a  =document.getElementById('ck').value;
                                        var b =result-Math.floor(result/100*a/1000)*1000;
                                        document.getElementById('showTotal2').innerHTML=accounting.formatMoney(b,'',0,'.',',')+' VND';
                                        if(result=='0'){
                                            document.getElementById('check-out').style.display = "none";
                                        }
                                    }
                                });

                            }
                        </script>
                        {{--Product List--}}
                        {{--<div id="cart_items">--}}
                            {{--<div class="table-responsive cart_info">--}}
                                {{--<table class="table table-condensed">--}}
                                    {{--<thead>--}}
                                    {{--<tr class="cart_menu">--}}
                                        {{--<td class="image">Sản Phẩm</td>--}}
                                        {{--<td class="description"></td>--}}
                                        {{--<td class="price">Giá</td>--}}
                                        {{--<td class="quantity">Số Lượng</td>--}}
                                        {{--<td class="total">Tổng Giá</td>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@php--}}
                                        {{--$total=0;--}}
                                    {{--@endphp--}}
                                    {{--@for($i=0;$i<count($listProduct);$i++)--}}
                                        {{--<tr>--}}
                                            {{--<td class="cart_product">--}}
                                                {{--<a href=""><img src="../{{$listProduct[$i]->AnhDaiDien}}" alt="" width="50px"></a>--}}
                                            {{--</td>--}}
                                            {{--<td class="cart_description">--}}
                                                {{--<h4><a href="{{route('detail-product',$listProduct[$i]->IDSanPham)}}">{{$listProduct[$i]->TenSanPham}}</a></h4>--}}
                                                {{--<p>Mã SP: {{$listProduct[$i]->IDSanPham}}</p>--}}
                                            {{--</td>--}}
                                            {{--<td class="cart_price">--}}
                                                {{--<p>{{number_format($listProduct[$i]->Gia, 0, ',', '.')}} VND</p>--}}
                                            {{--</td>--}}
                                            {{--<td class="cart_quantity">--}}
                                                {{--<div class="cart_quantity_button">--}}
                                                    {{--<p style="font-size: 15px">{{$qtyProduct[$i]}}</p>--}}

                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td class="cart_total">--}}
                                                {{--<p class="cart_total_price">{{number_format($qtyProduct[$i]*$listProduct[$i]->Gia, 0, ',', '.')}}</p>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--@php--}}
                                            {{--$total+= $qtyProduct[$i]*$listProduct[$i]->Gia;--}}
                                        {{--@endphp--}}
                                    {{--@endfor--}}
                                    {{--<tr>--}}
                                        {{--<td colspan="4">&nbsp;</td>--}}
                                        {{--<td colspan="2">--}}
                                            {{--<table class="table table-condensed total-result">--}}
                                                {{--<tr class="shipping-cost">--}}
                                                    {{--<td>Phí Vận Chuyển</td>--}}
                                                    {{--<td>Free</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td>Tổng Tiền</td>--}}
                                                    {{--<td><span style="color: red">{{number_format($total, 0, ',', '.')}}</span></td>--}}
                                                {{--</tr>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--/.Product List--}}
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
        </div>
    </div>	<!--/.main-->
@endsection
