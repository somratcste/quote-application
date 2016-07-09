@extends('layouts.master')

@section('title')
	Trending Quotes
@endsection
@section('content')	
	@if(!empty(Request::Segment(1)))
		<section class="filter-bar">
			A filter has been set ! <a href="{{ route('home') }}">Show All Quotes</a>
		</section>
	@endif
	@if(count($errors) > 0)
		<div>
			<ul class="alert alert-danger">
				@foreach ($errors->all() as $error)
					{{$error}}
				@endforeach
			</ul>
		</div>
	@endif

	@if(Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif
	
	<section class="quotes">
		<h1>Latest Quotes</h1>
		@for($i=0; $i < count($quotes); $i++)
			<article class="quote{{ $i % 3 === 0 ? ' first-in-line' : (($i+1) % 3 === 0 ? ' last-in-line' : '')}}">
				<div class="delete"><a href="{{ route('delete' , ['quote_id' => $quotes[$i]->id ]) }}">X</a></div>
				{{$quotes[$i]->quote}}
				<div class="info">Created by <a href="{{ route('home', ['author' => $quotes[$i]->name] ) }}">{{ $quotes[$i]->name }}</a> On {{$quotes[$i]->created_at}}</div>
			</article>
		@endfor
		<div class="pagination1">
			@if($quotes->currentPage() !== 1)
				<a href="{{ $quotes->previousPageUrl() }}"><span class="fa fa-caret-left"><</span></a>
			@endif
			@if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
				<a href="{{ $quotes->nextPageUrl() }}"><span class="fa fa-caret-right">></span></a>
			@endif
		</div>
	</section>

	<section class="edit-quote">
		<h1>Add a Quote</h1>
		<form method="post" action="{{ route('create') }}">
			<div class="input-group">
				<label for="author">Your Name : </label>
				<input type="text" name="author" id="author" placeholder="Your name">
			</div>
			<div class="input-group">
				<label for="quote">Your Quote : </label>
				<textarea rows="5" type="text" name="quote" id="quote" placeholder="Your quote"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Submti Quote</button>
			<input type="hidden" name="_token" value="{{Session::token()}}">
		</form>
	</section>

@endsection