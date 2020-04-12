<?php

namespace SIC\Http\Controllers;

use Auth;
use Models\Student;

class StudentHomeController extends Controller
{
	public function showDashboard()
	{
		return view('student.dashboard');
	}
}