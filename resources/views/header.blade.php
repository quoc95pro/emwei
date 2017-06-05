<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +84 89 98 89 989</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> emwei@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/?lang=vi"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="https://www.google.com.vn/"><i class="fa fa-google-plus"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo pull-left">
                        <a href="{{route('trang-chu')}}"><img src="{{ URL::asset('images/home/logo.gif') }}" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-10">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('construction')}}"><i class="fa fa-ambulance"></i> Hướng dẫn mua hàng</a></li>
                            <li><a href="{{route('contact-us')}}"><i class="fa fa-star"></i> Liên hệ</a></li>
                            <li><a href="{{route('checkout')}}"><i class="fa fa-check"></i> Thanh toán</a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            @if(Session::has('userName'))
                                <li><a href="{{route('userPage')}}"><i class="fa fa-user"></i>Chào bạn ,{{Session::get('userName')->TenKhachHang}}</a></li>
                                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                            @else
                                <li><a href="{{route('dang-nhap')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                                <li><a href="{{route('dang-ky')}}"><i class="fa fa-lock"></i> Đăng Ký</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('trang-chu')}}" class="active">Trang Chủ</a></li>
                            <li class="dropdown"><a href="{{route('listProduct',['Điện thoại','all'])}}">Điện Thoại<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @php
                                       use Illuminate\Support\Facades\DB;
                                       $hangSanXuat = DB::select("SELECT HangSanXuat FROM tbl_sanpham WHERE LoaiSanPham ='Điện thoại' GROUP BY HangSanXuat");
                                    @endphp

                                    @foreach($hangSanXuat as $hang)
                                        <li><a href="{{route('listProduct',['Điện thoại',$hang->HangSanXuat])}}">{{$hang->HangSanXuat}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{route('listProduct',['Máy tính bảng','all'])}}">Máy Tính Bảng<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @php
                                        $hangSanXuat = DB::select("SELECT HangSanXuat FROM tbl_sanpham WHERE LoaiSanPham ='Máy tính bảng' GROUP BY HangSanXuat");
                                    @endphp

                                    @foreach($hangSanXuat as $hang)
                                        <li><a href="{{route('listProduct',['Máy tính bảng',$hang->HangSanXuat])}}">{{$hang->HangSanXuat}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{route('listProduct',['PhuKien','all'])}}">Phụ Kiện<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @php
                                        $loaiPhuKien = DB::select("SELECT LoaiPhuKien FROM tbl_phukien GROUP BY LoaiPhuKien");
                                    @endphp

                                    @foreach($loaiPhuKien as $loai)
                                        <li><a href="{{route('listProduct',['PhuKien',$loai->LoaiPhuKien])}}">{{$loai->LoaiPhuKien}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" onkeyup="showResult(this.value)"/>
                        <div id="resultsearch" style="background-color:white;z-index: 999;position: absolute;width: 300px">

                        </div>
                    </div>
                </div>
                <script>
                    function showResult(str) {
                        if (str.length==0) {
                            document.getElementById("resultsearch").innerHTML="";
                            document.getElementById("resultsearch").style.border="0px";
                            return;
                        }
                        $.ajax({
                            url : "{{route('search')}}",
                            type : "post",
                            dateType:"text",
                            data : {
                                key : str,
                            },
                            success : function (result){
                                document.getElementById("resultsearch").innerHTML=result;
                            }
                        });

                    }
                </script>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->