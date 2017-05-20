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
                <h1 class="page-header">Sửa Sản Phẩm</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông Tin Sản Phẩm</div>
                    <div class="panel-body">
                        <form enctype="multipart/form-data"  action="{{route('edit')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Loại Sản Phẩm</label>
                                    <select class="form-control" name="productType" id="productTypeSelect">
                                        @foreach($productTypes as $productType)

                                            @if($productType->LoaiSanPham==$product[0]->LoaiSanPham)
                                                <option selected>{{$productType->LoaiSanPham}}</option>
                                            @else
                                                <option>{{$productType->LoaiSanPham}}</option>
                                                @endif



                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hãng Sản Xuất</label>
                                    <select class="form-control" id="companySelect" name="productCompany">
                                        @foreach($companies as $company)
                                            @if($company->HangSanXuat==$product[0]->HangSanXuat)
                                                <option selected>{{$company->HangSanXuat}}</option>
                                            @else
                                                <option>{{$company->HangSanXuat}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input class="form-control" value="{{$product[0]->TenSanPham}}" name="productName">
                                </div>
                                <div class="form-group">
                                    <label>Giá</label>
                                    <input class="form-control" value="{{$product[0]->Gia}}" name="productPrice">
                                </div>
                                <div class="form-group">
                                    <label>Số Lượng</label>
                                    <input class="form-control" value="{{$product[0]->SoLuong}}" name="productQTY">
                                </div>
                                <div class="form-group">
                                    <label>Tình Trạng</label>
                                    <select class="form-control" name="productStatus">

                                        <option @if($product[0]->TinhTrang=="Còn Hàng") selected @endif>Còn Hàng</option>
                                        <option @if($product[0]->TinhTrang=="Hết Hàng") selected @endif>Hết Hàng</option>
                                        <option @if($product[0]->TinhTrang=="Liên Hệ") selected @endif>Liên Hệ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Ảnh Hiện Có</label>
                                    <div style="overflow: auto ;height: 270px">
                                        @if(count($image)>0)
                                            @foreach($image as $img)
                                                <div style="height:85px;border: 1px solid rgb(221, 221, 221);margin-top: 2px">
                                                    <div style="width: 15%;height:100%;float: left;border-right: 1px solid rgb(221, 221, 221)"><img src="../{{$img->link}}" alt="" style="padding:12px "></div>
                                                    <div style="width: 50%;float: left;border-right: 1px solid rgb(221, 221, 221)"><div style="padding: 30px">{{$img->link}}</div></div>
                                                    <div style="width: 20%;float: left">
                                                        <div style="padding: 30px">
                                                            <button type="button" class="kv-file-remove btn btn-xs btn-default"><i class="glyphicon glyphicon-trash text-danger"></i></button>
                                                            <button type="button" class="kv-file-zoom btn btn-xs btn-default"><i class="glyphicon glyphicon-zoom-in"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            Không Có Ảnh Nào
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã Sản Phẩm</label>
                                    <input class="form-control"  value="{{$product[0]->IDSanPham}}" name="productID" readonly >
                                </div>
                                <div class="form-group" >
                                    <label><input type="checkbox"  onchange="newCompanyFunction()" id="companyCheckBox">  Hãng Sản Xuất Mới</label>
                                    <input class="form-control"  disabled id="companyInput">
                                </div>

                                <div class="form-group">
                                    <label >Mô Tả Sản Phẩm</label>
                                    <div style="overflow: auto ;height: 260px">
                                        @php
                                            $x = preg_split("/;/", $product[0]->MoTa);
                                            $a= array();
                                            foreach ($x as $b){
                                                $c = preg_split("/:/",$b);
                                                $arr1 = array($c[0] => $c[1]);
                                                $a+=$arr1;
                                            }

    //                                        foreach($a as $key=>$test){
    //                                            echo "Key: $key. Gia Tri: $test<br>";
    //                                        }
                                        @endphp

                                        @foreach($description as $des)
                                            @php
                                                $boo=false;
                                            @endphp
                                            @foreach($a as $key=>$test)
                                                @if($key==$des->MoTa)
                                                    <label>{{$des->MoTa}}</label>
                                                    <input class="form-control" value="{{$test}}" name="{{$des->TenMoTa}}">
                                                    @php
                                                        $boo=true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if($boo==false)
                                                <label>{{$des->MoTa}}</label>
                                                <input class="form-control"  name="{{$des->TenMoTa}}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Thêm Ảnh</label>
                                    <div class="container kv-main">

                                        <input id="kv-explorer" type="file" name="image[]" multiple accept="image/*">
                                        <br>

                                    </div>
                                </div>
                                <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>


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

                                ]
                            });

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
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}
                    @endforeach
                </div>
            @endif
            @if(Session::has('thanhcong'))
                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>

            @endif
        </div>
    </div>	<!--/.main-->
@endsection
