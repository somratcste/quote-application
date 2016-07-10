<?php

namespace App\Http\Controllers;
use App\Author;
use App\Quote;
use Illuminate\Http\Request;
use DB;

class QuoteController extends Controller 
{
	public function getIndex()
	{

	}

	public function postQuote(Request $request)
	{
		$this->validate($request , [
			'author' => 'required|max:60|alpha',
			'quote'	 => 'required|max:500'
		]);
		$authorText = ucfirst($request['author']);
		$quoteText 	= $request['quote'];

		$author = Author::where('name' , $authorText)->first();
		if(!$author)
		{
			$author = new Author();
			$author->name = $authorText;
			$author->save();
		}
		$quote = new Quote();
		$quote->quote = $quoteText;
		$author->quotes()->save($quote);

		return redirect()->route('home')->with([
			'success' => 'Quote Saved.'
		]);
	}

	public function getDeleteQuote($quote_id)
	{
		$quote = Quote::find($quote_id);
		$author_id = $quote->author_id;
		$total_quote = DB::table('quotes')->where('author_id' , $author_id)->count();
		$author_deleted = false;
		
		if($total_quote === 1)
		{
			$auth_deleted = DB::table('authors')->where('id' , $author_id)->delete();
			$author_deleted = true;
		}
		$quote->delete();
		$msg = $author_deleted ? 'Quote And Author Deleted !' : 'Quote Deleted !' ;
		return redirect()->route('home')->with([
			'success' => $msg 
		]);
	}
	
}