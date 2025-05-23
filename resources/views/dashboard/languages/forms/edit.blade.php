<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
      <h3 class="page-title">{{__('dashboard.languages.create.name')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.languages.create.name')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}" value="{{$language->translate($code)->name}}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.languages.create.language')}}
          </label>
          <div class="col-md-9">
              <input type="text" name="language" class="form-control" data-name="language" value="{{$language->language}}">
              <div class="help-block"></div>
          </div>
      </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.languages.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($language->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
