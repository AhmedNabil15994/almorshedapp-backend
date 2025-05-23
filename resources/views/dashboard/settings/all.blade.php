@extends('dashboard._layouts.master')
@section('title', __('dashboard.settings.title'))
@section('content')
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="{{ url(route('dashboard')) }}">{{ __('dashboard.home.home') }}</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">{{ __('dashboard.settings.title') }}</a>
				</li>
			</ul>
		</div>

		<h1 class="page-title"></h1>

		@include('dashboard._layouts._msg')

		<div class="row">
			<form role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('settings.store')}}" enctype="multipart/form-data">
				<div class="col-md-12">
					@csrf
					<div class="col-md-3">
						<div class="panel-group accordion scrollable" id="accordion2">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle"> {{__('dashboard.settings.info')}}
										</a>
									</h4>
								</div>
								<div id="collapse_2_1" class="panel-collapse in">
									<div class="panel-body">
										<ul class="nav nav-pills nav-stacked">
											<li class="active">
												<a href="#global_setting" data-toggle="tab">
													{{ __('dashboard.settings.general') }}
												</a>
											</li>
											<li>
												<a href="#app" data-toggle="tab">
													{{ __('dashboard.settings.general_data') }}
												</a>
											</li>
											<li>
												<a href="#mail" data-toggle="tab">
													{{ __('dashboard.settings.mail') }}
												</a>
											</li>
											<li>
												<a href="#logo" data-toggle="tab">
													{{ __('dashboard.settings.logo') }}
												</a>
											</li>
											<li>
												<a href="#shipping" data-toggle="tab">
												رقم الهاتف
												</a>
											</li>
											<li>
												<a href="#social_media" data-toggle="tab">
													{{ __('dashboard.settings.social_media') }}
												</a>
											</li>
											<li>
												<a href="#other" data-toggle="tab">
													{{ __('dashboard.settings.other') }}
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
							@include('dashboard.settings.tabs.general')
							@include('dashboard.settings.tabs.app')
							@include('dashboard.settings.tabs.logo')
							@include('dashboard.settings.tabs.social')
							@include('dashboard.settings.tabs.mail')
							@include('dashboard.settings.tabs.shipping')
							@include('dashboard.settings.tabs.other')
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-9">
							<button type="submit" id="submit" class="btn btn-lg blue">
								{{ __('dashboard.settings.save_buttons') }}
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop


@section('scripts')
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script type="text/javascript">
      $('#lfm').filemanager('image');
			$('#lfm1').filemanager('image');
      $('#delete').click(function(){
         $('input#image').val('')
         $('img').attr('src','')
     });
  </script>
@stop
