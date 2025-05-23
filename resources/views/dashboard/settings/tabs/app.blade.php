<div class="tab-pane fade" id="app">
    <h3 class="page-title">{{ __('dashboard.settings.general_data') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.title_label') }} - {{ locale() }}
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="translate[app_name]" value="{{ config('app.name') }}" />
            </div>
        </div>
    </div>
</div>
