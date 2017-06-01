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
                <li class="active">Thêm Phụ Kiện</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm Phụ Kiện</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông Tin Phụ Kiện</div>
                    <div class="panel-body">
                        <form enctype="multipart/form-data"  action="{{route('addNewAccessory')}}" method="post">
                            {{csrf_field()}}
                        <div class="col-md-6">


                                <div class="form-group">
                                    <label style="width: 100%">Loại Phụ Kiện</label>
                                    <select class="form-control" name="accessoryType" id="typeSelect">
                                        @foreach($accessoryTypes as $type)
                                            <option>{{$type->LoaiPhuKien}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                <label>Tên Phụ Kiện</label>
                                <input class="form-control" required name="accessoryName">
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" type="number" required name="accessoryPrice">
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input class="form-control" type="number" required name="accessoryQTY">
                            </div>
                            <div class="form-group">
                                <label>Tình Trạng</label>
                                <select class="form-control" name="accessoryStatus">
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
                                <div class="form-group" >
                                    <label><input type="checkbox"  onchange="newTypeFunction()" name="typeCheckBox" id="typeCheckBox">Loại Phụ Kiện Mới</label>
                                    <input class="form-control"  disabled id="typeInput">
                                </div>
                                <div class="form-group">
                                    <label>Mã Phụ Kiện</label>
                                    <input  class="form-control"  value="{{$nextID}}" name="accessoryID"  readonly >
                                </div>
                                <div class="form-group">
                                    <label>Phụ Kiện Cho Sản Phẩm</label>
                                    <select class="form-control" name="productID">
                                        @foreach($allProduct as $product)
                                            <option value="{{$product->IDSanPham}}">{{$product->IDSanPham}}-{{$product->TenSanPham}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="margin-top: 70px;border-bottom: 1px solid #eee;border-top:1px solid #eee ">
                                    <label  style="margin-top: 30px">Mô Tả Phụ Kiện</label>
                                    <textarea class="form-control" rows="18" name="accessoryDescription"></textarea>
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



                            function newTypeFunction() {
                                if(document.getElementById("typeCheckBox").checked){
                                    document.getElementById("typeInput").disabled = false;
                                    document.getElementById("typeSelect").disabled = true;
                                    var txt = document.getElementById("typeInput");
                                    txt.disabled = false;
                                    txt.setAttribute('name','typeInput');
                                    txt.setAttribute('required','true');
                                }else {
                                    var txt = document.getElementById("typeInput");
                                    txt.setAttribute('required','false');
                                    document.getElementById("typeInput").disabled = true;
                                    document.getElementById("typeSelect").disabled = false;
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
