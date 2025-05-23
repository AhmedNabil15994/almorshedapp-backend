<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{__('dashboard.doctors.create.general')}}</h3>
    <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.doctors.create.name')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.name')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.email')}}
            </label>
            <div class="col-md-9">
                <input type="email" name="email" placeholder="email@exmaple.com" class="form-control" data-name="email">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.mobile')}}
            </label>
            <div class="col-md-9">
                <input type="number" name="mobile" placeholder="55060671" class="form-control" data-name="mobile">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.password')}}
            </label>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control" data-name="password">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.confirm_password')}}
            </label>
            <div class="col-md-9">
                <input type="password" name="password_confirmation" class="form-control" data-name="password_confirmation">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.roles')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    @foreach ($roles as $role)
                    <label class="mt-checkbox">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}">
                        {{$role->display_name}}
                        <span></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.categories')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    @foreach ($categories as $category)
                    <label class="mt-checkbox">
                        <input type="checkbox" name="categories[]" value="{{$category->id}}">
                        {{$category->title}}
                        <span></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <h3 class="page-title">{{__('dashboard.doctors.create.academic_degree')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.academic_degree')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="academic_degree[{{$code}}]" class="form-control" data-name="academic_degree.{{$code}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <h3 class="page-title">{{__('dashboard.doctors.create.current_workplaces')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.current_workplaces')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <textarea name="current_workplaces[{{$code}}]" rows="8" cols="80" class="form-control {{check_dir($code)}}Editor" data-name="current_workplaces.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <h3 class="page-title">{{__('dashboard.doctors.create.previous_experience')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.previous_experience')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <textarea name="previous_experience[{{$code}}]" rows="8" cols="80" class="form-control {{check_dir($code)}}Editor" data-name="previous_experience.{{$code}}"></textarea>
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <h3 class="page-title">{{__('dashboard.doctors.create.specialization')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.specialization')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="specialization[{{$code}}]" class="form-control" data-name="specialization.{{$code}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.language')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    @foreach ($languages as $language)
                    <label class="mt-checkbox">
                        <input type="checkbox" name="languages[]" value="{{ $language->id }}">
                        {{ $language->name }}
                        <span></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.image')}}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i>
                        </a>
                    </span>
                </div>
                <span id="holder" style="margin-top:15px;max-height:100px;"></span>
                <span id="image"></span>
                <input type="hidden" data-name="image">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>