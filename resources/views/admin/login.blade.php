@extends('layouts.master')
@section('content')
@if(count($errors) > 0)
	<div>
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{$error}}
			@endforeach
		</ul>
	</div>
@endif
@if(session('fail'))
	<div class="alert alert-danger">
		{{session('fail')}}
	</div>
@endif
<form method="post" action="{{ route('admin.login') }}">
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