<?php

namespace SIC\Http\Controllers;

use Auth;
use Models\Client;

class ClientHomeController extends Controller
{
	public function showDashboard()
	{
		return view('client.dashboard');
	}
}