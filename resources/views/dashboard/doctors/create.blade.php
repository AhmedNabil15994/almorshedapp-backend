@extends('dashboard._layouts.master')
@section('title',__('dashboard.doctors.create.title'))
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
                    <a href="{{ url(route('doctors.index')) }}">
                        {{__('dashboard.doctors.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('dashboard.doctors.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('doctors.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle"> {{__('dashboard.doctors.create.info')}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('dashboard.doctors.create.general') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#working_days" data-toggle="tab">
                                                    {{ __('dashboard.doctors.create.working_days') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            @include('dashboard.doctors.forms.create')
                            @include('dashboard.doctors.tabs.availability')
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('dashboard._layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('dashboard.general.add_btn')}}
                                </button>
                                <a href="{{url(route('doctors.index')) }}" class="btn btn-lg red">
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

@foreach($days as $day)
<div class="{{ $day->code }}-availability hide">
    <div class="form-group {{ $day->code }}-availability-content">
        <label class="col-md-1"></label>
        <div class="col-md-2">
            {{__('dashboard.availabilities.create.available_from')}}
        </div>
        <div class="col-md-3">
            <select name="{{ $day->code }}_available_from[]" class="form-control" data-name="available_from" dir="ltr" required>
                <option></option>
                @for($i = 0; $i < 24; $i++)
                    <option value="{{ $i }}">{{ $i % 12 ? $i % 12 : 12 }}:00&nbsp;{{ $i >= 12 ?  'PM' : 'AM' }}</option>
                @endfor
            </select>
            <div class="help-block"></div>
        </div>
        <div class="col-md-2">
            {{__('dashboard.availabilities.create.available_to')}}
        </div>
        <div class="col-md-3">
            <select name="{{ $day->code }}_available_to[]" class="form-control" data-name="available_to" dir="ltr" required>
                <option></option>
                @for($i = 0; $i < 24; $i++)
                    <option value="{{ $i }}">{{ $i % 12 ? $i % 12 : 12 }}:00&nbsp;{{ $i >= 12 ?  'PM' : 'AM' }}</option>
                @endfor
            </select>
            <div class="help-block"></div>
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger {{ $day->code }}-remove-availability" type="button"><i class="icon-trash"></i></button>
        </div>
    </div>
</div>
@endforeach

@stop

@section('scripts')
  <script src="/vendor/laravel-filemanager/js/single-stand-alone-button.js"></script>
  <script type="text/javascript">
      $('#lfm').filemanager('image');
      $('#delete').click(function(){
         $('input#image').val('')
         $('img').attr('src','')
     });
  </script>

  <script>
    $(document).ready(function()
    {
        //
        $(".S-add-availability").click(function(){
            var availability = $(".S-availability").html();
            $(".S-availability-container").before(availability);
        });

        $("body").on("click",".S-remove-availability",function(){
            $(this).parents(".S-availability-content").remove();
        });

        //
        $(".U-add-availability").click(function(){
            var availability = $(".U-availability").html();
            $(".U-availability-container").before(availability);
        });

        $("body").on("click",".U-remove-availability",function(){
            $(this).parents(".U-availability-content").remove();
        });

        //
        $(".M-add-availability").click(function(){
            var availability = $(".M-availability").html();
            $(".M-availability-container").before(availability);
        });

        $("body").on("click",".M-remove-availability",function(){
            $(this).parents(".M-availability-content").remove();
        });

        //
        $(".T-add-availability").click(function(){
            var availability = $(".T-availability").html();
            $(".T-availability-container").before(availability);
        });

        $("body").on("click",".T-remove-availability",function(){
            $(this).parents(".T-availability-content").remove();
        });

        //
        $(".W-add-availability").click(function(){
            var availability = $(".W-availability").html();
            $(".W-availability-container").before(availability);
        });

        $("body").on("click",".W-remove-availability",function(){
            $(this).parents(".W-availability-content").remove();
        });

        //
        $(".R-add-availability").click(function(){
            var availability = $(".R-availability").html();
            $(".R-availability-container").before(availability);
        });

        $("body").on("click",".R-remove-availability",function(){
            $(this).parents(".R-availability-content").remove();
        });

        //
        $(".F-add-availability").click(function(){
            var availability = $(".F-availability").html();
            $(".F-availability-container").before(availability);
        });

        $("body").on("click",".F-remove-availability",function(){
            $(this).parents(".F-availability-content").remove();
        });
    });
  </script>
@stop
