<div class="tab-pane fade" id="services_prices">
    <h3 class="page-title">{{ __('dashboard.doctors.create.services_prices') }}</h3>
    <div class="col-md-12">

        @if(count($doctor->services) > 0)

            @foreach($doctor->services as $service)
                <input type="hidden" name="service_id{{ $service->id }}" value="{{ $service->id }}">
                <div class="form-group">
                    <label class="col-md-2">
                        {{ $service->name }}
                    </label>
                    <div class="col-md-1">
                        {{__('dashboard.doctors.create.price')}}
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="price_{{ $service->id }}" class="form-control"
                               data-name="price_{{ $service->id }}" value="{{ $service->pivot->price }}">
                        <div class="help-block"></div>
                    </div>
                    <div>
                        <input type="checkbox" class="make-switch" id="test" data-size="small"
                               name="status_{{ $service->id }}" {{ ($service->pivot->status == 1) ? ' checked="" ' : '' }}>
                    </div>
                </div>
            @endforeach

        @endif

    </div>
</div>
