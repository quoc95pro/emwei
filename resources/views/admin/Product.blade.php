@extends('admin.master')
@section('css')
    .table-hover>tbody>tr>td>a{
    display: none;
    text-decoration: dashed;
    float: left;
    margin: 3px;
    border-right: solid 1px #c1c1c1;
    padding-right: 4px;
    }

    .table-hover>tbody>tr>td>a:hover{
    color: red;
    }


    .table-hover>tbody>tr:hover>td>a{
    display: block;
    text-decoration: none;
    }

    .table-hover>tbody>tr>td>a.view-button{
    border-right: none;
    padding-right: 4px;
    }
    .table-hover>tbody>tr>td{
     height:65px;
    }
@stop
@section('content')
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
                <h1 class="page-header">Sản phẩm</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Advanced Table</div>
                    <div class="panel-body">
                        <table data-toggle="table"  data-show-refresh="true" data-page-list="[10, 25, 50, 100, All]"  data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-hover">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" ></th>
                                <th data-field="IDSanPham" data-sortable="true">Mã Sản Phẩm</th>
                                <th data-field="TenSanPham"  data-sortable="true">Tên Sản Phẩm</th>
                                <th data-field="Gia" data-sortable="true">Giá</th>
                                <th data-field="TinhTrang" data-sortable="true">Tình Trạng</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($listProduct as $product)
                                <tr style="height: 70px">
                                    <td class="bs-checkbox">
                                        <input name="toolbar1" value="{{$product->IDSanPham}}"  type="checkbox" >

                                    </td>
                                    <td>{{$product->IDSanPham}}<br/>
                                        <a class="edit-button"  href="{{route('edit-product',$product->IDSanPham)}}" >Sửa</a>
                                        <a class="delete-button" href="{{route('delete-product',$product->IDSanPham)}}" >Xóa</a>
                                        <a class="view-button" href="{{route('edit-product',$product->IDSanPham)}}" >Chi tiết</a>
                                    </td>
                                    <td>{{$product->TenSanPham}}</td>
                                    <td>{{$product->Gia}}</td>
                                    <td>{{$product->TinhTrang}}</td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->
    <script src="js/bootstrap-table.js"></script>
@endsection
