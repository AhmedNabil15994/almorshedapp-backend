@extends('front._layouts.master')
@section('title', __('front.home.title') )
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if (session('status'))
		    <div class="alert alert-success" role="alert">
		        {{ session('status') }}
		    </div>
			@endif
		</div>
	</div>
</div>

@stop
