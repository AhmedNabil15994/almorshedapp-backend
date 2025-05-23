<div class="tab-pane fade" id="logo">
    <h3 class="page-title">{{ __('dashboard.settings.logo') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.logo') }}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <div class="col-md-3">
                            <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i>
                            </a>
                        </div>
                        <div class="col-md-9">
                            <span id="holder" style="margin-top:15px;max-height:100px;">
                                <img src="{{url(config('setting.logo'))}}" style="height: 15rem;">
                            </span>
                        </div>
                    </span>
                </div>
                <input type="hidden" name="images[logo]" id="image" value="{{url(config('setting.logo'))}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                Favicon
            </label>
            <div class="col-md-9">
                <span class="input-group-btn">
                    <div class="col-md-3">
                        <a id="lfm1" data-input="favicon" data-preview="holder2" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i>
                        </a>
                    </div>
                    <div class="col-md-9">
                        <span id="holder2" style="margin-top:15px;max-height:100px;">
                            <img src="{{url(config('setting.favicon'))}}" style="height: 15rem;">
                        </span>
                    </div>
                </span>
                <input type="hidden" name="images[favicon]" id="favicon" value="{{url(config('setting.favicon'))}}">
            </div>
        </div>
    </div>
</div>
