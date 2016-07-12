<?php

namespace App\Http\Controllers;
use App\Author;
use App\Quote;
use Illuminate\Http\Request;
use DB;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller 
{
	public function getIndex()
	{

	}

	public function postQuote(Request $request)
	{
		$this->validate($request , [
			'author' => 'required|max:60|alpha',
			'quote'	 => 'required|max:500',
			'email'	 => 'required|email'
		]);
		$authorText = ucfirst($request['author']);
		$quoteText 	= $request['quote'];

		$author = Author::where('name' , $authorText)->first();
		if(!$author)
		{
			$author = new Author();
			$author->name = $authorText;
			$author->email = $request['email'];
			$author->save();
		}
		$quote = new Quote();
		$quote->quote = $quoteText;
		$author->quotes()->save($quote);

		Event::fire(new QuoteCreated($author->name));

		return redirect()->route('home')->with([
			'success' => 'Quote Saved.'
		]);
	}

	public function getDeleteQuote($quote_id)
	{
		$quote = Quote::find($quote_id);
		$author_deleted = false;

		if(count($quote->author->quotes) ===1)
		{
			$quote->author->delete();
			$author_deleted = true;
		}
		$quote->delete();
		$msg = $author_deleted ? 'Quote And Author Deleted !' : 'Quote Deleted !' ;
		return redirect()->route('home')->with([
			'success' => $msg 
		]);
	}
	
}