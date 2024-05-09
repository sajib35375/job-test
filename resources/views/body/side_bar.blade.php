<aside id="sidebar" class="js-custom-scroll side-nav">
    <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
        <!-- Title -->
        <li class="sidebar-heading h6">Dashboard</li>
        <!-- End Title -->

        <!-- Dashboard -->
        <li class="side-nav-menu-item active">
            <a class="side-nav-menu-link media align-items-center" href="{{ route('dashboard') }}">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-dashboard"></i>
              </span>
                <span class="side-nav-fadeout-on-closed media-body">Add New Product</span>
            </a>
        </li>
        <!-- End Dashboard -->

        <!-- Documentation -->
        <li class="side-nav-menu-item">
            <a class="side-nav-menu-link media align-items-center" href="{{ route('all.product') }}">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-file"></i>
              </span>
                <span class="side-nav-fadeout-on-closed media-body">All Products</span>
            </a>
        </li>
        <!-- End Documentation -->

        <!-- Title -->


    </ul>
</aside>
