<div class="tab-pane fade" id="availability_exceptions">
    <div class="form-group availabilityException-container">
        <label class="control-label col-md-3">
            <button type="button" class="btn btn-info add-availabilityException"><i class="fa fa-plus"></i></button>
        </label>
    </div>
    <hr>
	@foreach($doctor->availabilityException as $availabilityException)
    <div class="col-md-10 availabilityException-content">
        <input type="hidden" name="off_id[]" value="{{ $availabilityException->id }}">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.availability-exceptions.create.off_from')}}
            </label>
            <div class="col-md-4">
                <select name="off_from[]" class="form-control" data-name="off_from" dir="ltr" required>
                    <option value="{{ $availabilityException->off_from }}" selected>{{ $availabilityException->off_from % 12 ? $availabilityException->off_from % 12 : 12 }}:00&nbsp;{{ $availabilityException->off_from >= 12 ?  'PM' : 'AM' }}</option>
                    @for($i = 0; $i < 24; $i++)
                        <?php if($i == $availabilityException->off_from) continue; ?>
                        <option value="{{ $i }}">{{ $i % 12 ? $i % 12 : 12 }}:00&nbsp;{{ $i >= 12 ?  'PM' : 'AM' }}</option>
                    @endfor
                </select>
                <div class="help-block"></div>
            </div>
            <label class="col-md-2">
                {{__('dashboard.availability-exceptions.create.off_to')}}
            </label>
            <div class="col-md-4">
                <select name="off_to[]" class="form-control" data-name="off_to" dir="ltr" required>
                    <option value="{{ $availabilityException->off_to }}" selected>{{ $availabilityException->off_to % 12 ? $availabilityException->off_to % 12 : 12 }}:00&nbsp;{{ $availabilityException->off_to >= 12 ?  'PM' : 'AM' }}</option>
                    @for($i = 0; $i < 24; $i++)
                        <?php if($i == $availabilityException->off_to) continue; ?>
                        <option value="{{ $i }}">{{ $i % 12 ? $i % 12 : 12 }}:00&nbsp;{{ $i >= 12 ?  'PM' : 'AM' }}</option>
                    @endfor
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.availability-exceptions.create.off_date')}}
            </label>
            <div class="col-md-4">
                <input type="date" class="form-control" name="off_date[]" data-name="off_date" value="{{ $availabilityException->off_date }}" required>
                <div class="help-block"></div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger remove-availabilityException" type="button"><i class="icon-trash"></i></button>
            </div>
        </div>
	    <div class="clearfix"></div>
	    <hr>
    </div>
    @endforeach
</div>