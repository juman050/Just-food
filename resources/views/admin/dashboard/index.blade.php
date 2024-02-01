@extends('admin.layout.master')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-alpha/Chart.min.js"></script>
    <style type="text/css">
        canvas{-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;}
        .log {display:none;position: absolute;right: 0;top: 0;bottom: 0;background-color: #EEE;float: right;width: 0%;padding: 8px;overflow-y: auto;white-space: pre;line-height: 1.5em;}
    </style>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>{{$data['pageName']}}<small>{{$data['pageTagLine']}}</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
                <li class="active">{{$data['pageName']}}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$data['total_pending_orders']}}</h3>
                            <p>Pending Orders</p>
                        </div>
                        <div class="icon"><i class="ion ion-bag"></i></div>
                        <a href="{{ url('backoffice/orders/pending') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$data['total_orders']}}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon"><i class="ion ion-stats-bars"></i></div>
                        <a href="{{ url('backoffice/order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$data['total_users']}}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon"><i class="ion ion-person-add"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{\Session::get('currency')}} {{$data['total_earning']}}</h3>

                            <p>Total earn</p>
                        </div>
                        <div class="icon"><i class="ion ion-pie-graph"></i></div>
                        <a href="#" class="small-box-footer">Hurrah !</a>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 col-md-6 col-xs-12">

                    <h3>Overview your last 7 days orders</h3>
                    <style>
                        canvas{-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;}
                        .log {display:none;position: absolute;right: 0;top: 0;bottom: 0;background-color: #EEE;float: right;width: 0%;padding: 8px;overflow-y: auto;white-space: pre;line-height: 1.5em;}
                    </style>
                    <div class="log"></div>
                    <div style="width: 100%;">
                        <canvas id="canvas"  style="border: none;border-radius: 0px;background: #ececec;"></canvas>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-xs-12">

                    <h3>See your last 7 days earnings</h3>
                    <div class="log"></div>
                    <div style="width: 100%;">
                        <canvas id="canvas2"  style="border: none;border-radius: 0px;background: #ececec;"></canvas>
                    </div>

                </div>

            </div>

        </section>

    </div>

    <?php  

        $days = array();
        $updatedDatas = array();
        if(!empty($sevenDays))
        {
            for ($i=0; $i < count($sevenDays); $i++) { 
                $days[] = date('j M',strtotime($sevenDays[$i]));
                $lastSevenDaysEarn[] = $seven_days_earn[$i];
                $lastSevenDaysOrders[] = $seven_days_orders[$i];
            }
        }

    ?>

    <script type="text/javascript">

        var chartData = {
            labels: <?php echo json_encode(array_values($days)); ?>,
            datasets: [
            {
                type: 'bar',
                label: 'Previous 7 days orders',
                backgroundColor: 'purple',
                data: <?php echo json_encode(array_values($lastSevenDaysOrders)); ?>,
                borderColor: 'white',
                borderWidth: 1
            }
            ]
        };


        var chartData2 = {
            labels: <?php echo json_encode(array_values($days)); ?>,
            datasets: [
            {
                type: 'line',  // horizontalBar, bar, line
                label: 'Previous 7 days earnings',
                backgroundColor: 'red',
                data: <?php echo json_encode(array_values($lastSevenDaysEarn)); ?>,
                borderColor: 'white',
                borderWidth: 1
            }
            ]
        };

        window.onload = function() {

            var ctx = document.getElementById('canvas').getContext('2d');
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: ' '
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });


            var ctx2 = document.getElementById('canvas2').getContext('2d');
                window.myMixedChart = new Chart(ctx2, {
                type: 'line',   // horizontalBar, bar, line
                data: chartData2,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: ' '
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });

        };

    </script>

@endsection


