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
                                    <label>Mã Sản Phẩm</label>
                                    <input class="form-control"  value="{{$product[0]->IDSanPham}}" name="productID" readonly >
                                </div>
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input class="form-control" value="{{$product[0]->TenSanPham}}" name="productName">
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

                                <div class="form-group" style="margin-top: 70px;border-bottom: 1px solid #eee;border-top:1px solid #eee ">
                                    <label  style="margin-top: 30px">Mô Tả Sản Phẩm</label>
                                    <div style="overflow: auto ;height: 200px">
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
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label><input type="checkbox"  onchange="newProductFunction()" id="productTypeCheckBox">  Loại Sản Phẩm Mới</label>
                                    <input class="form-control"  disabled id="productTypeInput">
                                </div>

                                <div class="form-group" style="margin-top: 158px">
                                    <label><input type="checkbox"  onchange="newCompanyFunction()" id="companyCheckBox">  Hãng Sản Xuất Mới</label>
                                    <input class="form-control"  disabled id="companyInput">
                                </div>



                                <div class="form-group" style="margin-top: 293px;border-bottom: 1px solid #eee;border-top:1px solid #eee ">
                                    <a class="btn btn-primary btn-md"  style="margin-top: 30px" onclick="addNewDescription()">Thêm Mô Tả</a>
                                    <table   data-toggle="table" data-pagination="true">
                                        <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true" ></th>
                                            <th data-field="id" data-sortable="true">Tên Mô Tả</th>
                                            <th data-field="name"  data-sortable="true">Giá Trị</th>
                                        </tr>
                                        </thead>
                                        <tbody id="addNewDiv" style="overflow: auto ;height: 200px">
                                        </tbody>
                                    </table>



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
                            $row =0;
                            function addNewDescription() {
                                var tr = document.createElement("TR");
                                var td1 = document.createElement("TD");
                                td1.className='bs-checkbox';
                                var checkBox = document.createElement("INPUT");
                                checkBox.setAttribute("type","checkbox");
                                checkBox.setAttribute("name","toolbar1");
                                td1.appendChild(checkBox);

                                var td2 = document.createElement("TD");
                                var input1 = document.createElement("INPUT");
                                input1.className='form-control';
                                input1.setAttribute("placeholder","Tên Mô Tả");
                                td2.appendChild(input1);

                                var td3 = document.createElement("TD");
                                var input2 = document.createElement("INPUT");
                                input2.className='form-control';
                                input2.setAttribute("placeholder","Giá Trị");
                                td3.appendChild(input2);
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);

                                document.getElementById("addNewDiv").appendChild(tr)
                                var cur_columns = document.getElementsByClassName('no-records-found');
                                for (var i = 0; i < cur_columns.length; i++) {
                                    cur_columns[i].parentNode.removeChild(cur_columns[i]);
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
