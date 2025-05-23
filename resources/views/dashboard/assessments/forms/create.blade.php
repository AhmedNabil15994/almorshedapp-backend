<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
        <h3 class="page-title">{{__('dashboard.assessments.create.name')}}</h3>
        @foreach (config('setting.locales') as $code)
            <div class="form-group">
                <label class="col-md-2">
                    {{__('dashboard.assessments.create.name')}} - {{ $code }}
                </label>
                <div class="col-md-9">
                    <input type="text" name="name[{{$code}}]" class="form-control" data-name="name.{{$code}}">
                    <div class="help-block"></div>
                </div>
            </div>
        @endforeach
        <hr>
        <h3 class="page-title">{{__('dashboard.assessments.create.description')}}</h3>
        @foreach (config('setting.locales') as $code)
            <div class="form-group">
                <label class="col-md-2">
                    {{__('dashboard.assessments.create.description')}} - {{ $code }}
                </label>
                <div class="col-md-9">
                    <textarea name="description[{{$code}}]" class="form-control"
                              data-name="description.{{$code}}"></textarea>
                    <div class="help-block"></div>
                </div>
            </div>
        @endforeach
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.assessments.create.doctor')}}
            </label>
            <div class="col-md-9">
                <select name="doctor_id" class="form-control" data-name="doctor_id">
                    <option value=""></option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->user ? $doctor->user->name : '' }}</option>
                    @endforeach
                </select>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.assessments.create.price')}}
            </label>
            <div class="col-md-9">
                <input type="number" name="price" class="form-control" data-name="price">
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.assessments.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status">
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.assessments.create.image')}}
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
            </div>
        </div>
    </div>
</div>
