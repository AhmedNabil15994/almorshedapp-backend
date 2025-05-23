<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{__('dashboard.pages.create.general')}}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.permissions.create.name')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="name" placeholder="add_user" class="form-control" data-name="name">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.permissions.create.key')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="display_name" placeholder="users" class="form-control" data-name="display_name">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>

@foreach (config('setting.locales') as $code)
<div class="tab-pane fade" id="{{$code}}">
    <h3 class="page-title">{{$code}}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.permissions.create.description')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <textarea name="description[{{$code}}]" rows="8" cols="80" class="form-control" data-name="description.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
@endforeach
