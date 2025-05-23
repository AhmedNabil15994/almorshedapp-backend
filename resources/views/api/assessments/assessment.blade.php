@extends('api.layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mt-4 mb-4">{{ $assessment->translate(app()->getLocale())->name }}</h3>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" action="{{ route('user-assessments') }}">
					@csrf
					<input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
					@foreach($assessment->questions as $question)
						<h5 class="mt-3">{{ $question->translate(app()->getLocale())->question }}</h5>
						@foreach($question->answers as $answer)
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="answer_{{ $question->id }}" id="answer_{{ $answer->id }}" value="{{ $answer->value }}" required>
							  <label class="form-check-label" for="answer_{{ $answer->id }}">
							    {{ $answer->translate(app()->getLocale())->answer }}
							  </label>
							</div>

						@endforeach
					@endforeach

					<button type="submit" class="btn btn-info mt-3">{{ __('api.assessments.send') }}</button>
				</form>
			</div>
		</div>
	</div>

@stop