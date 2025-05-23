<div class="tab-pane fade active in" id="global_setting">
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.username')}}
            </label>
            <div class="col-md-9">
                <select class="form-control js-example-basic-single" name="user_id" id="" required>
                    <option value="">اختيار المستخدم</option>
                    @foreach($users as $user)
                        @if(!empty($user))
                            <option value="{{$user->id}}">{{$user->display_name}}</option>
                        @endif
                    @endforeach
                </select>
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
                            <option value="{{$doctor->id}}">{{$doctor->user->display_name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.service')}}
            </label>
            <div class="col-md-9">
                <select class="form-control" name="service_id" id="" required>
                    <option value="">اختيار الخدمة</option>
                    @foreach($services as $service)
                        @if(!empty($service))
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.price')}}
            </label>
            <div class="col-md-9">
                <input type="text" name="price" class="form-control" data-name="price" required>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.start_time')}}
            </label>
            <div class="col-md-9">
                <select name="start_time" class="form-control" required>
                    <option value="">اختر</option>
                    @php
                        $hour = 0;
                        while($hour++ < 24) {

                           $timetoprint=date('H',mktime($hour,00)); echo

                           '<option value="' .$timetoprint.'">
                            '. ( $hour < 12 ? ($hour . " AM") : ($hour == 24 ? 12 . " AM" : ($hour == 12 ? 12 . " PM" : $hour - 12 . " PM") ) ) .'
                            </option>';
                        }
                    @endphp
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.end_time')}}
            </label>
            <div class="col-md-9">
                <select name="end_time" class="form-control" required>
                    <option value="">اختر</option>
                    @php
                        $hour = 0;
                        while($hour++ < 24) {

                           $timetoprint=date('H',mktime($hour,00)); echo

                           '<option value="' .$timetoprint.'">
                            '. ( $hour < 12 ? ($hour . " AM") : ($hour == 24 ? 12 . " AM" : ($hour == 12 ? 12 . " PM" : $hour - 12 . " PM") ) ) .'
                            </option>';

                           /*'<option value="' .$timetoprint.'">
                            '.$timetoprint.'
                            </option>';*/
                        }
                    @endphp
                </select>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.reservations.create.date')}}
            </label>
            <div class="col-md-9">
                <input type="date" name="date" class="form-control" data-name="date" required>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>
