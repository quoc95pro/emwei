@extends('admin.master')
@section('content')
    <script>
        document.getElementById("Product").className += " active";
        document.getElementById("Dashboard").className -= "active";
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Icons</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm Sản Phẩm</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông Tin Sản Phẩm</div>
                    <div class="panel-body">
                        <form role="form">
                        <div class="col-md-6">


                                <div class="form-group">
                                    <label>Loại Sản Phẩm</label>
                                    <select class="form-control" id="productTypeSelect">
                                        @foreach($productTypes as $productType)
                                            <option>{{$productType->LoaiSanPham}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mã Sản Phẩm</label>
                                    <input class="form-control" placeholder="{{$nextID}}" disabled >
                                </div>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Hãng Sản Xuất</label>
                                <select class="form-control" id="companySelect">
                                    @foreach($companies as $company)
                                        <option>{{$company->HangSanXuat}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Mô Tả Sản Phẩm</label>
                                <input class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Tình Trạng</label>
                                <select class="form-control">
                                    <option>Còn Hàng</option>
                                    <option>Hết Hàng</option>
                                    <option>Liên Hệ</option>
                                </select>
                            </div>
                    </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label><input type="checkbox"  onchange="newProductFunction()" id="productTypeCheckBox">  Loại Sản Phẩm Mới</label>
                                    <input class="form-control"  disabled id="productTypeInput">
                                </div>

                                <div class="form-group" style="margin-top: 158px">
                                    <label><input type="checkbox"  onchange="newCompanyFunction()" id="companyCheckBox">  Hãng Sản Xuất Mới</label>
                                    <input class="form-control" disabled id="companyInput">
                                </div>

                            </div>
                        </form>
                        <script>
                            function newProductFunction() {
                               if(document.getElementById("productTypeCheckBox").checked){
                                   document.getElementById("productTypeInput").disabled = false;
                                   document.getElementById("productTypeSelect").disabled = true;
                               }else {
                                   document.getElementById("productTypeInput").disabled = true;
                                   document.getElementById("productTypeSelect").disabled = false;
                               }

                            }

                            function newCompanyFunction() {
                                if(document.getElementById("companyCheckBox").checked){
                                    document.getElementById("companyInput").disabled = false;
                                    document.getElementById("companySelect").disabled = true;
                                }else {
                                    document.getElementById("companyInput").disabled = true;
                                    document.getElementById("companySelect").disabled = false;
                                }

                            }

                        </script>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->

        </div>
    </div>	<!--/.main-->
@endsection
