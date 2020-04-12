@extends('templates.template')

@section('title', 'Login - ')

@section('content')
<div class="container">
<form class="form-addUser" method="POST" action="{{ route('client.login') }}">
        <h2 class="form-addUser-heading">Client Login</h2>

    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }} col-lg-12">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ Request::old('username') ?: '' }}" required autofocus>
          @if($errors->has('username'))
            <span class="help-block">{{ $errors->first('username') }}</span>
          @endif
        </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} col-lg-12">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          @if($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
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

.form-addUser {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-addUser .form-addUser-heading {
  margin-bottom: 10px;
}

.form-addUser .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-addUser .form-control:focus {
  z-index: 2;
}
.form-addUser input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-addUser input[type="password"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-addUser input[name="password_confirmation"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
@endsection