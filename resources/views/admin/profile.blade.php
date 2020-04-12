@extends('templates.template')

@section('title', 'Admin\'s Profile - ')

@section('content')
<div class="container">
	<div class="row">
		<h1>{{ Auth::guard('admin')->user()->getFirstNameOrUsername() }}'s Profile</h1>
		<p><b>Account ID: </b>{{ $admin->id }}</p>
		<p><b>Username: </b>{{ $admin->username }}</p>
		<p><b>Full Name: </b>{{ $admin->first_name }} {{ $admin->last_name }}</p>
		<p><b>E-mail: </b>{{ $admin->email }}</p>
		<p><b>Created At: </b>{{ $admin->created_at->diffForHumans() }}</p>
		<p><b>Updated At: </b>{{ $admin->updated_at->diffForHumans() }}</p>
	</div>
</div>
@endsection

@section('styles')

@endsection