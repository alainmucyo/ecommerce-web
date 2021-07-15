<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu pb-4">
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="/home">
                        <span class="pcoded-micon">
                        <i class="feather icon-watch"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/home-sections">
                        <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Home Sections</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Orders Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu">
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                        <span class="pcoded-mtext">Orders</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li>
                            <a class="waves-effect waves-dark" href="/seller/orders">
                                <span class="pcoded-mtext">New Orders</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/admin/orders">
                                <span class="pcoded-mtext">All Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="pcoded-item pcoded-left-item">
                <li class=" ">
                    <a class="waves-effect waves-dark" href="/chatbox/seller">
                        <span class="pcoded-micon">
                        <i class="feather icon-message-square"></i>
                        </span>
                        <span class="pcoded-mtext">Chat box</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Products Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="/admin/products">
                        <span class="pcoded-micon">
                        <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">List Products</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/product/create">
                        <span class="pcoded-micon">
                        <i class="feather icon-package"></i>
                        </span>
                        <span class="pcoded-mtext">Create Products</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/categories">
                        <span class="pcoded-micon">
                        <i class="feather icon-package"></i>
                        </span>
                        <span class="pcoded-mtext">Categories</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="/admin/deliver-fees">
                        <span class="pcoded-micon">
                        <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="pcoded-mtext">Delivery Fees</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu">
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                        <span class="pcoded-mtext">Ads products</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li>
                            <a class="waves-effect waves-dark" href="{{  route("ad-product.create") }}">
                                <span class="pcoded-mtext">Create new</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="{{  route("ad-product.index") }}">
                                <span class="pcoded-mtext">List All</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Users</div>
            <ul class="pcoded-item pcoded-left-item">

{{--                <li class="pcoded-hasmenu">--}}
{{--                    <a class="waves-effect waves-dark" href="javascript:void(0)">--}}
{{--                        <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>--}}
{{--                        <span class="pcoded-mtext">Sellers</span>--}}
{{--                    </a>--}}
{{--                    <ul class="pcoded-submenu">--}}
{{--                        <li>--}}
{{--                            <a class="waves-effect waves-dark" href="/users/sellers">--}}
{{--                                <span class="pcoded-mtext">Sellers Request</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="waves-effect waves-dark" href="/admin/sellers">--}}
{{--                                <span class="pcoded-mtext">Sellers List</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li>
                    <a class="waves-effect waves-dark" href="/admin/users">
                        <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                        </span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Reports</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu">
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-bar-chart"></i></span>
                        <span class="pcoded-mtext">Reports</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li>
                            <a class="waves-effect waves-dark" href="/reports/products">
                                <span class="pcoded-mtext">Product Reports</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="/reports/customers">
                                <span class="pcoded-mtext">Customer Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="pcoded-item pcoded-left-item">
                <li>
                    <a class="waves-effect waves-dark" href="/profile">
                        <span class="pcoded-micon">
                        <i class="feather icon-user"></i>
                        </span>
                        <span class="pcoded-mtext">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
