<?php

namespace SIC\Http\Controllers;

class TabsController extends Controller
{
	public function about()
	{
		return view('tabs.about');
	}
}