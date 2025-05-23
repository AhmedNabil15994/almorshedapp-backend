<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
      <h3 class="page-title">{{__('dashboard.ads.create.name')}}</h3>
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.ads.create.name')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}" value="{{$ad->translate($code)->name}}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <hr>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.ads.create.link')}}
          </label>
          <div class="col-md-9">
              <input type="url" name="link" class="form-control" data-name="link" value="{{$ad->link}}">
              <div class="help-block"></div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.ads.create.start_date')}}
          </label>
          <div class="col-md-9">
              <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                <input type="text" name="start_date" class="form-control" value="{{ date('Y-m-d', strtotime($ad->start_date)) }}" readonly>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
              <div class="help-block"></div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.ads.create.end_date')}}
          </label>
          <div class="col-md-9">
              <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                <input type="text" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime($ad->end_date)) }}" readonly>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
              <div class="help-block"></div>
          </div>
      </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.ads.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($ad->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
            <input type="hidden" name="category_id" id="root_category" value="">
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.ads.create.image')}}
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
                    <img src="{{url($ad->image)}}" style="height: 15rem;">
                </span>
                <span id="image"></span>
            </div>
        </div>
    </div>
</div>
