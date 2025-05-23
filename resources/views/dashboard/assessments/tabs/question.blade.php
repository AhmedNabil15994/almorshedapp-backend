<div class="tab-pane fade" id="question{{ $question->id }}">
  <div class="col-md-12">
      <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.questions.create.question')}}</h3>
        <input type="hidden" name="question_id[]" value="{{ $question->id }}">
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.questions.create.question')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="question[{{$code}}][]" class="form-control" data-name="question.{{$code}}" value="{{$question->translate($code)->question}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <div class="form-group">
            <label class="col-md-2"></label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="question_status_{{ $question->id }}" {{($question->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
        </div>
      <div class="clearfix"></div>
      @foreach($question->answers as $answer)
      <hr>
      <input type="hidden" name="answer_id[]" value="{{ $answer->id }}">
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.answers.create.answer')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="answer[{{$code}}][]" class="form-control" data-name="answer.{{$code}}" value="{{$answer->translate($code)->answer}}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.answers.create.value')}}
          </label>
          <div class="col-md-9">
              <input type="number" class="form-control" name="answer_value_{{ $answer->id }}" data-name="value" value="{{ $answer->value }}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>