@if(!(Session::has('admin')))
    <script type="text/javascript">
        window.location = "{{route('login-admin')}}";//here double curly bracket
    </script>
@endif
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Dashboard</title>

    <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('themes/explorer/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('themes/explorer/theme.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/accouting.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <!--Icons-->
    <script src="{{ URL::asset('js/lumino.glyphs.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/html5shiv.js')}}"></script>
    <script src="{{ URL::asset('js/respond.min.js')}}"></script>
    <![endif]-->

    <script src="{{ URL::asset('js/chart.min.js')}}"></script>
    <script src="{{ URL::asset('js/chart-data.js')}}"></script>
    <script src="{{ URL::asset('js/easypiechart.js')}}"></script>
    <script src="{{ URL::asset('js/easypiechart-data.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap-table.js')}}"></script>
    <style>

        .width40{
            width: 49%;
            float: left;
        }

        .kv-file-upload{
            display: none;

        }
        .file-drop-zone{
            overflow: scroll;
            height: 200px;

        }
        .fileinput-upload-button{
            display: none;
        }
        .kv-main{
            width: 100%;
        }



        .table-hover>tbody>tr>td>a{
            display: none;
            text-decoration: none;
            float: left;
            margin: 3px;
            border-right: solid 1px #c1c1c1;
            padding-right: 4px;
        }
        .table-hover>tbody>tr>td>a:hover{
            color: red;
        }
        .table-hover>tbody>tr:hover>td>a{
            display: block;
            text-decoration: none;
        }
        .form-group>label{
            color: #30a5ff;
        }
        .table-hover>tbody>tr>td>.view-button{
            border-right: none;
            padding-right: 4px;
        }

        /*cart*/
        #cart_items .cart_info {
            border: 1px solid #E6E4DF;
            margin-bottom: 50px
        }


        #cart_items .cart_info .cart_menu {
            background: #30a5ff;
            color: #fff;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            font-weight: normal;
        }

        #cart_items .cart_info .table.table-condensed thead tr {
            height: 51px;
        }


        #cart_items .cart_info .table.table-condensed tr {
            border-bottom: 1px solid#F7F7F0
        }

        #cart_items .cart_info .table.table-condensed tr:last-child {
            border-bottom: 0
        }

        .cart_info table tr td {
            border-top: 0 none;
            vertical-align: inherit;
        }


        #cart_items .cart_info .image {
            padding-left: 30px;
        }


        #cart_items .cart_info .cart_description h4 {
            margin-bottom: 0
        }

        #cart_items .cart_info .cart_description h4 a {
            color: #363432;
            font-family: 'Roboto',sans-serif;
            font-size: 20px;
            font-weight: normal;

        }

        #cart_items .cart_info .cart_description p {
            color:#696763
        }


        #cart_items .cart_info .cart_price p {
            color:#696763;
            font-size: 18px
        }


        #cart_items .cart_info .cart_total_price {
            color: #30a5ff;
            font-size: 24px;
        }

        .cart_product {
            display: block;
            margin: 15px -70px 10px 25px;
        }

        .cart_quantity_button a {
            background:#F0F0E9;
            color: #696763;
            display: inline-block;
            font-size: 16px;
            height: 28px;
            overflow: hidden;
            text-align: center;
            width: 35px;
            float: left;
        }


        .cart_quantity_input {
            color: #696763;
            float: left;
            font-size: 16px;
            text-align: center;
            font-family: 'Roboto',sans-serif;

        }
    </style>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })


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
                    if(result=='0'){
                        document.getElementById('check-out').style.display = "none";
                    }
                }
            });

        }
        //Chart
        function Chart_By_Day(){
            var start = document.getElementById("startDate").value;
            var end = document.getElementById("endDate").value;
            $('#data').bootstrapTable('refresh',{
                url: "http://localhost/emwei/public/json2/"+start+"/"+end+""
            });
        }
    </script>
</head>

<body>
@include('admin.header')
@include('admin.sidebar')
@yield('content')

<script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
<script>
//    $('#calendar').datepicker({
//    });

    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })

    $(function () {
        $('#hover, #striped, #condensed').click(function () {
            var classes = 'table';

            if ($('#hover').prop('checked')) {
                classes += ' table-hover';
            }
            if ($('#condensed').prop('checked')) {
                classes += ' table-condensed';
            }
            $('#table-style').bootstrapTable('destroy')
                .bootstrapTable({
                    classes: classes,
                    striped: $('#striped').prop('checked')
                });
        });
    });

    function rowStyle(row, index) {
        var classes = ['active', 'success', 'info', 'warning', 'danger'];

        if (index % 2 === 0 && index / 2 < classes.length) {
            return {
                classes: classes[index / 2]
            };
        }
        return {};
    }

</script>


</body>

</html>
