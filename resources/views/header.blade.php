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
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('trang-chu')}}"><img src="{{ URL::asset('images/home/logo.gif') }}" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-user"></i> Tài khoản</a></li>
                            <li><a href="{{route('contact-us')}}"><i class="fa fa-star"></i> Liên hệ</a></li>
                            <li><a href="{{route('checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            @if(Session::has('userName'))
                                <li><a href="">Chào bạn {{Session::get('userName')}}</a></li>
                                <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                            @else
                                <li><a href="{{route('dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
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
                            <li class="dropdown"><a href="{{route('list-product/type','Điện thoại')}}">Điện Thoại<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Apple</a></li>
                                    <li><a href="product-details.html">SamSung</a></li>
                                    <li><a href="checkout.html">ASUS</a></li>
                                    <li><a href="cart.html">OPPO</a></li>
                                    <li><a href="login.html">Sony</a></li>
                                    <li><a href="login.html">Xiao Mi</a></li>
                                    <li><a href="login.html">Vivo</a></li>
                                    <li><a href="login.html">HTC</a></li>
                                    <li><a href="login.html">Huawei</a></li>
                                    <li><a href="login.html">Lenovo</a></li>
                                    <li><a href="login.html">Pantech</a></li>
                                    <li><a href="login.html">Coolpad</a></li>
                                    <li><a href="login.html">Itel</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{route('list-product/type','Máy tính bảng')}}">Máy Tính Bảng<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Apple-Ipad</a></li>
                                    <li><a href="blog-single.html">SamSung</a></li>
                                    <li><a href="blog-single.html">Sony</a></li>
                                    <li><a href="blog-single.html">ASUS</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Phụ Kiện<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Apple-Ipad</a></li>
                                    <li><a href="blog-single.html">SamSung</a></li>
                                    <li><a href="blog-single.html">Sony</a></li>
                                    <li><a href="blog-single.html">ASUS</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->