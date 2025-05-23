@extends('dashboard._layouts.master')
@section('title',__('dashboard.articles.edit.title'))
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
                    <a href="{{ url(route('articles.index')) }}">
                        {{__('dashboard.articles.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('dashboard.articles.edit.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('articles.update',$article->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                  @include('dashboard.articles.forms.edit')
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('dashboard._layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('dashboard.general.edit_btn')}}
                                </button>
                                <a href="{{url(route('articles.index')) }}" class="btn btn-lg red">
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
