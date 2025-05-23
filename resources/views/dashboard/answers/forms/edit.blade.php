<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
      <h3 class="page-title">{{__('dashboard.answers.create.answer')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.answers.create.answer')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <textarea name="answer[{{$code}}]" class="form-control" data-name="answer.{{$code}}" rows="5">{{$answer->translate($code)->answer}}</textarea>
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.answers.create.value')}}
          </label>
          <div class="col-md-9">
              <input type="number" class="form-control" name="value" data-name="value" value="{{ $answer->value }}">
              <div class="help-block"></div>
          </div>
      </div>
      <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.answers.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($answer->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
