<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>


                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Menu</li>


                <li>
                    <a href="#categories" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Categories </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="categories">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('list.categories') }}">Category List</a>
                            </li>
                            <li>
                                <a href="{{ route('create.category') }}">Add Category</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#products" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="products">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('create.product') }}">Add Product</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#users" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('list.users') }}">List Users</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#banners" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Banners </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="banners">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('create.banner') }}">Add Banner</a>
                            </li>
                        </ul>
                    </div>
                </li>

















            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
