@extends('dashboard._layouts.master')
@section('title',__('dashboard.answers.create.title'))
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
                    <a href="{{ url(route('answers.index')) }}">
                        {{__('dashboard.answers.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('dashboard.answers.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('answers.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="question_id" value="{{ request('question_id') }}">
                <div class="col-md-12">
                  @include('dashboard.answers.forms.create')
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('dashboard._layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('dashboard.general.add_btn')}}
                                </button>
                                <a href="{{ route("questions.show", request('question_id')) }}" class="btn btn-lg red">
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
@stop
