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

	<div class="row">

	</div>
@endsection