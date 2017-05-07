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
                <li class="active">Thêm Loại Sản Phẩm</li>
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
                        <form enctype="multipart/form-data"  action="{{route('add-ProductType')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên Loại Sản Phẩm </label>
                                   <input class="form-control" name="productTypeName" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control" id="numberOfDescription" style="display: none" name="numberOfDescription"/>
                                <div class="panel panel-default">
                                    <div class="panel-heading"><a class="btn btn-primary btn-md" onclick="addNewDescription()">Thêm Mô Tả</a> </div>
                                    <div class="panel-body">
                                        <table data-toggle="table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Mô tả</th>
                                                <th>Xóa</th>
                                            </tr>
                                            </thead>
                                            <tbody id="addNewDiv">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <button type="submit" name="Submit" style="width: 150px" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default" style="width: 150px">Reset</button>


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
                            var row =0;
                            function addNewDescription() {
                                var tr = document.createElement("TR");
                                tr.setAttribute('id','mota'+row);
                                var td2 = document.createElement("TD");
                                var input1 = document.createElement("INPUT");
                                input1.className='form-control';
                                input1.setAttribute("placeholder","Tên Mô Tả");
                                input1.setAttribute("name",'mota'+row);
                                td2.appendChild(input1);

                                var td3 = document.createElement("TD");
                                var input2 = document.createElement("p");
                                input2.innerHTML='Xóa';
                                input2.className='btn btn-default';
                                input2.setAttribute('id','mota'+row);
                                input2.setAttribute('onclick','deleteFunction(id);');
                                td3.appendChild(input2);

                                tr.appendChild(td2);
                                tr.appendChild(td3);

                                document.getElementById("addNewDiv").appendChild(tr)
                                var cur_columns = document.getElementsByClassName('no-records-found');
                                for (var i = 0; i < cur_columns.length; i++) {
                                    cur_columns[i].parentNode.removeChild(cur_columns[i]);
                                }
                            row++;
                            var numberOfDescription = document.getElementById('numberOfDescription');
                            numberOfDescription.value=row;
                            }

                            function deleteFunction(id) {
                                var tr = document.getElementById(id);
                                tr.parentNode.removeChild(tr);
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
