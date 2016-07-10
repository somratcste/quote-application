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
			$quotes = DB::table('authors')
					->join('quotes' , 'quotes.author_id' , '=' , 'authors.id')
					->where('authors.name' , $author)
					->paginate(6);
	
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


