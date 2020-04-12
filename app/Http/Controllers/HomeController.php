<?php

namespace SIC\Http\Controllers;

use Auth;
use SIC\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function getHome()
	{
		return view('home');
	}
}