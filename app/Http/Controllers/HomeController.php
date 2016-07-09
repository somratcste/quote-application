<?php

namespace App\Http\Controllers;
use App\Quote;
use App\Author;

class HomeController extends Controller 
{
	public function getHome($author = null)
	{
		if(!is_null($author))
		{
			$quote_author = Author::where('name' , $author)->first();
			if($quote_author)
			{
				$quotes = $quote_author->quotes()->orderBy('created_at' , 'desc')-paginate(6);
			}
		} else {
			$quotes = Quote::orderBy('created_at' , 'desc')->paginate(3);
		}		
		return view('home', ['quotes' => $quotes]);
	}
	
}