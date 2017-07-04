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
            <li class="{{ (\Request::is('admin/dashboard')|| \Request::is('admin/dashboard/*')) ? 'active' : '' }}" class="treeview">
              <a href="{{ url('admin/dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ \Request::is('admin/settings') ? 'active' : '' }}"><a href="{{ url('admin/settings') }}"><i class="fa fa-cog"></i><span>Settings</span></a></li>
                    <li class="{{ (\Request::is('admin/notifications')|| \Request::is('admin/notifications/*')) ? 'active' : '' }}"><a href="{{ url('admin/notifications') }}"><i class="fa fa-envelope"></i> Email Notifications</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Office Locations</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ((\Request::is('admin/locations') || \Request::is('admin/locations/*')) && !\Request::is('admin/locations/create')) ? 'active' : '' }}"><a href="{{ url('admin/locations') }}"><i class="fa fa-list"></i> List</a></li>
                    <li class="{{ \Request::is('admin/locations/create') ? 'active' : '' }}"><a href="{{ url('admin/locations/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Discount</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (\Request::is('admin/discounts/vouchers')|| \Request::is('admin/discounts/vouchers/*')) ? 'active' : '' }}"><a href="{{ url('admin/discounts/vouchers') }}"><i class="fa fa-percent"></i> Vouchers</a></li>
                    <li class="{{ (\Request::is('admin/discounts/volume')|| \Request::is('admin/discounts/volume/*')) ? 'active' : '' }}"><a href="{{ url('admin/discounts/volume') }}"><i class="fa fa-percent"></i> Volume Discount</a></li>
                    <li class="{{ (\Request::is('admin/discounts/freebies')|| \Request::is('admin/discounts/freebies/*')) ? 'active' : '' }}"><a href="{{ url('admin/discounts/freebies') }}"><i class="fa fa-car"></i> Freebies</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-car"></i> <span>Fleet Management</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (\Request::is('admin/fleet/types')|| \Request::is('admin/fleet/types/*')) ? 'active' : '' }}"><a href="{{ url('admin/fleet/types') }}"><i class="fa fa-cog"></i> Types</a></li>
                    <li class="{{ (\Request::is('admin/fleet/models')|| \Request::is('admin/fleet/models/*')) ? 'active' : '' }}"><a href="{{ url('admin/fleet/models') }}"><i class="fa fa-cog"></i> Model & Make</a></li>
                    <li class="{{ (\Request::is('admin/fleet/cars')|| \Request::is('admin/fleet/cars/*')) ? 'active' : '' }}"><a href="{{ url('admin/fleet/cars') }}"><i class="fa fa-car"></i> Car Inventory</a></li>
                </ul>
            </li>

            <li class="{{ (\Request::is('admin/extras')|| \Request::is('admin/extras/*')) ? 'active' : '' }}" class="treeview">
                <a href="{{ url('admin/extras') }}">
                    <i class="fa fa-book"></i>
                    <span>Extras</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Reservations</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ((\Request::is('admin/reservations')|| \Request::is('admin/reservations/*')) && !\Request::is('admin/reservations/create')) ? 'active' : '' }}"><a href="{{ url('admin/reservations') }}"><i class="fa fa-list"></i> List</a></li>
                    <li class="{{ (\Request::is('admin/reservations/create')) ? 'active' : '' }}"><a href="{{ url('admin/reservations/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
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
                    <li class="{{ ((\Request::is('admin/users')|| \Request::is('admin/users/*')) && !\Request::is('admin/users/create')) ? 'active' : '' }}"><a href="{{ url('admin/users') }}"><i class="fa fa-list"></i> List</a></li>
                    <li class="{{ (\Request::is('admin/users/create')) ? 'active' : '' }}"><a href="{{ url('admin/users/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
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
                    <li class="{{ ((\Request::is('admin/clients')|| \Request::is('admin/clients/*')) && !\Request::is('admin/clients/create')) ? 'active' : '' }}"><a href="{{ url('admin/clients') }}"><i class="fa fa-list"></i> List</a></li>
                    <li class="{{ (\Request::is('admin/clients/create')) ? 'active' : '' }}"><a href="{{ url('admin/clients/create') }}"><i class="fa fa-plus-square"></i> Add New</a></li>
                </ul>
            </li>

            <li class="{{ (\Request::is('admin/fleetavailability')|| \Request::is('admin/fleetavailability/*')) ? 'active' : '' }}" class="treeview">
                <a href="{{ url('admin/fleetavailability') }}">
                    <i class="fa fa-automobile"></i>
                    <span>Fleet Availability</span>
                </a>
            </li>


            
        </ul>
    </section>
</aside>
