@extends('templates.template')

@section('title', 'Admin Log In - ')

@section('content')
<div class="container">
<form class="form-signin" method="POST" action="{{ route('admin.login') }}">
        <h2 class="form-signin-heading">Administrator Login</h2>

        <div class="form-group col-lg-12">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
          </div>

          <div class="form-group col-lg-12">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="form-group col-lg-12 checkbox">
          <label>
            <input type="checkbox" name="remember"> Remember me
          </label>
        </div>
        
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>
      </div>
@endsection

@section('styles')
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
@endsection