@extends('others.twostep.template')

@section('title', 'Two Factor Authentication - ')

@section('content')
<div class="container">
<form class="form-signin" method="POST" action="{{ route('admin.verify') }}">
        <h2 class="form-signin-heading">Security Code</h2>
          <div class="form-group col-lg-12">
        <input type="password" name="code" id="password" class="form-control" placeholder="Password" required autofocus>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="secret" value="{{ $secret }}">
        <input type="hidden" name="remember" value="{{ $remember }}">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
        <a href="" data-toggle="modal" data-target="#qrcode">Need Help?</a></a>
      </form>
      </div>
      @include('others.modals.twostep.qr')
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
