<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
      <h3 class="page-title">{{__('dashboard.questions.create.question')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.questions.create.question')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <textarea name="question[{{$code}}]" class="form-control" data-name="question.{{$code}}" rows="5">{{$question->translate($code)->question}}</textarea>
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.questions.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($question->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
