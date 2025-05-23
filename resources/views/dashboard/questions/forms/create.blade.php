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
                <textarea name="question[{{$code}}]" class="form-control" data-name="question.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <h3 class="page-title">{{__('dashboard.questions.create.answer')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.questions.create.answer')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <textarea name="answer[{{$code}}][]" class="form-control" data-name="answer.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.questions.create.value')}}
            </label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="value[]" data-name="value[]">
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group answer-container">
            <label class="control-label col-md-3">
                <button type="button" class="btn btn-info add-answer"><i class="fa fa-plus"></i></button>
            </label>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.questions.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>


