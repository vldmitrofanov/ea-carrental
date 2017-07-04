<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="{{ url('') }}"><img src="{{asset('template/images/logo.png')}}" alt=""></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('fleet') ? 'active' : '' }}"><a href="{{ url('fleet') }}">Our Fleet</a></li>
            <li><a href="javascript:;">Chafeur Driven</a></li>
            <li class="{{ Request::is('rental-offers') ? 'active' : '' }}"><a href="{{ url('rental-offers') }}">Rental Offers</a></li>
            <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ url('contact-us') }}">Contact us</a></li>
        </ul>
        <ul class="userSection navbar-right">
            <li class="loginButton">
                @if (Auth::check())
                    <i class="fa fa-user"></i> Welcome <a href="{{ url('dashboard')  }}">{{ Auth::user()->username }}</a> | <a href="{{ url('logout') }}">Logout</a>
                @else
                <i class="fa fa-user"></i> <a href="{{ url('login') }}">Login</a>
                @endif
                <a href="javascript:;">EN</a> <a href="javascript:;">USD</a> </li>
            <li class="phoneNumber">Call us <i class="fa fa-phone"></i> +60123208132</li>
        </ul>
    </div>
</nav>