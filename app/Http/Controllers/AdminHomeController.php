<?php

namespace SIC\Http\Controllers;

use Auth;
use SIC\Models\Client;
use SIC\Models\Admin;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{

	public function showDashboard()
	{
		return view('admin.dashboard');
	}

	public function addAdmin()
	{
		return view('admin.addAdmin');
	}

	public function showProfile()
	{
		$admin = Auth::guard('admin')->user();
		return view('admin.profile')->with('admin', $admin);
	}

	public function manageAdmin()
	{
		$admins = Admin::all();

		return view('admin.manageAdmin')->with('admins', $admins);
	}

	public function manageClient()
	{
		$clients = Client::all();

		return view('admin.manageClient')->with('clients', $clients);
	}
}