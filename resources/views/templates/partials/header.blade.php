<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('home') }}" title="Student Information Center">SIC</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          @if (Auth::guard('client')->check())
            <li class="{{{ (Request::route()->getName() == 'client.dashboard') ? 'active' : '' }}}"><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
          @elseif (Auth::guard('admin')->check())
            <li class="{{{ (Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="{{{ (Request::route()->getName() == 'admin.manageAdmin') ? 'active' : '' }}}"><a href="{{ route('admin.manageAdmin') }}">Manage Administrators</a></li>
            <li class="{{{ (Request::route()->getName() == 'admin.manageClient') ? 'active' : '' }}}"><a href="{{ route('admin.manageClient') }}">Manage Clients</a></li>
          @elseif (Auth::guard('student')->check())
          @else
            @include('templates.partials.notLoggedIn')
          @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guard('client')->check())
              <li class="{{{ (Request::route()->getName() == 'client.logout') ? 'active' : '' }}}"><a href="{{ route('client.logout') }}">Log Out</a></li>
            @elseif (Auth::guard('admin')->check())
              <li class="{{{ (Request::route()->getName() == 'admin.profile') ? 'active' : '' }}}"><a href="{{ route('admin.profile') }}">{{ Auth::guard('admin')->user()->getNameOrUsername() }}</a></li>
              <li class="{{{ (Request::route()->getName() == 'admin.logout') ? 'active' : '' }}}"><a href="{{ route('admin.logout') }}">Log Out</a></li>
            @elseif (Auth::guard('student')->check())
              <li class="{{{ (Request::route()->getName() == 'student.logout') ? 'active' : '' }}}"><a href="{{ route('student.logout') }}">Log Out</a></li>
            @else
             
            @endif
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>