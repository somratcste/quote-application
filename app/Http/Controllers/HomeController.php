<?php

namespace App\Http\Controllers;
use App\Quote;

class HomeController extends Controller 
{
	public function getHome()
	{
		$quotes = Quote::all();
		return view('home', ['quotes' => $quotes]);
	}
	
}