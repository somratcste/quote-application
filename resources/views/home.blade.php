@extends('layouts.master')

@section('title')
	Trending Quotes
@endsection
@section('content')	
	{{-- @if(count($errors) > 0)
		<div>
			<ul class="alert alert-danger">
				@foreach ($errors->all() as $error)
					{{$error}}
				@endforeach
			</ul>
		</div>
	@endif --}}
	
	<section class="quotes">
		<h1>Latest Quotes</h1>
		<article class="quote">
			<div class="delete"><a href="#">X</a></div>
			Quote Text
			<div class="info">Created by <a href="#">Somrat </a>On ...</div>
		</article>
		Pagination
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
			<button type="button" class="btn btn-primary">Submti Quote</button>
			<input type="hidden" name="_token" value="{{Session::token()}}">
		</form>
	</section>

@endsection