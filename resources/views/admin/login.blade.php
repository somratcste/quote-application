@extends('layouts.master')
@section('content')
<form method="post" action="{{ route('create') }}">
	<div class="input-group">
		<label for="name">Your Name : </label>
		<input type="text" name="name" id="name" placeholder="Your name">
	</div>
	<div class="input-group">
		<label for="password">Your E-Mail : </label>
		<input type="password" name="password" id="password" placeholder="Your E-Mail">
	</div>
	
	<button type="submit" class="btn btn-primary">Submti Quote</button>
	<input type="hidden" name="_token" value="{{Session::token()}}">
</form>
@endsection