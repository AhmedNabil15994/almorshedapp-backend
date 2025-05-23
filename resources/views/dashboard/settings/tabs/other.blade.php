<div class="tab-pane fade" id="other">
    <h3 class="page-title">{{ __('dashboard.settings.other') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.privacy_policy') }}
            </label>
            <div class="col-md-9">
                <select name="other[privacy_policy]" id="single" class="form-control select2">
                    <option value=""></option>
                    @foreach ($pages as $page)
                    <option value="{{ $page['id'] }}" {{(config('setting.other')['privacy_policy'] == $page->id) ? ' selected="" ' : ''}}>
                        {{ $page['title'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('dashboard.settings.force_update') }}
            </label>
            <div class="col-md-9">
              <div class="mt-radio-inline">
                <label class="mt-radio mt-radio-outline"> Yes
                  <input type="radio" name="force_update" value="1"
                  @if (config('setting.force_update') == 1)
                    checked
                  @endif>
                  <span></span>
                </label>
                <label class="mt-radio mt-radio-outline">
                  No
                  <input type="radio" name="force_update" value="0"
                  @if (config('setting.force_update') == 0)
                    checked
                  @endif>
                  <span></span>
                </label>
              </div>
            </div>
        </div>
    </div>
</div>
