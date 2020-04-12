<li class="{{{ (Request::route()->getName() == 'client.login') ? 'active' : '' }}}"><a href="{{ route('client.login') }}">Client Log In</a></li>
<li class="{{{ (Request::route()->getName() == 'admin.login') ? 'active' : '' }}}"><a href="{{ route('admin.login') }}">Admin Log In</a></li>
<li class="{{{ (Request::route()->getName() == 'student.login') ? 'active' : '' }}}"><a href="{{ route('student.login') }}">Student Log In</a></li>
<li class="{{{ (Request::route()->getName() == 'tabs.about') ? 'active' : '' }}}"><a href="{{ route('tabs.about') }}">About</a></li>