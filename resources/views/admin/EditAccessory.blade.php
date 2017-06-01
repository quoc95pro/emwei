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
                <li class="active">Sửa Phụ Kiện</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa Phụ Kiện</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông Tin Phụ Kiện</div>
                    <div class="panel-body">
                        <form enctype="multipart/form-data"  action="{{route('editAccessory')}}" method="post">
                            {{csrf_field()}}
                        <div class="col-md-6">


                                <div class="form-group">
                                    <label style="width: 100%">Loại Phụ Kiện</label>
                                    <select class="form-control" name="accessoryType" id="typeSelect">
                                        @foreach($accessoryTypes as $type)
                                            <option @if($accessory[0]->LoaiPhuKien == $type->LoaiPhuKien) selected @endif>{{$type->LoaiPhuKien}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                <label>Tên Phụ Kiện</label>
                                <input class="form-control" required value="{{$accessory[0]->TenPhuKien}}" name="accessoryName">
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" type="number" value="{{$accessory[0]->Gia}}" required name="accessoryPrice">
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input class="form-control" type="number" value="{{$accessory[0]->SoLuong}}" required name="accessoryQTY">
                            </div>
                            <div class="form-group">
                                <label>Tình Trạng</label>
                                <select class="form-control" name="accessoryStatus">
                                    <option @if($accessory[0]->TinhTrang == 'Còn Hàng') selected @endif>Còn Hàng</option>
                                    <option @if($accessory[0]->TinhTrang == 'Hết Hàng') selected @endif>Hết Hàng</option>
                                    <option @if($accessory[0]->TinhTrang == 'Đã Xóa') selected @endif>Đã Xóa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="imgDeleteID" style="display: none" id="imgDeleteID">
                                <label >Ảnh Hiện Có</label>
                                <div style="overflow: auto ;height: 270px">
                                    @if(count($image)>0)
                                        @php
                                            $i=0;
                                        @endphp


                                        @foreach($image as $img)
                                            <div class="imageDiv" style="height:85px;border: 1px solid rgb(221, 221, 221);margin-top: 2px">
                                                <div style="width: 15%;height:100%;float: left;border-right: 1px solid rgb(221, 221, 221)"><img src="../{{$img->link}}" alt="" style="padding:12px;width: 100%;height: 100% "></div>
                                                <div style="width: 50%;float: left;border-right: 1px solid rgb(221, 221, 221)"><div style="padding: 30px">{{$img->link}}</div></div>
                                                <div style="width: 20%;float: left;height: 100%">
                                                    <div style="padding: 30px">
                                                        <button type="button" onclick="deleteAccessoryImage({{$i}})"  class="kv-file-remove btn btn-xs btn-default"><i class="glyphicon glyphicon-trash text-danger"></i></button>
                                                        <button type="button" class="kv-file-zoom btn btn-xs btn-default" onclick="showImage({{$i}})"><i class="glyphicon glyphicon-zoom-in"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @else
                                        Không Có Ảnh Nào
                                    @endif
                                </div>
                            </div>
                            <script>
                                function deleteAccessoryImage(i) {
                                    var r = confirm("Bạn có chắc muốn xóa ảnh !");
                                    if (r == true) {
                                        document.getElementsByClassName('imageDiv')[i].style.display='none';
                                        document.getElementById('imgDeleteID').value+=i+',';
                                    } else {
                                    }
                                }
                            </script>

                    </div>

                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label><input type="checkbox"  onchange="newTypeFunction()" name="typeCheckBox" id="typeCheckBox">Loại Phụ Kiện Mới</label>
                                    <input class="form-control"  disabled id="typeInput">
                                </div>
                                <div class="form-group">
                                    <label>Mã Phụ Kiện</label>
                                    <input  class="form-control"  value="{{$accessory[0]->IDPhuKien}}" name="accessoryID"  readonly >
                                </div>
                                <div class="form-group">
                                    <label>Phụ Kiện Cho Sản Phẩm</label>
                                    <select class="form-control" name="productID">
                                        @foreach($product as $p)
                                            <option @if($accessory[0]->MaSanPham==$p->IDSanPham) selected @endif value="{{$p->IDSanPham}}">{{$p->IDSanPham}}-{{$p->TenSanPham}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thêm Ảnh</label>
                                    <div class="container kv-main">
                                        <input id="kv-explorer" type="file" name="image[]" multiple accept="image/*">
                                        <br>
                                    </div>
                                </div>

                                <button type="submit" name="Submit" style="width: 150px" class="btn btn-primary">Sửa</button>
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
