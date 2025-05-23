@extends('dashboard._layouts.master')
@section('title',__('dashboard.reservations.edit.title'))
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard')) }}">
                            {{ __('dashboard.home.home') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('reservations.index')) }}">
                            {{__('dashboard.reservations.title')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('dashboard.reservations.edit.title')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <form id="updateForm" role="form" class="form-horizontal form-row-seperated" method="post"
                      action="{{route('reservations.update',$reservation->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        @include('dashboard.reservations.forms.edit')
                        <div class="col-md-12">
                            <div class="form-actions">
                                @include('dashboard._layouts._ajax-msg')
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-lg green">
                                        {{__('dashboard.general.edit_btn')}}
                                    </button>
                                    <a href="{{url(route('reservations.index')) }}" class="btn btn-lg red">
                                        {{__('dashboard.general.back_btn')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#chkApponitment").click(function () {
                if ($(this).is(":checked")) {
                    $("#apponitment").show();
                } else {
                    $("#apponitment").hide();
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datetimepicker').datepicker({
                format: "yyyy-mm-dd",
            }).on('changeDate', function (e) {    //alert(Date.parse(e.date));
                var date = document.getElementById('datetimepicker').value;
                var doctor = "{{ $reservation->doctor->id }}";
                $.ajax({
                    type: "GET",
                    url: "/dashboard/reservations/available-times/" + doctor + "/" + formatDate(date),
                    dataType: "json",
                    success: function (result) {
                        $('select[name="availability_id"]').empty();
                        $.each(result, function (key, value) {
                            /*$('select[name="availability_id"]').append('<option value="' + key + '">' + (value > 12 ? (value - 12) + " PM" : value + " AM") + '</option>');*/
                            $('select[name="availability_id"]').append('<option value="' + key + '">' + (value < 12 ? (value == 0 ? 12 + " AM" : value + " AM") : (value == 12 ? 12 + " PM" : value - 12 + " PM")) + '</option>');
                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }
    </script>
@endsection