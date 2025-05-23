<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.orderStatuses.create.title')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.orderStatuses.create.title')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.orderStatuses.create.code')}}
          </label>
          <div class="col-md-9">
              <input type="text" name="code" class="form-control" data-name="code">
              <div class="help-block"></div>
          </div>
      </div>
    </div>
</div>
