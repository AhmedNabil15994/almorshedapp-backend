<div class="tab-pane fade" id="working_days">
    <h3 class="page-title">{{ __('dashboard.doctors.create.working_days') }}</h3>
    <div class="col-md-12">
        @foreach($days as $day)
        <input type="hidden" name="{{ $day->code }}_day" value="{{ $day->id }}">
        <h3>{{ $day->day }}</h3>

        <div class="form-group {{ $day->code }}-availability-container">
            <label class="control-label col-md-3">
                <button type="button" class="btn btn-info {{ $day->code }}-add-availability"><i class="fa fa-plus"></i></button>
            </label>
        </div>

        <hr>
        @endforeach
    </div>
</div>
