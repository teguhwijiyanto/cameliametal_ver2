@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Workorder</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Runtime</span>
                                            @if (!$oee)
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            @else
                                                <span class="info-box-number text-center text-muted mb-0">{{$oee->total_runtime}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Downtime</span>
                                            @if (!$oee)
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            @else
                                                <span class="info-box-number text-center text-muted mb-0">{{$oee->total_downtime}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Production</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$totalProduction}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Production Result</h4>
                                    <div class="card card-primary card-outline">
                                        <div class="card-header p-2">
                                            <p>Bundle Num</p>
                                            <ul class="nav nav-pills">
                                                @foreach ($productions as $prod)
                                                    <li class="nav-item"><a class="nav-link" href="#production{{$prod->bundle_num}}" data-toggle="tab">{{$prod->bundle_num}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-body box-profile">
                                            @if (count($productions) == 0)
                                                <div class="alert alert-danger text-center" role="alert">
                                                    No Data
                                                </div>
                                            @else
                                                <div class="tab-content">
                                                    @foreach ($productions as $prod)
                                                        <div class="tab-pane" id="production{{$prod->bundle_num}}">
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                @foreach($smeltings as $smelt)
                                                                    @if ($smelt->bundle_num == $prod->bundle_num)
                                                                        <h3 class="profile-username text-center">No. Leburan : {{$smelt->smelting_num}}</h3>
                                                                    @endif
                                                                @endforeach
                                                                <li class="list-group-item">
                                                                    <b>Dies Number</b> <p class="float-right">{{$prod->dies_num}}</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Diameter Ujung</b> <p class="float-right">{{$prod->diameter_ujung}} mm</p> 
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Diameter Tengah</b> <p class="float-right">{{$prod->diameter_tengah}} mm</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Diameter Ekor</b> <p class="float-right">{{$prod->diameter_ekor}} mm</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Kelurusan Actual</b> <p class="float-right">{{$prod->kelurusan_aktual}} mm</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Berat FG</b> <p class="float-right">{{$prod->berat_fg}} Kg</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Pcs Per Bundle</b> <p class="float-right">{{$prod->pcs_per_bundle}} Pcs</p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Bundle Judgement</b> <p class="float-right">
                                                                        @if ($prod->bundle_judgement == '1')
                                                                            Good
                                                                        @else
                                                                            No Good
                                                                        @endif
                                                                        {{-- {{$prod->bundle_judgement}} --}}
                                                                    </p>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Visual</b> <p class="float-right">
                                                                        @if ($prod->visual == 1)
                                                                            Good
                                                                        @endif
                                                                        
                                                                        {{-- {{$prod->visual}} --}}
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>OEE Performance</h4>
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Downtime Data</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body box-profile">
                                            @if (!$oee)
                                                <div class="alert alert-danger text-center" role="alert">
                                                    No Data
                                                </div>
                                            @else
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        Management Downtime
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="tab-content p-0">
                                                                <div class="chart tab-pane active" id="management-chart" style="position: relative; height: 300px;">
                                                                    <canvas id="management-chart-canvas" height="300" style="height: 300px;"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <li class="list-group-item">
                                                        <b>Briefing</b> <p class="float-right">{{$oee->dt_briefing}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Check Shot Blast</b> <p class="float-right">{{$oee->dt_cek_shot_blast}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Check Mesin</b> <p class="float-right">{{$oee->dt_cek_mesin}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Sambung Bahan</b> <p class="float-right">{{$oee->dt_sambung_bahan}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Setting Awal</b> <p class="float-right">{{$oee->dt_setting_awal}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Selesai Satu Bundle</b> <p class="float-right">{{$oee->dt_selesai_satu_bundle}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Cleaning Area Mesin</b> <p class="float-right">{{$oee->dt_cleaning_area_mesin}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Istirahat</b> <p class="float-right">{{$oee->dt_istirahat}} min</p>
                                                    </li>
                                                    <div class="alert alert-danger text-center" role="alert">
                                                        Waste Downtime
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="tab-content p-0">
                                                                <div class="chart tab-pane active" id="downtime-chart" style="position: relative; height: 300px;">
                                                                    <canvas id="downtime-chart-canvas" height="300" style="height: 300px;"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <li class="list-group-item">
                                                        <b>Bongkar Pasang Dies</b> <p class="float-right">{{$oee->dt_bongkar_pasang_dies}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Tunggu Bahan Baku</b> <p class="float-right">{{$oee->dt_tunggu_bahan_baku}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Ganti Bahan Baku</b> <p class="float-right">{{$oee->dt_ganti_bahan_baku}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Tunggu Dies</b> <p class="float-right">{{$oee->dt_tunggu_dies}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Gosok Dies</b> <p class="float-right">{{$oee->dt_gosok_dies}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Ganti Part Short Blast</b> <p class="float-right">{{$oee->dt_ganti_part_shot_blast}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>setting Ulang Kelurusan</b> <p class="float-right">{{$oee->dt_setting_ulang_kelurusan}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Ganti Polishing Dies</b> <p class="float-right">{{$oee->dt_ganti_polishing_dies}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Ganti Nozle Polishing Mesin</b> <p class="float-right">{{$oee->dt_ganti_nozle_polishing_mesin}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Ganti Roller Straightener</b> <p class="float-right">{{$oee->dt_ganti_roller_straightener}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Dies Rusak</b> <p class="float-right">{{$oee->dt_dies_rusak}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Mesin Trouble Operator</b> <p class="float-right">{{$oee->dt_mesin_trouble_operator}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Validasi QC</b> <p class="float-right">{{$oee->dt_validasi_qc}} min</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Mesin Trouble Maintenance</b> <p class="float-right">{{$oee->dt_mesin_trouble_maintenance}} min</p>
                                                    </li>
                                                </ul>
                                            @endif
                                            
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            @if ($oee_val != 0)
                                <h1 class="text-muted">OEE</h1>
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <div class="chart tab-pane active" id="oee-chart" style="position: relative; height: 300px;">
                                            <canvas id="oee-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="text-primary">{{round($oee_val,2)}} %</h2>
                                <h5 class="text-muted">OTR : {{round($otr,2)}} %</h5>
                                <h5 class="text-muted">PER : {{round($per,2)}} %</h5>
                                <h5 class="text-muted">QR : {{round($qr,2)}} %</h5>
                                <br>
                            @endif
                            <div class="text-muted">
                                <p class="text-sm">Workorder Number
                                    <b class="d-block">{{$workorder->wo_number}}</b>
                                </p>
                                <p class="text-sm">Created By
                                    <b class="d-block">{{$createdBy->name}}</b>
                                </p>
                            </div>
                            <h5 class="mt-5 text-muted">Bahan Baku</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <p href="" class="text-secondary"> Supplier: {{$workorder->bb_supplier}}</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Grade: {{$workorder->bb_grade}}</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Diameter: {{$workorder->bb_diameter}} mm</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Qty/Coil: {{$workorder->bb_qty_pcs}} Kg / {{$workorder->bb_qty_coil}} Coil</p>
                                </li>
                            </ul>
                            <h5 class="mt-5 text-muted">Finish Good</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <p href="" class="text-secondary"> Size: {{$workorder->fg_size_1}} mm X {{$workorder->fg_size_2}} mm</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Tolerance: {{$workorder->tolerance_minus}} %</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Reduction Rate: {{$workorder->fg_reduction_rate}} %</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Shape: {{$workorder->fg_shape}}</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Qty: {{$workorder->fg_qty}} Pcs</p>
                                </li>
                            </ul>
                            <h5 class="mt-5 text-muted">Others</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <p href="" class="text-secondary"> Status WO: 
                                        {{$workorder->status_wo}}
                                    </p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Machine: {{$workorder->machine->name}}</p>
                                </li>
                                
                            </ul>
                            
                            <div class="mt-5 mb-3">
                                <button id="print-label" class="btn btn-sm btn-primary" 
                                @if ($workorder->status_wo == 'draft')
                                    disabled
                                @endif
                                >Print Label</button>
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
        $.ajax({
            type: "POST",
            dataType: "json", 
            url: "{{route('workorder.getDowntime')}}",
            data: {
                workorder_id:'{{$workorder->id}}}',
                data:'management_time',
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                var salesChartCanvas=document.getElementById('management-chart-canvas').getContext('2d');
                var salesChartData= {
                                labels:[
                                            'Briefing',
                                            'Cek Shot Blast',
                                            'Cek Mesin',
                                            'Sambung Bahan',
                                            'Setting Awal',
                                            'Selesai Satu Bundle',
                                            'Cleaning Area Mesin',
                                            'Istirahat'
                                        ],
                                datasets:[
                                            {
                                                label:'Management Downtimes',
                                                backgroundColor:'rgba(60,141,188,0.9)',
                                                borderColor:'rgba(60,141,188,0.8)',
                                                pointRadius:false,
                                                pointColor:'#3b8bba',
                                                pointStrokeColor:'rgba(60,141,188,1)',
                                                pointHighlightFill:'#fff',
                                                pointHighlightStroke:'rgba(60,141,188,1)',
                                                data: response
                                            },
                                        ]
                            }
                var salesChartOptions=  {
                                            maintainAspectRatio:false,
                                            responsive:true,
                                            legend:{display:false},
                                            scales:{xAxes:[{gridLines:{display:false}}],
                                            yAxes:[{gridLines:{display:false}}]}
                                        }
                var salesChart= new Chart(salesChartCanvas,{type:'bar',data:salesChartData,options:salesChartOptions});
            }
        });

        $.ajax({
            type: "POST",
            dataType: "json", 
            url: "{{route('workorder.getDowntime')}}",
            data: {
                workorder_id:'{{$workorder->id}}}',
                data:'downtime',
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                var salesChartCanvas=document.getElementById('downtime-chart-canvas').getContext('2d');
                var salesChartData= {
                                labels:[
                                            'Bongkar Pasang Dies',
                                            'Tunggu Bahan Baku',
                                            'Ganti Bahan Baku',
                                            'Tunggu Dies',
                                            'Gosok Dies',
                                            'Ganti Part Shot Blast',
                                            'Setting Ulang Kelurusan',
                                            'Ganti Polishing Dies',
                                            'Ganti Nozle Polishing Mesin',
                                            'Ganti Roller Straightener',
                                            'Dies Rusak',
                                            'Mesin Trouble Operator',
                                            'Validasi QC',
                                            'Mesin Trouble Maintenance',
                                        ],
                                datasets:[
                                            {
                                                label:'Downtimes',
                                                backgroundColor:'rgba(60,141,188,0.9)',
                                                borderColor:'rgba(60,141,188,0.8)',
                                                pointRadius:false,
                                                pointColor:'#3b8bba',
                                                pointStrokeColor:'rgba(60,141,188,1)',
                                                pointHighlightFill:'#fff',
                                                pointHighlightStroke:'rgba(60,141,188,1)',
                                                data: response
                                            },
                                        ]
                            }
                var salesChartOptions=  {
                                            maintainAspectRatio:false,
                                            responsive:true,
                                            legend:{display:false},
                                            scales:{xAxes:[{gridLines:{display:false}}],
                                            yAxes:[{gridLines:{display:false}}]}
                                        }
                var salesChart= new Chart(salesChartCanvas,{type:'bar',data:salesChartData,options:salesChartOptions});
            }
        });

        $.ajax({
            type: "POST",
            dataType: "json", 
            url: "{{route('workorder.getOee')}}",
            data: {
                workorder_id:'{{$workorder->id}}',
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                var pieChartCanvas = $('#oee-chart-canvas').get(0).getContext("2d");
                var pieData=    {
                                    labels:['OEE','Waste'],
                                    datasets:[
                                                {
                                                    data:[response[0],100-response[0]],
                                                    // data:[response[0],100-response[0]],
                                                    backgroundColor:['#00a65a','#f56954']
                                                }
                                            ]
                                }
                var pieOptions= {
                                    legend:{display:false},
                                    maintainAspectRatio:false,
                                    responsive:true
                                }
                var pieChart=new Chart(pieChartCanvas,{type:'doughnut',data:pieData,options:pieOptions})
            }
        });

        $('#print-label').on('click',function(){
            event.preventDefault();
            window.open("{{url('/report/'.$workorder->id.'/printToPdf')}}");
        });
    })
</script>
@endpush
