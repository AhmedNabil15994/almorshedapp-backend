<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{__('dashboard.roles.create.general')}}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.roles.create.key')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="name" placeholder="admins" class="form-control" data-name="name">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.roles.create.permissions')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    <ul>
                        @foreach ($permissions->groupBy('display_name') as $key => $perm)
                        <li style="list-style-type:none">
                            <label class="mt-checkbox">
                                <input type="checkbox" class="permission-group">
                                <strong>{{title_case(str_replace('_',' ', $key))}}</strong>
                                <span></span>
                            </label>
                            <ul style="list-style-type:none">
                                @foreach($perm as $permission)
                                <li style="list-style-type:none">
                                    <label class="mt-checkbox">
                                        <input class="child" type="checkbox" name="permission[]" value="{{$permission->id}}">
                                        {{$permission->description}}
                                        <span></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>

@foreach (config('setting.locales') as $code)
<div class="tab-pane fade" id="{{$code}}">
    <div class="col-md-10">
        <h3 class="page-title">{{ $code }}</h3>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.roles.create.name')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="display_name[{{$code}}]" class="form-control" data-name="display_name.{{$code}}">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.roles.create.description')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <textarea name="description[{{$code}}]" rows="8" cols="80" class="form-control" data-name="description.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
@endforeach
