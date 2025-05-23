<div class="tab-pane fade" id="social_media">
    <div class="form-body">
        <h3 class="page-title">{{ __('dashboard.settings.social_media') }}</h3>
        <div class="col-md-10">
            <div class="form-group">
                <label class="col-md-2">
                    Facebook
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[facebook]" value="{{config('setting.social')['facebook']}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Twitter
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[twitter]" value="{{config('setting.social')['twitter']}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Instagram
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[instagram]" value="{{config('setting.social')['instagram']}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Linkedin
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[linkedin]" value="{{config('setting.social')['linkedin']}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Youtube
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[youtube]" value="{{config('setting.social')['youtube']}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Snap
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="social[snap]" value="{{config('setting.social')['snap']}}" />
                </div>
            </div>
        </div>
    </div>
</div>
