@extends('api.layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card mt-5">
			  <div class="card-body">
			    <h5 class="card-title">{{ __('api.assessments.assessment_result') }}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">{{ $result->translate(app()->getLocale())->rank }}</h6>
			    <p class="card-text">{{ $result->translate(app()->getLocale())->message }}</p>

			    <p class="text-muted">لا تمثل النتيجة السابقة أي تشخيص مرضي  يعتد به بشكل قانوني في الجهات الرسمية ويخلي البرنامج</p>
			  </div>
			</div>
		</div>
	</div>
@stop