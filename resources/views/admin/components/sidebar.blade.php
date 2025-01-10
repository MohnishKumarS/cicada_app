  <!-- Sidebar -->
  <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('admin//assets/img/cicada/cicada.webp') }}" alt="navbar brand" class="navbar-brand"
                            height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="dashboard">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../demo1/index.html">
                                            <span class="sub-item">Dashboard 1</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#brands_list">
                                <i class="fas fa-layer-group"></i>
                                <p>Brands</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="brands_list">
                                <ul class="nav nav-collapse" style="list-style: none">
                                    <li>
                                        <a href="{{ route('add-brand') }}">
                                            <span class="ms-5">Add Brands</span>
                                        </a>
                                    </li>                                 
                                    <li>
                                        <a href="{{ route('view-brand') }}">
                                            <span class="ms-5">View Brands</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#category_list">
                                <i class="fas fa-layer-group"></i>
                                <p>Category</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="category_list">
                                <ul class="nav nav-collapse" style="list-style: none">
                                    <li>
                                        <a href="{{ route('add-category') }}">
                                            <span class="ms-5">Add Category</span>
                                        </a>
                                    </li>                                 
                                    <li>
                                        <a href="{{ route('view-category') }}">
                                            <span class="ms-5">View Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#products_list">
                                <i class="fas fa-layer-group"></i>
                                <p>Products</p>
                                <span class="caret"></span>
                            </a>
                      
                            <div class="collapse" id="products_list">
                                <ul class="nav nav-collapse" style="list-style: none">
                                    <li>
                                        <a href="{{ route('add-product') }}">
                                            <span class="ms-5">Add Products</span>
                                        </a>
                                    </li>                                 
                                    <li>
                                        <a href="{{ route('view-products') }}">
                                            <span class="ms-5">View Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->