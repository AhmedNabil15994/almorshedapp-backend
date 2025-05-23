<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
      <h3 class="page-title">{{__('dashboard.services.create.name')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.services.create.name')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}" value="{{$service->translate($code)->name}}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
      <h3 class="page-title">{{__('dashboard.services.create.description')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.services.create.description')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <textarea name="description[{{$code}}]" class="form-control" data-name="description.{{$code}}" rows="5">{{$service->translate($code)->description}}</textarea>
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.services.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($service->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.services.create.image')}}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i>
                        </a>
                    </span>
                </div>
                <span id="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{ url($service->image) }}" style="height: 15rem;">
                </span>
                <span id="image"></span>
            </div>
        </div>
    </div>
</div>
