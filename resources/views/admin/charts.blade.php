	@extends('admin.master')
	@section('script')
		<script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
		<script src="{{ URL::asset('js3/bootstrap-table-filter-control.js')}}"></script>

	@stop
	@section('content')
		<script>
            document.getElementById("Charts").className += " active";
            document.getElementById("Dashboard").className -= "active";
		</script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Thống Kê</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thống Kê</h1>
			</div><!--/.row-->
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body tabs">
						<div class="tab-content">
								<div class="col-lg-6">
									<div class="panel panel-default">
										<div class="panel-heading">Bảng So Sánh Số Liệu Từng Sản Phẩm</div>
										<div class="panel-body">
											<div class="canvas-wrapper">
												<canvas class="main-chart" id="line-chart" height="520" width="600"></canvas>
											</div>

										</div>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											Sản Phẩm
										</div>
										<div class="panel-body">
											<div class="panel-body">
												<div id="toolbar1">
													<select class="form-control" id="selectYear" onchange="changeYear()">
														@foreach($year as $y)
															<option value="{{$y->Nam}}" @if($y->Nam==date("Y"))selected="true"@endif>{{$y->Nam}}</option>
														@endforeach
													</select>
												</div>
												<table data-toggle="table"  id="tableLineChart" data-toolbar="#toolbar1" data-click-to-select="true"
													   data-url="http://emwei.tk/json/{{date('Y')}}" data-select-item-name="toolbar1" data-height="580"
													   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true"
													    data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-hover">
													<thead>
													<tr>
														<th data-field="state" data-radio="true" ></th>
														<th data-field="maSanPham"  data-sortable="true">Mã Sản Phẩm</th>
														<th data-field="tenSanPham"  data-sortable="true">Tên Sản Phẩm</th>
														<th data-field="soLuongBanDuoc" data-sortable="true">Số Lượng Đã Bán Được (Chiếc)</th>

													</tr>
													</thead>
												</table>

											</div>

										</div>

									</div>
							</div>
						</div>
					</div>
				</div><!--/.panel-->
			</div><!-- /.col-->
			{{--Thong ke theo khach hang--}}
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="col-md-3">
								<h4>Thống Kế Theo Khách Hàng :</h4>
							</div>

							<div class="col-md-4">

							</div>
							<div class="col-md-2">
								<button type="submit" style="margin-top: -13px" class="btn btn-primary" onclick="">Lọc</button>
							</div>
						</div>
						<div class="panel-body" id="table">
							<table data-toggle="table" id="data2" data-show-export="true"  data-page-list="[5, 10, 15, 20, All]"
								   data-url="{{route('customerStatistic')}}"  data-show-refresh="true" data-show-toggle="true" data-click-to-select="true"
								   data-show-columns="true" data-search="true" data-filter-control="true" data-filter-show-clear="true" data-pagination="true"
								   {{--data-sort-name="name" data-sort-order="desc"--}}
								   data-select-item-name="toolbar1" class="table table-hover">
								<thead>
								<tr>
									<th data-field="MaDH" data-filter-control="select" data-sortable="true">Mã Đơn Hàng</th>
									<th data-field="Email"  data-sortable="true" data-filter-control="select">Email Khách Hàng</th>
									<th data-field="Ten" data-filter-control="select" data-sortable="true">Tên Khách Hàng</th>
									<th data-field="Masp" data-filter-control="select" data-sortable="true">Mã Sản Phẩm</th>
									<th data-field="Tensp" data-filter-control="select" data-sortable="true">Tên Sản Phẩm</th>
									<th data-field="SoLuong" data-sortable="true">Số Lượng</th>
									<th data-field="NgayMua" data-filter-control="select" data-sortable="true">Ngày Đặt Hàng</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->
			<script>

                var lineChartData = {
                    labels : ["Tháng 1 ","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
                    datasets : [
                        {
                            label: "Tất Cả",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : [{{$month[0]}},{{$month[1]}},{{$month[2]}},{{$month[3]}},{{$month[4]}},{{$month[5]}},{{$month[6]}},{{$month[7]}},{{$month[8]}},{{$month[9]}},{{$month[10]}},{{$month[11]}}]
                        }
                    ]

                }

                window.onload = function() {
                    var chart1 = document.getElementById("line-chart").getContext("2d");
                    window.myLine = new Chart(chart1).Line(lineChartData, {
                        responsive: true
                    });

                    var chartx = document.getElementById("line-chart-2").getContext("2d");
                    window.myLine = new Chart(chartx).Line(lineChartData, {
                        responsive: true
                    });
                }

				function changeYear() {
                    var x = document.getElementById("selectYear").value;
                    $('#tableLineChart').bootstrapTable('refresh',{
                        url: "http://emwei.tk/json/"+x+""
                    });
                }
				
                $('#tableLineChart').on('check.bs.table', function (e, row) {
                    var selectYear = document.getElementById("selectYear");
                    var selected = selectYear.options[selectYear.selectedIndex].value;
                    $.ajax({
                        url : "{{route('productLineChart')}}",
                        type : "post",
                        dateType:"text",
                        data : {
                            id : row.maSanPham,
							year: selected
                        },
                        success : function (result){
                            var lineChartDataP = {
                                labels : ["Tháng 1 ","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
                                datasets : [
                                    {
                                        label: "Tất Cả",
                                        fillColor : "rgba(220,220,220,0.2)",
                                        strokeColor : "rgba(220,220,220,1)",
                                        pointColor : "rgba(220,220,220,1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(220,220,220,1)",
                                        data : result[1]
                                    },
                                    {
                                        label: "My Second dataset",
                                        fillColor : "rgba(48, 164, 255, 0.2)",
                                        strokeColor : "rgba(48, 164, 255, 1)",
                                        pointColor : "rgba(48, 164, 255, 1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(48, 164, 255, 1)",
                                        data : result[0]
                                    }
                                ]

                            }
                            var chart1 = document.getElementById("line-chart").getContext("2d");
                            window.myLine = new Chart(chart1).Line(lineChartDataP, {
                                responsive: true
                            });
                        }
                    });

                });

			</script>
	</div>	<!--/.main-->
	</div>
@endsection


