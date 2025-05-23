<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{ __('dashboard.settings.Language_label') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.supported_language') }}
            </label>
            <div class="col-md-9">
                <select name="locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (languages::all() as $key => $language)
                    <option value="{{ $key }}" @if (collect(config('setting.locales'))->contains($key))
                    selected
                    @endif>
                        {{ $language['name'] }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.default_language') }}
            </label>
            <div class="col-md-9">
                <select name="default_locales" id="single" class="form-control select2">
                    @foreach (languages::all() as $key => $language)
                    <option value="{{ $key }}"
                    @if (config('setting.default_locales') == $key)
                    selected
                    @endif>
                        {{ $language['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <h3 class="page-title">{{ __('dashboard.settings.countries_label') }}</h3>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.supported_countries') }}
            </label>
            <div class="col-md-9">
                <select name="countries[]" id="single" class="form-control select2" multiple="">
                    @foreach (Countries::getList(locale()) as $code => $country)
                    <option value="{{ $code }}" @if (collect(config('setting.supported_countries'))->contains($code))
                    selected=""
                    @endif>
                        {{ $country }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.default_country') }}
            </label>
            <div class="col-md-9">
                <select name="default_country" id="single" class="form-control select2">
                    @foreach (Countries::getList(locale()) as $code => $country)
                    <option value="{{ $code }}" @if (config('setting.default_country') == $code)
                    selected
                    @endif>
                        {{ $country }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
        <hr>
        <h3 class="page-title">{{ __('dashboard.settings.currencies_label') }}</h3>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.supported_currencies') }}
            </label>
            <div class="col-md-9">
                <select name="currencies[]" id="single" class="form-control select2" multiple="">
                    @foreach (CountriesList::currencies() as $code => $currency)
                    <option value="{{$code}}" @if (collect(config('setting.supported_currencies'))->contains($code))
                    selected=""
                    @endif>
                        {{ $currency->name }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.default_currency') }}
            </label>
            <div class="col-md-9">
                <select name="default_currency" id="single" class="form-control select2">
                    @foreach (CountriesList::currencies() as $code => $currency)
                    <option value="{{ $code }}" @if (config('setting.default_currency') == $code)
                    selected
                    @endif>
                        {{ $currency->name }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
