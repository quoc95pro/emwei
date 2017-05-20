<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li id="Dashboard" class="active"><a href="{{route('admin-index')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Tổng Quan</a></li>
        <li id="Product" class="parent">
            <a href="{{route('adminAllProduct')}}">
                <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Sản phẩm
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="{{route('adminAllProduct')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh sách sản phẩm

                    </a>
                </li>
                <li>
                    <a class="" href="{{route('adminAddProduct')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Thêm sản phẩm mới
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Phụ kiện
                    </a>
                </li>
            </ul>
        </li>

        <li id="Bills" class="parent">
            <a href="{{route('bills')}}">
                <span  href="#sub-item-2"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg></span> Đơn Hàng
            </a>
        </li>
        <li id="Charts" class="parent">
            <a href="{{route('charts')}}">
                <span  href="#sub-item-2"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg></span> Thống Kê
            </a>
        </li>
        <li id="Account" class="parent">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Tài Khoản
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="" href="{{route('adminAccount')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Admin
                    </a>
                </li>
                <li>
                    <a class="" href="{{route('userAccount')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> User
                    </a>
                </li>
            </ul>
        </li>
        <li id="Widgets"><a href="{{route('widgets')}}"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
        <li><a href="{{route('chart')}}"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
        <li><a href="{{route('tables')}}"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
        <li><a href="{{route('forms')}}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
        <li><a href="{{route('panels')}}"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
        <li><a href="{{route('icons')}}"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
        <li class="parent ">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1

                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
                    </a>
                </li>
            </ul>
        </li>
        <li role="presentation" class="divider"></li>
        <li><a href="{{route('login-admin')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
    </ul>
    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
</div><!--/.sidebar-->