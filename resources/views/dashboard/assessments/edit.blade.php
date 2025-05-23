@extends('dashboard._layouts.master')
@section('title',__('dashboard.assessments.edit.title'))
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
                    <a href="{{ url(route('assessments.index')) }}">
                        {{__('dashboard.assessments.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('dashboard.assessments.edit.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('assessments.update',$assessment->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle"> {{__('dashboard.assessments.create.info')}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('dashboard.assessments.create.general') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#resultRange" data-toggle="tab">
                                                    {{ __('dashboard.assessments.create.result_ranges') }}
                                                </a>
                                            </li>
                                            @foreach($assessment->questions as $key => $question)
                                            <li>
                                                <a href="#question{{ $question->id }}" data-toggle="tab">
                                                    {{__('dashboard.questions.create.question')}} #{{ ++$key }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            @include('dashboard.assessments.forms.edit')
                            @include('dashboard.assessments.tabs.result-range')
                            @foreach($assessment->questions as $key => $question)
                                @include('dashboard.assessments.tabs.question', ['question' => $question])
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('dashboard._layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('dashboard.general.edit_btn')}}
                                </button>
                                <a href="{{url(route('assessments.index')) }}" class="btn btn-lg red">
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

<div class="resultRange hide">
<div class="col-md-10 resultRange-content">
  @foreach (config('setting.locales') as $code)
  <div class="form-group">
      <label class="col-md-2">
          {{__('dashboard.assessments.create.rank')}} - {{ $code }}
      </label>
      <div class="col-md-9">
          <input type="text" name="rank_new[{{$code}}][]" class="form-control" data-name="rank.{{$code}}" required>
          <div class="help-block"></div>
      </div>
  </div>
  <div class="form-group">
      <label class="col-md-2">
          {{__('dashboard.assessments.create.message')}} - {{ $code }}
      </label>
      <div class="col-md-9">
          <input type="text" name="message_new[{{$code}}][]" class="form-control" data-name="message.{{$code}}" required>
          <div class="help-block"></div>
      </div>
  </div>
  @endforeach
  <div class="form-group">
      <label class="col-md-2">
          {{__('dashboard.assessments.create.score_from')}}
      </label>
      <div class="col-md-9">
          <input type="number" class="form-control" name="score_from[]" data-name="score_from[]" required>
          <div class="help-block"></div>
      </div>
  </div>
  <div class="form-group">
      <label class="col-md-2">
          {{__('dashboard.assessments.create.score_to')}}
      </label>
      <div class="col-md-9">
          <input type="number" class="form-control" name="score_to[]" data-name="score_to[]" required>
          <div class="help-block"></div>
      </div>
  </div>
  <hr>
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
        //
        $(".add-resultRange").click(function(){
            var resultRange = $(".resultRange").html();
            $(".resultRange-container").before(resultRange);
        });

        $("body").on("click",".remove-resultRange",function(){
            $(this).parents(".resultRange-content").remove();
        });
    });
  </script>
@stop
