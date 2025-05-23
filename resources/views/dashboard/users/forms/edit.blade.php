<div class="tab-pane fade active in" id="global_setting">
    <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.users.create.general')}}</h3>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.name')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="name" class="form-control" data-name="name" value="{{$user->name}}">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.email')}}
            </label>
            <div class="col-md-9">
                <input type="email" name="email" placeholder="email@exmaple.com" class="form-control" data-name="email" value="{{$user->email}}">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.mobile')}}
            </label>
            <div class="col-md-9">
                <input type="number" name="mobile" placeholder="55060671" class="form-control" data-name="mobile" value="{{$user->mobile}}">
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{ ($user->status == 1) ? ' checked="" ' : '' }}>

                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.password')}}
            </label>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control" data-name="password">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.confirm_password')}}
            </label>
            <div class="col-md-9">
                <input type="password" name="password_confirmation" class="form-control" data-name="password_confirmation">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.roles')}}
            </label>
            <div class="col-md-9">
                <div class="mt-checkbox-list">
                    @foreach ($roles as $role)
                    <label class="mt-checkbox">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ $user->roles->contains($role->id) ? 'checked=""' : ''}}>
                        {{$role->display_name}}
                        <span></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.users.create.image')}}
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
                    <img src="{{url($user->avatar)}}" style="height: 15rem;">
                </span>
                <span id="image"></span>
                <input type="hidden" data-name="image">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
