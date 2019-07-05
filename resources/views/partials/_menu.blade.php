<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <img src="{{ url('img/logo.png') }}" alt="Ecobes" class="img-responsive">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse custom-navbar-n topbar" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
        <li class="username-n profile-name"><a href="{{ url('/profile') }}/{{Auth::user()->slug}}">{{Auth::user()->name}}</a> </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="40px" height="40px" class="img-circle initials"/>
                <span class="caret "></span>
            </a>
          <ul class="dropdown-menu menu-drop" role="menu">
                  <li> <a href="{{ url('editProfile') }}" >  Edit Profile  </a> </li>
                  <li>
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
        </li>
        @endif
        @if (Auth::guest())
          <li class="btn btn-green effect-nm"><a href="{{ route('login') }}">Login</a></li>
          <li class="btn btn-green effect-nm"><a href="{{ route('register') }}">Register</a></li>
        @endif


      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
