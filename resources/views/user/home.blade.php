@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <div class="col-lg-6 col-6" id="onprocess_data">
                <div class="card card-row card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            No Running Process
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                   
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kanban overlay">
                        <i class="fas fa-sync-alt fa-spin"></i>
                    </div>
                </div>       
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="speedVal">{{$speed}}<sup style="font-size: 20px">MPM</sup></h3>
                        <br>
                        <p>Current Machine Speed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-speedometer"></i>
                    </div>
                    <div class="speed overlay">
                        <i class="fas fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="counterVal">{{$counter}}<sup style="font-size: 20px">Pcs</sup></h3>
                        <br>
                        <p>Total Production Counter</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <div class="counter overlay">
                        <i class="fas fa-sync-alt fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Speed Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="chart">
                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    </div>
                    <div class="speed-chart overlay">
                        <i class="fas fa-sync-alt fa-spin"></i>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Data Trend</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="search-form" role="form">
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                            <label style="padding-right: 10px ">Search Data From :</label>
                                            <input name="report_date_1" type="text" class="form-control datetimepicker-input @error('report_date_1') is-invalid @enderror" data-target="#reservationdatetime1" value="{{old('report_date_1')}}"/>
                                            <div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                            <label style="padding-left: 10px; padding-right: 10px ">To :</label>
                                            <input name="report_date_2" type="text" class="form-control datetimepicker-input @error('report_date_2') is-invalid @enderror" data-target="#reservationdatetime2" value="{{old('report_date_2')}}"/>
                                            <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <button style="padding-left: 10px; padding-right: 10px" type="submit" class="btn btn-primary">Search</button>
                                    <button id="clear-button" style="margin-left: 10px; padding-left: 10px; padding-right: 10px" class="btn btn-danger">Clear Search</button>    
                                </div>
                            </form>
                            <br>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                        <div class="chart">
                                            <canvas id="speedHistoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                        </div>
                                        <div class="speed-history overlay">
                                            <i class="fas fa-sync-alt fa-spin"></i>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->  
@endsection

@push('scripts')

<script>
    $(function(){
        $('.kanban').hide();
        $('.speed').hide();
        $('.counter').hide();
        $('.speed-chart').hide();

        updateSpeedChart();

        $('#reservationdatetime1').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });
        $('#reservationdatetime2').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });

        $('.speed-history').hide();
        blankChart();

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            $('.speed-history').show();
            searchDataHistory();
        });

        $('#clear-button').on('click', function(e) {
            e.preventDefault();
            $('input[name=report_date_1]').val('');
            $('input[name=report_date_2]').val('');
            blankChart();
        });
    });

    function blankChart()
    {
        var speedHistoryCanvas = $('#speedHistoryChart').get(0).getContext('2d');
        var speedHistoryData = {
            labels  : [],
                    datasets: [
                        {
                        label               : 'Production Speed',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : []
                        },
                    ]
        }
        var speedHistoryOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }
        new Chart(speedHistoryCanvas, {
                    type: 'line',
                    data: speedHistoryData,
                    options: speedHistoryOptions
                });
    }

    function searchDataHistory()
    {
        $.ajax({
            method:"POST",
            url:'{{route('realtime.searchSpeed')}}',
            data: {
                report_date_1 : $('input[name=report_date_1]').val(),
                report_date_2 : $('input[name=report_date_2]').val(),
                _token :'{{csrf_token()}}'
            },
            dataType:'json',
            success:function(response){
                var speedHistoryCanvas = $('#speedHistoryChart').get(0).getContext('2d');

                var speedHistoryData = {
                    labels  : response['created_at'],
                    datasets: [
                        {
                        label               : 'Production Speed',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : response['speed']
                        },
                    ]
                }

                var speedHistoryOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                new Chart(speedHistoryCanvas, {
                    type: 'line',
                    data: speedHistoryData,
                    options: speedHistoryOptions
                })

                $('.speed-history').hide();
            },
        })
                
    }

    function updateSpeedChart()
    {
        $('.speed-chart').show();
        $.ajax({
            method:'GET',
            url:'{{route('realtime.ajaxRequestAll')}}',
            dataType:'json',
            success:function(response){
                var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

                var areaChartData = {
                    labels  : response['created_at'],
                    datasets: [
                        {
                        label               : 'Production Speed',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : response['speed']
                        },
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaChartData,
                    options: areaChartOptions
                })

                $('.speed-chart').hide();
            }
        });

        $.ajax({
            method:'GET',
            url:'{{route('realtime.ajaxRequest')}}',
                dataType:'json',
            success:function(response){
                document.getElementById('speedVal').innerHTML = response.speed +'<sup style="font-size: 20px">MPM</sup>';
                $('.speed').hide();
                document.getElementById('counterVal').innerHTML = response.counter +'<sup style="font-size: 20px">PCS</sup>';
                $('.counter').hide();
            }
        });
        
        $.ajax({
            method:'GET',
            url:'{{route('realtime.workorderOnProcess')}}',
            dataType:'json',
            success:function(response){
                if(response == null){
                    return;
                }
                $('#onprocess_data').html(
                    '<div class="card card-row card-success">'+
                        '<div class="card-header">'+
                            '<h3 class="card-title">'+
                                'On Process'+
                            '</h3>'+
                        '</div>'+
                        '<div class="card-body">'+
                            '<div class="row">'+
                                '<div class="col-6">'+
                                    '<div class="card-body">'+
                                       '<div class="text-muted">'+
                                            '<p class="text-sm">Workorder'+
                                                '<b class="d-block">'+response.wo_number+'</b>'+
                                            '</p>'+
                                            '<p class="text-sm">Created By'+
                                                '<b class="d-block">'+response.createdBy+'</b>'+
                                            '</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-6">'+
                                    '<div class="card-body">'+
                                        '<div class="text-muted">'+
                                            '<p class="text-sm">Customer'+
                                                '<b class="d-block">'+response.customer+'</b>'+
                                            '</p>'+
                                            '<p class="text-sm">Mesin'+
                                                '<b class="d-block">'+response.machine+'</b>'+
                                            '</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                );
            },
            error:function(response){
                $('.kanban').hide();
            }
        });
    }
        
    let productionChannel = Echo.channel('channel-production-graph');
    productionChannel.listen('productionGraph',function(data){
        updateSpeedChart();
    });
    
</script>
@endpush
