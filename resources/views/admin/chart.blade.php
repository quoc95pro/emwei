	@extends('admin.master')
	@section('script')
		<script src="{{ URL::asset('js3/bootstrap-table.js')}}"></script>
		<script src="{{ URL::asset('js3/bootstrap-table-filter-control.js')}}"></script>

	@stop
	@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
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
						<div id="toolbar">
							<select class="form-control">
								<option value="">Export Basic</option>
								<option value="all">Export All</option>
								<option value="selected">Export Selected</option>
							</select>
						</div>
						<table data-toggle="table"
							   id="data2"
							   data-show-export="true"
							   data-toolbar="#toolbar"
							   data-page-list="[5, 10, 15, 20, All]"
							   data-url="http://emwei.tk/all"
							   data-show-refresh="true"
							   data-show-toggle="true"
							   data-click-to-select="true"
							   data-show-columns="true"
							   data-search="true"
							   data-filter-control="true"
							   data-filter-show-clear="true"
							   data-pagination="true"
							   data-sort-name="name" data-sort-order="desc"
							   data-select-item-name="toolbar1"
							   class="table table-hover">
							<thead>
							<tr>
								<th data-field="state" data-checkbox="true" ></th>
								<th data-field="maSanPham" data-sortable="true">Mã Sản Phẩm</th>
								<th data-field="tenSanPham"  data-sortable="true" data-filter-control="select">Tên Sản Phẩm</th>
								<th data-field="soLuongBanDuoc" data-sortable="true">Số Lượng Bán Được (Chiếc)</th>

							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Charts</h1>
				
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading">Line Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Bar Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Pie Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Doughnut Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="doughnut-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Label:</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Label:</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Label:</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Label:</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
											
	</div>	<!--/.main-->
@endsection


