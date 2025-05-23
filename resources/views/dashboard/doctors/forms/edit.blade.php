<div class="tab-pane fade active in" id="global_setting">
    <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.doctors.create.general')}}</h3>
        <h3 class="page-title">{{__('dashboard.doctors.create.name')}}</h3>
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.name')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}" value="{{@$doctor->user->translate($code)->name ? @$doctor->user->translate($code)->name : $doctor->user->name }}">
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
                <input type="email" name="email" placeholder="email@exmaple.com" class="form-control" data-name="email" value="{{$doctor->user->email}}">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.mobile')}}
            </label>
            <div class="col-md-9">
                <input type="number" name="mobile" placeholder="55060671" class="form-control" data-name="mobile" value="{{$doctor->user->mobile}}">
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{ ($doctor->user->status == 1) ? ' checked="" ' : '' }}>

                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                ارسال بريد بالتفعيل
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="send_email">

                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.password')}}
            </label>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control" data-name="password" value="" autocomplete="new-password">
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
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ $doctor->user->roles->contains($role->id) ? 'checked=""' : ''}}>
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
                        <input type="checkbox" name="categories[]" value="{{$category->id}}" {{ $doctor->categories->contains($category->id) ? 'checked=""' : ''}}>
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
                <input type="text" name="academic_degree[{{$code}}]" class="form-control" data-name="academic_degree.{{$code}}" value="{{@$doctor->translate($code)->academic_degree ? @$doctor->translate($code)->academic_degree : $doctor->academic_degree}}">
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
                <textarea name="current_workplaces[{{$code}}]" rows="8" cols="80" class="form-control {{check_dir($code)}}Editor" data-name="current_workplaces.{{$code}}">{{@$doctor->translate($code)->current_workplaces ? @$doctor->translate($code)->current_workplaces : $doctor->current_workplaces}}</textarea>
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
                <textarea name="previous_experience[{{$code}}]" rows="8" cols="80" class="form-control {{check_dir($code)}}Editor" data-name="previous_experience.{{$code}}">{{@$doctor->translate($code)->previous_experience ? @$doctor->translate($code)->previous_experience : $doctor->previous_experience}}</textarea>
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
                <input type="text" name="specialization[{{$code}}]" class="form-control" data-name="specialization.{{$code}}" value="{{@$doctor->translate($code)->specialization ? @$doctor->translate($code)->specialization : $doctor->specialization }}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.account_name')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="account_name" placeholder="{{__('dashboard.doctors.create.account_name')}}" class="form-control" data-name="account_name" value="{{ $doctor->account_name }}" autocomplete="new-email">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                IBAN
            </label>
            <div class="col-md-9">
                <input type="text" name="iban" placeholder="IBAN" class="form-control" data-name="iban" value="{{ $doctor->iban }}">
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.doctors.create.language')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    @foreach ($languages as $language)
                    <label class="mt-checkbox">
                        <input type="checkbox" name="languages[]" value="{{ $language->id}} " {{ $doctor->languages->contains($language->id) ? 'checked=""' : '' }}>
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
                <span id="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{url($doctor->user->avatar)}}" style="height: 15rem;">
                </span>
                <span id="image"></span>
                <input type="hidden" data-name="image">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
