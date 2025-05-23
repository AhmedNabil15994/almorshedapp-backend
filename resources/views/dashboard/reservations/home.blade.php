@extends('dashboard._layouts.master')
@section('title',__('dashboard.reservations.title'))
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
                        <a href="#">{{__('dashboard.reservations.title')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    @permission('add_reservations')
                                    <div class="btn-group">
                                        <a href="{{ url(route('reservations.create')) }}" class="btn sbold green">
                                            <i class="fa fa-plus"></i> {{__('dashboard.general.add_new')}}
                                        </a>
                                    </div>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                        {{-- DATATABLE FILTER --}}
                        @include('dashboard.reservations.forms.filter')

                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">
                                {{__('dashboard.reservations.title')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">

                            <table class="table table-striped table-bordered table-hover"
                                   id="dataTable">
                                <thead>
                                <tr>
                                    <th colspan="6"></th>
                                    <th colspan="6"></th>

                                </tr>

                                <tr>
                                    <th>
                                        <a href="javascript:;" onclick="CheckAll()">
                                            {{__('datatable.select_all')}}
                                        </a>
                                    </th>
                                    <th>#</th>
                                    <th style="width: 100px !important;">{{__('dashboard.reservations.datatable.username')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.user_id')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.user_email')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.user_mobile')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.doctor_id')}}</th>
                                    <th style="width: 100px !important;">{{__('dashboard.reservations.datatable.doctor')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.doctor_email')}}</th>
                                    <th style="width: 100px !important;">{{__('dashboard.reservations.datatable.created_at')}}</th>
                                    <th style="width: 100px !important;">{{__('dashboard.reservations.datatable.date')}}</th>
                                    <th style="width: 70px !important;">{{__('dashboard.reservations.datatable.start_time')}}</th>
                                    <th style="width: 70px !important;">{{__('dashboard.reservations.datatable.end_time')}}</th>
                                    <th style="width: 100px !important;">{{__('dashboard.reservations.datatable.services')}}</th>
                                    <th style="width: 50px !important;">{{__('dashboard.reservations.datatable.price')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.order_status')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.payment_type')}}</th>
                                    <th style="display: none">{{__('dashboard.reservations.datatable.options')}}</th>
                                </tr>
                                </thead>

                            </table>

                        </div>
                        @permission('delete_reservations')
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" id="deleteChecked" class="btn red btn-sm"
                                        onclick="deleteAllChecked('{{ url(route('reservations.deletes')) }}')">
                                    {{__('datatable.delete_all')}}
                                </button>
                            </div>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    @include('dashboard.reservations.forms.table')

@stop
