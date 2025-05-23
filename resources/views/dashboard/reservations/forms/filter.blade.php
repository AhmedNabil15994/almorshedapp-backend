<div class="portlet-body">
    <div class="panel-body">
        <form id="formFilter" class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                {{__('dashboard.reservations.datatable.date_range')}}
                            </label>
                            <div id="reportrange" class="btn default form-control">
                                <i class="fa fa-calendar"></i> &nbsp;
                                <span> </span>
                                <b class="fa fa-angle-down"></b>
                                <input type="hidden" name="from">
                                <input type="hidden" name="to">
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                {{__('dashboard.reservations.datatable.doctor')}}
                            </label>
                            <div id="reportrange">

                                <select class="btn default form-control" name="doctor_name" id="">
                                    <option disabled selected>اختيار المرشد</option>
                                    @foreach($doctors as $doctor)
                                    @if(!empty($doctor->user))
                                        <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>
                                        @endif
                                        @endforeach
                                </select>
                                {{-- <input type="text" name="doctor_name" class="btn default form-control">--}}

                            </div>
                        </div>
                    </div>


                    {{-- <div class="col-md-3">--}}
                    {{-- <div class="form-group">--}}
                    {{-- <label class="control-label">--}}

                    {{-- مجموع الطلبات--}}
                    {{-- </label>--}}
                    {{-- <div id="reportrange" >--}}
                    {{-- <input type="checkbox" name="total_order" class="checkbox">--}}

                    {{-- </div>--}}
                    {{-- </div>--}}
                    {{-- </div>--}}


                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                الطلبات الملغية
                            </label>
                            <div id="reportrange">
                                <input type="checkbox" name="canceled_order" class="checkbox" value="2  ">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                الطلبات المدفوعة
                            </label>
                            <div id="reportrange">
                                <input type="checkbox" name="complete_order" class="checkbox" value="1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="form-actions">
            <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="search">
                <i class="fa fa-search"></i>
                {{__('datatable.search')}}
            </button>
            <button class="btn btn-sm red btn-outline filter-cancel">
                <i class="fa fa-times"></i>
                {{__('datatable.reset')}}
            </button>
        </div>
    </div>
</div>
