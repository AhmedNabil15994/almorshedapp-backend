@extends('dashboard._layouts.master')
@section('title', __('dashboard.home.title') )
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard')) }}">{{ __('dashboard.home.title') }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"> {{ __('dashboard.home.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>

            @permission('show_statistics')

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">الأحصائيات</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-card mt-element-overlay">

                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                            <div class="visual">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                          data-value="{{$allActiveUsers}}">0</span>
                                                </div>
                                                <div class="desc"> عدد الاعضاء المفعلين</div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                            <div class="visual">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                          data-value="{{$allNotActiveUsers}}">0</span>
                                                </div>
                                                <div class="desc"> عدد الاعضاء غير المفعلين</div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                            <div class="visual">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                          data-value="{{$allActiveDoctors}}">0</span>
                                                </div>
                                                <div class="desc">عدد المرشدين المفعلين</div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                            <div class="visual">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                          data-value="{{$allNotActiveDoctors}}">0</span>
                                                </div>
                                                <div class="desc">عدد المرشدين غير المفعلين</div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px;">

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                            <div class="visual">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                          data-value="{{$allreservation}}">0</span>
                                                </div>
                                                <div class="desc">عدد الحجوزات</div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">
                                احصائيات
                            </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-card mt-card-round mt-element-overlay">
                                <div class="row">
                                    <div class="general-item-list">

                                        <div class="col-md-6">
                                            <b class="page-title">
                                                تاريخ انشاء الاعضاء بالاشهر
                                            </b>
                                            <canvas id="myChart1" width="540" height="270"></canvas>
                                        </div>

                                        <div class="col-md-6">
                                            <b class="page-title">
                                                تاريخ انشاء المرشدين بالاشهر
                                            </b>
                                            <canvas id="myChart2" width="540" height="270"></canvas>
                                        </div>

                                        <div class="col-md-6">
                                            <b class="page-title">
                                                اجمالي مبلغ الاستشارات الشهرية
                                                - KWD
                                            </b>
                                            <canvas id="monthlyOrders" width="540" height="270"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endpermission

        </div>
    </div>
@stop


{{-- JQUERY++ --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <script>
        // USERS COUNT BY DATE
        var ctx = document.getElementById("myChart1").getContext('2d');
        var labels = {!!$userCreated['userDate'] !!};
        var countDate = {!!$userCreated['countDate'] !!};
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'تاريخ انشاء الاعضاء بالاشهر',
                    data: countDate,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54 , 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75 , 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54 , 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75 , 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        var ctx = document.getElementById("myChart2").getContext('2d');
        var labels = {!!$doctorCreated['doctorDate'] !!};
        var countDate = {!!$doctorCreated['countDate'] !!};
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'تاريخ انشاء المرشدين بالاشهر',
                    data: countDate,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54 , 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75 , 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54 , 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75 , 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("monthlyOrders");
        var labels = {!!$monthlyReservations['reservation_dates'] !!};
        var count = {!!$monthlyReservations['profits'] !!};
        var data = {
            labels: labels,
            datasets: [{
                label: "اجمالي مبلغ الاستشارات الشهرية",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#36A2EB",
                borderColor: "#36A2EB",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "#36A2EB",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#36A2EB",
                pointHoverBorderColor: "#FFCE56",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: count,
                spanGaps: false,
            }]
        };
        var myLineChart = new Chart(ctx, {
            type: 'line',
            label: labels,
            data: data,
            options: {
                animation: {
                    animateScale: true
                }
            }
        });

    </script>
@stop
