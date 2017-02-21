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
        <?php /*<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>*/ ?>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li data-breadcrumb="{{ url('admin/dashboard') }}" class="treeview">
              <a href="{{ url('admin/dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>


            
        </ul>
    </section>
</aside>
