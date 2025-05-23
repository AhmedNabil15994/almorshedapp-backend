<div class="tab-pane fade" id="working_days">
    <h3 class="page-title">{{ __('dashboard.doctors.create.working_days') }}</h3>
    <div class="col-md-12">
        @foreach($days as $day)
        <input type="hidden" name="{{ $day->code }}_day" value="{{ $day->id }}">
        <h3>{{ $day->day }}</h3>
        @foreach($day->availability as $key => $availability)
        <div class="form-group {{ $day->code }}-availability-content">
            <input type="hidden" name="{{ $day->code }}_availability_id[]" value="{{ $availability->id }}">
            <label class="col-md-1"></label>
            <div class="col-md-2">
                {{__('dashboard.availabilities.create.available_from')}}
            </div>
            <div class="col-md-3">
                <select  name="{{ $day->code }}_available_from[]" class="form-control" data-name="available_from" dir="ltr" required>
                    <option value="{{ $availability->available_from }}" selected>{{ $availability->available_from % 12 ? $availability->available_from % 12 : 12 }}:00&nbsp;{{ $availability->available_from >= 12 ?  'PM' : 'AM' }}</option>
                    @for($i = 0; $i < 24; $i++)
                        <?php if($i == $availability->available_from) continue; ?>
                        <option value="{{ $i }}">{{ $i % 12 ? $i % 12 : 12 }}:00&nbsp;{{ $i >= 12 ?  'PM' : 'AM' }}</option>
                    @endfor
                </select>
                <div class="help-block"></div>
            </div>
            <div class="col-md-2">
                {{__('dashboard.availabilities.create.available_to')}}
            </div>
            <div class="col-md-3">
                <select  name="{{ $day->code }}_available_to[]" class="form-control" data-name="available_to" dir="ltr" required>
                    <option value="{{ $availability->available_to }}" selected>{{ $availability->available_to % 12 ? $availability->available_to % 12 : 12 }}:00&nbsp;{{ $availability->available_to >= 12 ?  'PM' : 'AM' }}</option>
                    @for($j = 0; $j < 24; $j++)
                        <?php if($j == $availability->available_to) continue; ?>
                        <option value="{{ $j }}">{{ $j % 12 ? $j % 12 : 12 }}:00&nbsp;{{ $j >= 12 ?  'PM' : 'AM' }}</option>
                    @endfor
                </select>
                <div class="help-block"></div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger {{ $day->code }}-remove-availability" type="button"><i class="icon-trash"></i></button>
            </div>
        </div>
        @endforeach
        <div class="form-group {{ $day->code }}-availability-container">
            <label class="control-label col-md-3">
                <button type="button" class="btn btn-info {{ $day->code }}-add-availability"><i class="fa fa-plus"></i></button>
            </label>
        </div>
        <hr>
        @endforeach
    </div>
</div>
