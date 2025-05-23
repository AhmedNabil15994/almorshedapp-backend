<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.username')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="username" class="form-control" data-name="username"
                       value="{{$reservation->user->name}}" readonly>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.doctor')}}
            </label>
            <div class="col-md-9">
                <select class="form-control js-example-basic-single" name="doctor_id" id="" required>
                    <option value="">اختيار المرشد</option>
                    @foreach($doctors as $doctor)
                        @if(!empty($doctor->user))
                            <option value="{{$doctor->id}}" {{ ($reservation->doctor_id == $doctor->id ? 'selected' : '') }}>{{$doctor->user->display_name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.start_time')}}
            </label>
            <div class="col-md-9">
                {{--<input type="text" name="start_time" class="form-control" data-name="start_time"
                       value="{{$reservation->start_time}}" readonly> --}}

                <input type="text" name="start_time" class="form-control" data-name="start_time"
                       {{--                       value="{{($reservation->start_time > 12 ? ($reservation->start_time - 12) . " PM" : ( $reservation->start_time == 0 ? "12 AM" : $reservation->start_time . " AM" ) )}}"--}}
                       value="{{ ( $reservation->start_time < 12 ? ($reservation->start_time == 0 ? 12 . " AM" : $reservation->start_time . " AM") : ( $reservation->start_time == 12 ? 12 . " PM" : $reservation->start_time - 12 . " PM" ) ) }}"
                       readonly disabled>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.end_time')}}
            </label>
            <div class="col-md-9">
                {{--<input type="text" name="end_time" class="form-control" data-name="end_time"
                       value="{{$reservation->end_time}}" readonly>--}}

                <input type="text" name="end_time" class="form-control" data-name="end_time"
                       value="{{ ( $reservation->end_time < 12 ? ($reservation->end_time == 0 ? 12 . " AM" : $reservation->end_time . " AM") : ( $reservation->end_time == 12 ? 12 . " PM" : $reservation->end_time - 12 . " PM" ) ) }}"
                       readonly disabled>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.date')}}
            </label>
            <div class="col-md-9">
                <input type="date" name="date" class="form-control" data-name="date" value="{{$reservation->date}}"
                       readonly>
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.order_status_id')}}
            </label>
            <div class="col-md-9">
                <select name="order_status_id" class="form-control" data-name="order_status_id">
                    @foreach($orderStatuses as $status)
                        <option value="{{ $status->id }}"
                                @if($status->id == $reservation->order_status_id) selected @endif>{{ $status->title }}</option>
                    @endforeach
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <label for="chkApponitment">
            <input type="checkbox" id="chkApponitment" name="change_apponitment" value="1"/>
            {{__('dashboard.reservations.create.change_apponitment')}}
        </label>
        <div id="apponitment" style="display: none">
            <div class="form-group">
                <label class="col-md-2">
                    {{__('dashboard.reservations.create.date')}}
                </label>
                <div class="col-md-9">
                    <input class="form-control form-control-inline input-medium date-picker" name="required_at"
                           data-name="required_at" size="16" type="text" value="" id='datetimepicker'>
                    <div class="help-block"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">
                    {{__('dashboard.reservations.create.start_time')}}
                </label>
                <div class="col-md-9">
                    <select class="form-control" name="availability_id" data-name="availability_id">
                    </select>
                    <div class="help-block"></div>
                </div>
            </div>

        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.reason')}}
            </label>
            <div class="col-md-9">
                <textarea name="reason" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <hr>
    </div>
</div>
