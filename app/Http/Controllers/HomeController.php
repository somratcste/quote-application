<?php

namespace App\Http\Controllers;
use App\Quote;
use App\Author;
use DB;

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
			$quotes = DB::table('quotes')
					->join('authors' , 'quotes.author_id' , '=' , 'authors.id')
					->select('quotes.*' , 'authors.name')
					->orderBy('created_at' , 'desc')
		            ->paginate(6);
		}	
			

		return view('home', ['quotes' => $quotes]);
	}
	
}