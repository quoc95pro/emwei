<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="{{ URL::asset('css/bootstrap-table.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/accouting.js') }}"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/bootstrap-table.js')}}"></script>
    <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ URL::asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('images/ico/apple-touch-icon-57-precomposed.png') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    {{--cart--}}
    <style>
        .checkout-input{
            background: #F0F0E9;
            border: 0 none;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            font-weight: 300;
        }

    </style>
</head><!--/head-->

<body>
@include('header')
<div class="rev-slider">
    @yield('content')
</div> <!-- .container -->
@include('footer')



<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ URL::asset('js/price-range.js') }}"></script>
<script src="{{ URL::asset('js/jquery.prettyPhoto.js') }}"></script>
</body>
</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(function () {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2013',
            dateFormat: 'yy-mm-dd',
            defaultDate: '1950-01-01'

        });

    });
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })


    function cart_add_ajax(_rowId,_qty,_productPrice,price){
        var rowId = document.getElementById(_rowId).value;
        var qty = document.getElementById(_qty).value;
        var price = document.getElementById(price).value;
        qty = parseInt(qty);
        qty++;
        price = parseInt(price);
        $.ajax({
            url : "{{route('cart-update-qty')}}",
            type : "post",
            dateType:"text",
            data : {
                number : qty,
                id : rowId
            },
            success : function (result){
                document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
            }
        });

        document.getElementById(_qty).value = qty;
        document.getElementById(_productPrice).innerHTML=accounting.formatMoney(price*qty,'',0,'.',',');

    }

    function cart_minus_ajax(_rowId,_qty,_productPrice,price){
        var rowId = document.getElementById(_rowId).value;
        var qty = document.getElementById(_qty).value;
        var price = document.getElementById(price).value;
        qty = parseInt(qty);
        if(qty>1)
        qty--;
        price = parseInt(price);
        $.ajax({
            url : "{{route('cart-update-qty')}}",
            type : "post",
            dateType:"text",
            data : {
                number : qty,
                id : rowId
            },
            success : function (result){
                document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
            }
        });
        document.getElementById(_qty).value = qty;
        document.getElementById(_productPrice).innerHTML=accounting.formatMoney(price*qty,'',0,'.',',');
    }

    function cart_set_qty(_rowId,_qty,_productPrice,price){
        var rowId = document.getElementById(_rowId).value;
        var qty = document.getElementById(_qty).value;
        var p = document.getElementById(price).value;
        qty = parseInt(qty);
        if(qty>0) {

            $.ajax({
                url: "{{route('cart-update-qty')}}",
                type: "post",
                dateType: "text",
                data: {
                    number: qty,
                    id: rowId
                },
                success: function (result) {
                    document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                }
            });
            document.getElementById(_qty).value = qty;
            document.getElementById(_productPrice).innerHTML = accounting.formatMoney(p*qty,'',0,'.',',');
        }else {
            document.getElementById(_qty).value = '1';
            cart_set_qty(_rowId,_qty,_productPrice,price);
        }
    }

    function cart_delete(_rowId){
        var rowId = document.getElementById(_rowId).value;
        $.ajax({
            url : "{{route('cart-delete')}}",
            type : "post",
            dateType:"text",
            data : {
                id : rowId
            },
            success : function (result){
                document.getElementsByClassName(_rowId)[0].innerHTML = '';
                document.getElementById('showTotal').innerHTML=accounting.formatMoney(result,'',0,'.',',');
                if(result=='0'){
                    document.getElementById('check-out').style.display = "none";
                }
            }
        });

    }
</script>
