    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh Mục</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                Điện Thoại
                            </a>
                        </h4>
                    </div>
                    <div id="sportswear" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $hangSanXuat = DB::select("SELECT HangSanXuat FROM tbl_sanpham WHERE LoaiSanPham ='Điện thoại' GROUP BY HangSanXuat");
                                @endphp

                                @foreach($hangSanXuat as $hang)
                                    <li><a href="shop.html">{{$hang->HangSanXuat}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                Máy Tính Bảng
                            </a>
                        </h4>
                    </div>
                    <div id="mens" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @php
                                    $hangSanXuat = DB::select("SELECT HangSanXuat FROM tbl_sanpham WHERE LoaiSanPham ='Máy tính bảng' GROUP BY HangSanXuat");
                                @endphp

                                @foreach($hangSanXuat as $hang)
                                    <li><a href="shop.html">{{$hang->HangSanXuat}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                Phụ Kiện
                            </a>
                        </h4>
                    </div>
                    <div id="womens" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @php
                                    $loaiPhuKien = DB::select("SELECT LoaiPhuKien FROM tbl_phukien GROUP BY LoaiPhuKien");
                                @endphp

                                @foreach($loaiPhuKien as $loai)
                                    <li><a href="shop.html">{{$loai->LoaiPhuKien}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div><!--/category-products-->

            <div class="brands_products"><!--brands_products-->
                <h2>Hãng</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        @php
                            $left = DB::select("SELECT HangSanXuat,COUNT(*) AS Count FROM `tbl_sanpham` GROUP BY HangSanXuat");
                        @endphp
                        @foreach($left as $l)
                            <li><a href="#"> <span class="pull-right">({{$l -> Count}})</span>{{$l -> HangSanXuat}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div><!--/brands_products-->


            <div class="shipping text-center"><!--shipping-->
                <img src="{{ URL::asset('images/home/shipping.jpg') }}" alt="" />
            </div><!--/shipping-->

        </div>
    </div>