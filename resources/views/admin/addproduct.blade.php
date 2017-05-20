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
                <li class="active">Thêm Sản Phẩm</li>
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
                        <form enctype="multipart/form-data"  action="{{route('add')}}" method="post">
                            {{csrf_field()}}
                        <div class="col-md-6">


                                <div class="form-group">
                                    <label style="width: 100%">Loại Sản Phẩm</label>
                                    <select class="form-control" name="productType" id="productTypeSelect">
                                            <option>Điện Thoại</option>
                                            <option>Máy Tính Bảng</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label>Hãng Sản Xuất</label>
                                <select class="form-control" id="companySelect" name="productCompany">
                                    @foreach($companies as $company)
                                        <option>{{$company->HangSanXuat}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" required name="productName">
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" type="number" required name="productPrice">
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input class="form-control" type="number" required name="productQTY">
                            </div>
                            <div class="form-group">
                                <label>Tình Trạng</label>
                                <select class="form-control" name="productStatus">
                                    <option>Còn Hàng</option>
                                    <option>Hết Hàng</option>
                                    <option>Đã Xóa</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Thêm Ảnh</label>
                                <div class="container kv-main">
                                        <input id="kv-explorer" type="file" name="image[]" multiple accept="image/*">
                                        <br>
                                </div>
                            </div>
                    </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã Sản Phẩm</label>
                                    <input  class="form-control"  value="{{$nextID}}" name="productID"  readonly >
                                </div>
                                <div class="form-group" >
                                    <label><input type="checkbox"  onchange="newCompanyFunction()" name="companyCheckBox" id="companyCheckBox">  Hãng Sản Xuất Mới</label>
                                    <input class="form-control"  disabled id="companyInput">
                                </div>

                                <div class="form-group" style="margin-top: 70px;border-bottom: 1px solid #eee;border-top:1px solid #eee ">
                                    <label  style="margin-top: 30px">Mô Tả Sản Phẩm</label>
                                    <div style="overflow: auto ;height: 450px">
                                        @foreach($description as $des)

                                            <label>{{$des->MoTa}}</label>
                                            <input class="form-control" name="{{$des->TenMoTa}}">

                                        @endforeach
                                    </div>
                                </div>


                                <button type="submit" name="Submit" style="width: 150px" class="btn btn-primary">Thêm</button>
                                <button type="reset" class="btn btn-default" style="width: 150px">Xóa</button>


                            </div>


                        </form>
                        <script>

                            $("#kv-explorer").fileinput({
                                'theme': 'explorer',
                                'uploadUrl': '#',
                                overwriteInitial: false,
                                initialPreviewAsData: true,
                                initialPreview: [

                                ],
                                initialPreviewConfig: [

                                ],
                                dropZoneTitle: 'Ấn Browse Để Chọn Ảnh Cần Upload .....'
                            });



                            function newCompanyFunction() {
                                if(document.getElementById("companyCheckBox").checked){
                                    document.getElementById("companyInput").disabled = false;
                                    document.getElementById("companySelect").disabled = true;
                                    var txt = document.getElementById("companyInput");
                                    txt.disabled = false;
                                    txt.setAttribute('name','companyInput');
                                    txt.setAttribute('required','true');
                                }else {
                                    var txt = document.getElementById("companyInput");
                                    txt.setAttribute('required','false');
                                    document.getElementById("companyInput").disabled = true;
                                    document.getElementById("companySelect").disabled = false;
                                }

                            }
                                $row =0;

                        </script>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
        </div>
    </div>	<!--/.main-->
@endsection
