	@extends('admin.master')
	@section('content')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Tổng Quan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tổng Quan</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$countNewOrder}}</div>
							<div class="text-muted">Đơn Hàng Ngày Hôm Nay</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						@php
							$visitor = Storage::get('countVisitor.log');
						@endphp
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$visitor}}</div>
							<div class="text-muted">Lượt Truy Cập Trang</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">{{$countNewUser}}</div>
							<div class="text-muted">Tài Khoản Mới</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">25.2k</div>
							<div class="text-muted">Page Views</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					 <div style="float: left;margin-left: 50px">Số đơn đặt hàng :</div><div style="margin-left: 10px ;width: 45px;height: 45px;background-color: rgba(48, 164, 255, 0.2);float: left"></div>
						<div style="float: left;margin-left: 50px">Số lượng sản phẩm bán được :</div>	<div style="margin-left: 10px ;width: 45px;height: 45px;background-color: #ddd;float: left"></div>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>

						</div>
						<script>
                            var barChartData = {
                                labels : ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
                                datasets : [
                                    {
                                        label: "My First dataset",
                                        fillColor : "#ddd",
                                        strokeColor : "rgba(220,220,220,1)",
                                        pointColor : "rgba(220,220,220,1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(220,220,220,1)",
                                        data : [{{$countProduct[0]}},{{$countProduct[1]}},{{$countProduct[2]}},{{$countProduct[3]}},{{$countProduct[4]}},{{$countProduct[5]}},{{$countProduct[6]}},{{$countProduct[7]}},{{$countProduct[8]}},{{$countProduct[9]}},{{$countProduct[10]}},{{$countProduct[11]}}]
                                    },
                                    {
                                        label: "My Second dataset",
                                        fillColor : "rgba(48, 164, 255, 0.2)",
                                        strokeColor : "rgba(48, 164, 255, 1)",
                                        pointColor : "rgba(48, 164, 255, 1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(48, 164, 255, 1)",
                                        data : [{{$countBill[0]}},{{$countBill[1]}},{{$countBill[2]}},{{$countBill[3]}},{{$countBill[4]}},{{$countBill[5]}},{{$countBill[6]}},{{$countBill[7]}},{{$countBill[8]}},{{$countBill[9]}},{{$countBill[10]}},{{$countBill[11]}}]
                                    }
                                ]
//								datasets : datasetValue
                            }

                            var chart2 = document.getElementById("bar-chart").getContext("2d");
                            window.myBar = new Chart(chart2).Bar(barChartData, {
                                responsive : true
                            });
						</script>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
@endsection
