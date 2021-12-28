@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4">Statistics</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$cusers??0}}</h3>

                        <p>Mijozlar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$ccards??0}}</h3>
                        <p>Daromad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$ctransfers??0}}</h3>

                        <p>Sotuvlar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$cpayments??0}}</h3>

                        <p>O'sish</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Monthly statistics</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">12</span>
                                    <span>Progress Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                                    <span class="text-muted">Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>


                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Yearly Sales</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{$yearly['sum']??0*1000}}+ UZS</span>
                                    <span>Progress Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>


                        </div>
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/chart/Chart.min.js')}}"></script>



    <script>

        var labele = {!! json_encode($yearly['months']??"") !!};
        var counte = {!! json_encode($yearly['counts']??"") !!};
        var sume = {!! json_encode($yearly['sums']??"") !!};

        console.log(labele)
        console.log(counte)
        $(document).ready(function () {
            $(function () {
                'use strict'

                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                var $salesChart = $('#sales-chart')
                new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: labele,
                        datasets: [
                            {
                                label: 'Sotuv',
                                backgroundColor: 'rgba(26,134,86,0.88)',
                                borderColor: 'rgba(26,134,86,0.88)',
                                data: counte
                            },
                            {
                                label: 'Summasi',
                                backgroundColor: 'rgba(69,77,162,0.88)',
                                borderColor: 'rgb(60,12,87)',
                                data: sume
                            },


                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        }

                    }
                })

                var $visitorsChart = $('#visitors-chart')
                new Chart($visitorsChart, {
                    data: {
                        labels: ['5', '6', '7', '8', '9', '10'],

                        datasets: [
                            {
                                label: 'Sotuvlar',
                                type: 'line',
                                data: [0, 0, 0, 0, 2, 4],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(26,134,86,0.88)',
                                pointBorderColor: 'rgba(26,134,86,0.88)',
                                pointBackgroundColor: 'rgba(26,134,86,0.88)',
                                fill: false
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor    : '#007bff'
                            },
                            {
                                label: 'Summasi',
                                type: 'line',
                                data: [0, 0, 0, 0, 1, 3],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(0,123,255,0.9)',
                                pointBorderColor: 'rgba(0,123,255,0.9)',
                                pointBackgroundColor: 'rgba(0,123,255,0.9)',
                                fill: false
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor    : '#007bff'
                            }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        }
                    }
                })
            })


        })

    </script>
@endsection
