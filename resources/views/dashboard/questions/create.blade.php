@extends('dashboard._layouts.master')
@section('title',__('dashboard.questions.create.title'))
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
                    <a href="{{ url(route('questions.index')) }}">
                        {{__('dashboard.questions.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('dashboard.questions.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('questions.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="assessment_id" value="{{ request('assessment_id') }}">
                <div class="col-md-12">
                  @include('dashboard.questions.forms.create')
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('dashboard._layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('dashboard.general.add_btn')}}
                                </button>
                                <a href="{{ route("assessments.show", request('assessment_id')) }}" class="btn btn-lg red">
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

<div class="answer hide">
    <hr>
    @foreach (config('setting.locales') as $code)
    <div class="form-group answer-content">
        <label class="col-md-2">
            {{__('dashboard.questions.create.answer')}} - {{ $code }}
        </label>
        <div class="col-md-9">
            <textarea name="answer[{{$code}}][]" class="form-control" data-name="answer.{{$code}}"></textarea>
            <div class="help-block"></div>
        </div>
    </div>
    @endforeach
    <div class="form-group">
        <label class="col-md-2">
            {{__('dashboard.questions.create.value')}}
        </label>
        <div class="col-md-9">
            <input type="number" class="form-control" name="value[]" data-name="value[]">
            <div class="help-block"></div>
        </div>
    </div>
</div>

@stop

@section('scripts')
  <script src="/vendor/laravel-filemanager/js/single-stand-alone-button.js"></script>

  <script type="text/javascript">

      $('#lfm').filemanager('image');

      $('#delete').click(function(){
         $('input#image').val('');
         $('img').attr('src','');
      });

     $(function () {

    	 $('#jstree').jstree({
         core:{
           multiple : false
         }
       });

      $('#jstree').on("changed.jstree", function (e, data) {
    		 $('#root_category').val(data.selected);
    	 });

     });

  </script>
  <script>
    $(document).ready(function()
    {
        $(".add-answer").click(function(){
            var answer = $(".answer").html();
            $(".answer-container").before(answer);
        });

        $("body").on("click",".remove-answer",function(){
            $(this).parents(".answer-content").remove();
        });
    });
  </script>
@stop
