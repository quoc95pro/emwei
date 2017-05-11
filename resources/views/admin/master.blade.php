@if(!(Session::has('admin')))
    <script type="text/javascript">
        window.location = "{{route('login-admin')}}";//here double curly bracket
    </script>
@endif
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>

    <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('themes/explorer/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('themes/explorer/theme.js')}}" type="text/javascript"></script>
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

        .table-hover tr{
            height: 70px;
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

    </style>
</head>

<body>
@include('admin.header')
@include('admin.sidebar')
@yield('content')

<script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
<script>
    $('#calendar').datepicker({
    });

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
