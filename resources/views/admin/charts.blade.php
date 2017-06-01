	@extends('admin.master')
	@section('script')
		<script src="{{ URL::asset('js/bootstrap-table.js')}}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/tableExport.js')}}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/bt.js')}}"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/extensions/export/bootstrap-table-export.js"></script>

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
													   data-url="http://localhost:8080/emwei/public/json/{{date('Y')}}" data-select-item-name="toolbar1" data-height="580"
													   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-filter-control="true"
													    data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-hover">
													<thead>
													<tr>
														<th data-field="state" data-radio="true" ></th>
														<th data-field="maSanPham" data-filter-control="select" data-sortable="true">Mã Sản Phẩm</th>
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
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="col-md-3">
								<h4>Thống Kế Theo Thời Gian :</h4>
							</div>
							<div class="col-md-2">
								<input class="form-control datepicker" type="text" id="startDate" placeholder="Ngày Bắt Đầu">
							</div>
							<div class="col-md-2">
								<input class="form-control datepicker" type="text" id="endDate" placeholder="Ngày Kết Thúc">
							</div>
							<div class="col-md-2">
								<button type="submit" style="margin-top: -13px" class="btn btn-primary" onclick="Chart_By_Day()">Lọc</button>
							</div>
							<script src="{{ URL::asset('js/bootstrap-datepicker.js')}}"></script>
							<script>

                                $(function () {
                                    $( ".datepicker" ).datepicker({
                                        format:'yyyy-mm-dd',
                                        startDate:'{{$minDate[0]->NgayTao}}',
                                        endDate:'{{$maxDate[0]->NgayTao}}'


                                    });

                                });

                                function Chart_By_Day(){
                                    var start = document.getElementById("startDate").value;
                                    var end = document.getElementById("endDate").value;
                                    $('#data').bootstrapTable('refresh',{
                                        url: "http://localhost:8080/emwei/public/json2/"+start+"/"+end+""
                                    });
                                }
							</script>
						</div>
						<div class="panel-body" id="table">
							<div id="toolbar">
								<select class="form-control">
									<option value="">Export Basic</option>
									<option value="all">Export All</option>
									<option value="selected">Export Selected</option>
								</select>
							</div>
							<table data-toggle="table" id="data" data-show-export="true" data-toolbar="#toolbar" data-page-list="[5, 10, 15, 20, All]" data-height="550"
								   data-url="http://localhost:8080/emwei/public/all"  data-show-refresh="true" data-show-toggle="true" data-click-to-select="true"
								   data-show-columns="true" data-search="true"  data-pagination="true" data-sort-name="name" data-sort-order="desc"
								   data-select-item-name="toolbar1" class="table table-hover">
								<thead>
								<tr>
									<th data-field="state" data-checkbox="true" ></th>
									<th data-field="maSanPham" data-sortable="true">Mã Sản Phẩm</th>
									<th data-field="tenSanPham"  data-sortable="true" >Tên Sản Phẩm</th>
									<th data-field="soLuongBanDuoc" data-sortable="true">Số Lượng Bán Được (Chiếc)</th>

								</tr>
								</thead>
							</table>
							<script type="text/javaScript">

                                function detailFormatter(index, row) {
                                    var html = [];
                                    $.each(row, function (key, value) {
                                        html.push('<p><b>' + key + ':</b> ' + value + '</p>');
                                    });
                                    return html.join('');
                                }

                                function DoOnCellHtmlData(cell, row, col, data) {
                                    var result = "";
                                    if (typeof data != 'undefined' && data != "") {
                                        var html = $.parseHTML(data);

                                        $.each( html, function() {
                                            if ( typeof $(this).html() === 'undefined' )
                                                result += $(this).text();
                                            else if ( typeof $(this).attr('class') === 'undefined' || $(this).hasClass('th-inner') === true )
                                                result += $(this).html();
                                        });
                                    }
                                    return result;
                                }

                                $(function () {
                                    $('#toolbar').find('select').change(function () {
                                        $('#data').bootstrapTable('refreshOptions', {
                                            exportDataType: $(this).val()
                                        });
                                    });
                                })

                                $(document).ready(function()
                                {
                                    $('#data').bootstrapTable('refreshOptions', {
                                        exportOptions: {ignoreColumn: [0], // or as string array: ['0','checkbox']
                                            onCellHtmlData: DoOnCellHtmlData}
                                    });
                                });

							</script>
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
                        url: "http://localhost:8080/emwei/public/json/"+x+""
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


