<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('images/no-user.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li data-breadcrumb="{{ url('admin/dashboard') }}" class="treeview">
              <a href="{{ url('admin/dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <li data-breadcrumb="{{ url('admin/settings') }}" class="treeview">
              <a href="{{ url('admin/settings') }}">
                <i class="fa fa-cogs"></i>
                <span>Settings</span>
              </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Office Locations</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/locations') }}"><i class="fa fa-list"></i> List</a></li>
                    <li><a href="{{ url('admin/locations/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Discount</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/discounts/vouchers') }}"><i class="fa fa-percent"></i> Vouchers</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Types and Rates</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/types') }}"><i class="fa fa-book"></i> Types</a></li>
                    <li><a href="{{ url('admin/extras') }}"><i class="fa fa-book"></i> Extras</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-car"></i> <span>Car Inventory</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/cars') }}"><i class="fa fa-list"></i> List</a></li>
                    <li><a href="{{ url('admin/cars/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Reservations</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/reservations') }}"><i class="fa fa-list"></i> List</a></li>
                    <li><a href="{{ url('admin/reservations/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/users') }}"><i class="fa fa-list"></i> List</a></li>
                    <li><a href="{{ url('admin/users/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Clients Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/clients') }}"><i class="fa fa-list"></i> List</a></li>
                    <li><a href="{{ url('admin/clients/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>


            
        </ul>
    </section>
</aside>
