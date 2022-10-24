@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    {{-- Production Report --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Performance Report</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Current Speed Performance</strong>
                                            </p>
                                            <div class="chart">
                                                <canvas id="speedChart" height="180"
                                                    style="height: 180px;"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Performance Indicator</strong>
                                            </p>
                                            <div class="progress-group">
                                                Performance
                                                <span class="float-right"><b>160</b>/200</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Availability
                                                <span class="float-right"><b>310</b>/400</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Quality
                                                <span class="float-right"><b>480</b>/800</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Overall Equipment Effectiveness
                                                <span class="float-right"><b>250</b>/500</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-text float-left">Workorder: {{$workorder->wo_number}}</span>
                                                <br>
                                                <span class="description-text float-left">Machine: {{$workorder->machine->name}}</span>
                                                <br>    
                                                <div class="dropdown-divider"></div>
                                                <a href="#" id="workorder-details" class="descriprion-text">See More</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{$reports['production_count']}} pcs</h5>
                                                <span class="description-text">TOTAL PRODUCTION</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{$reports['total_downtime']}} minutes</h5>
                                                <span class="description-text">TOTAL DOWNTIME</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <h5 class="description-header">1200</h5>
                                                <span class="description-text">TOTAL GOOD PRODUCT</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    {{-- Production Report Column --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline collapsed-card">
                                <div class="card-header">
                                    <div class="col-6">
                                        <h5 class="card-title">Production Report (<i class="fas fa-check text-success"></i>)</h5> 
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body box-profile">
                                    <label for="">Report per Bundle</label>
                                    <ul class="nav nav-pills">
                                        @foreach ($smeltings as $smelt)
                                            <li class="nav-item">
                                                <a class="btn btn-transparent smelting-number 
                                                    @foreach ($productions as $prod)
                                                        @if($smelt->bundle_num != $prod->bundle_num)
                                                            @continue
                                                        @endif
                                                        bg-primary
                                                    @endforeach
                                                    "
                                                    href="#" style="margin:1px;"
                                                    id="{{ $smelt->bundle_num }}"
                                                    data-toggle="tab">{{ $smelt->bundle_num }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    @if (count($smeltingInputList) == 0)
                                        <div class="alert alert-success text-center" role="alert">
                                            All Data Already Input
                                        </div>
                                    @else
                                        <form id="production-report" action="" method="post">
                                            @csrf
                                            <label id="smelting-num">
                                                No. Leburan:
                                            </label>
                                            <div class="dropdown-divider"></div>
                                            <div class="row">
                                                <input hidden name="workorder_id" type="text"
                                                class="form-control @error('workorder_id') is-invalid @enderror"
                                                placeholder="No. Leburan"
                                                value="{{ $workorder->id ?? old('workorder_id') }}">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Bundle Number</label>
                                                        <select name="bundle-num"
                                                            class="form-control @error('bundle-num') is-invalid @enderror">
                                                            <option value="">-- Select Bundle Number --</option>
                                                            @foreach ($smeltingInputList as $smelt)
                                                                <option value="{{ $smelt }}">{{ $smelt }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Dies Number</label>
                                                        <input type="text" name="dies-number"
                                                            class="form-control @error('dies-number') is-invalid @enderror"
                                                            placeholder="Dies Number" value="{{ old('dies-number') }}">
                                                        @error('dies-number')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Ujung</label>
                                                        <input type="text" name="diameter-ujung"
                                                            class="form-control @error('diameter-ujung') is-invalid @enderror"
                                                            placeholder="Diameter Ujung"
                                                            value="{{ old('diameter-ujung') }}">
                                                        @error('diameter-ujung')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Tengah</label>
                                                        <input type="text" name="diameter-tengah"
                                                            class="form-control @error('diameter-tengah') is-invalid @enderror"
                                                            placeholder="Diameter Tengah"
                                                            value="{{ old('diameter-tengah') }}">
                                                        @error('diameter-tengah')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Ekor</label>
                                                        <input type="text" name="diameter-ekor"
                                                            class="form-control @error('diameter-ekor') is-invalid @enderror"
                                                            placeholder="Diameter Ekor"
                                                            value="{{ old('diameter-ekor') }}">
                                                        @error('diameter-ekor')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Kelurusan Aktual</label>
                                                        <input type="text" name="kelurusan-aktual"
                                                            class="form-control @error('kelurusan-aktual') is-invalid @enderror"
                                                            placeholder="Kelurusan Aktual"
                                                            value="{{ old('kelurusan-aktual') }}">
                                                        @error('kelurusan-aktual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Panjang Aktual</label>
                                                        <input type="text" name="panjang-aktual"
                                                            class="form-control @error('panjang-aktual') is-invalid @enderror"
                                                            placeholder="Panjang Aktual"
                                                            value="{{ old('panjang-aktual') }}">
                                                        @error('panjang-aktual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Berat Finish Good</label>
                                                        <input type="text" name="berat-fg"
                                                            class="form-control @error('berat-fg') is-invalid @enderror"
                                                            placeholder="Berat Finish Good"
                                                            value="{{ old('berat-fg') }}">
                                                        @error('berat-fg')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Pcs per Bundle</label>
                                                        <input type="text" name="pcs-per-bundle"
                                                            class="form-control @error('pcs-per-bundle') is-invalid @enderror"
                                                            placeholder="Pcs Per Bundle"
                                                            value="{{ old('pcs-per-bundle') }}">
                                                        @error('pcs-per-bundle')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Bundle Judgement</label>
                                                        <select name="bundle-judgement" id=""
                                                            class="form-control @error('bundle-judgement') is-invalid @enderror">
                                                            <option value="">-- Select Judgement --</option>
                                                            <option value="1">Good</option>
                                                            <option value="0">Not Good</option>
                                                        </select>
                                                        @error('bundle-judgement')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Visual</label>
                                                        <select name="visual" id=""
                                                            class="form-control @error('visual') is-invalid @enderror">
                                                            <option value="">-- Select Judgement --</option>
                                                            <option value="1">Good</option>
                                                            <option value="0">Not Good</option>
                                                        </select>
                                                        @error('visual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <button class="form-control btn btn-primary"
                                                                    style="margin-left:200px;">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Downtime Report --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card direct-chat card-primary card-outline direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Downtime Report</h3>
                                    <div class="card-tools">
                                        <span id="downtime-list-count" class="badge badge-danger"></span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages"  style="height: 500px;">
                                        <div class="direct-chat-msg">
                                            <div class="col-12" id="downtime-list">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    Click This Button to Check The Workorder Process
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <!--<a href="#" class="btn btn-primary">Finish Workorder</a>-->
			<form action="" method="POST" id="processForm">
				@csrf
				<input type="submit" value="Process" style="display:none">
				<button href="{{url('/operator/schedule/'.$workorder->id.'/check')}}" class="btn btn-success" id="check">Check Workorder</button>
			</form>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        updateDowntimeList();
        updateSpeedChart();
    });

    let aChannel = Echo.channel('channel-downtime');
    aChannel.listen('DowntimeCaptured', function(data)
    {
        if (data.downtime.status == 'stop') {
            Swal.fire({
                icon: 'info',
                title: 'Downtime Captured',
                showConfirmButton: false,
                timer: 3000
            });
        }
        updateDowntimeList();
    });

    let productionChannel = Echo.channel('channel-production-graph');
    productionChannel.listen('productionGraph',function(data){
        updateSpeedChart();
    });


	 $('button#check').on('click', function(e){
	     e.preventDefault();
	     var href = $(this).attr('href');
	     Swal.fire({
		title: 'Are you sure want to check this workorder?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, check it!'
		}).then((result) => {
		if (result.isConfirmed) {
		    document.getElementById('processForm').action=href;
		    document.getElementById('processForm').submit();
		}
	    })
	 });
	
    function updateSpeedChart(){
        $('.speed-chart').show();
        $.ajax({
            method:'GET',
            url:'{{route('realtime.ajaxRequestAll')}}',
            dataType:'json',
            success:function(response){
                var areaChartCanvas = $('#speedChart').get(0).getContext('2d');

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
    }

    function updateDowntimeList()
    {
      $.ajax({
          url:'{{route('downtime.updateDowntime')}}',
          type:'POST',
          dataType: 'json',
          data:{
            workorder_id: '{{$workorder->id}}',
            _token: '{{csrf_token()}}',
          },
          success:function(response){
            $('#downtime-list-count').html(response.data.length);
            var data = response.data;
            var downtimeList = '';
            for (let index = 0; index < data.length; index++) {
                var downtimeNumber = data[index].downtime_number;
                var cardOpeningDiv = '<div class="card card-warning collapsed-card">';
                var dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +'</h3>';
                var downtimeListBody = '<div class="card-tools">' +
                                            '<button type="button" class="btn btn-tool"data-card-widget="collapse"><i class="fas fa-plus"></i></button>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="card-body">' +
                                        '<div class="col-12">' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Category</label>' +
                                                '<select onchange="updateReason('+downtimeNumber+')" name="dt-category-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled selected>-- Select Downtime Category --</option>' +
                                                    '<option value="management">Management Downtime</option>' +
                                                    '<option value="waste">Waste Downtime</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Reason</label>' +
                                                '<select name="dt-reason-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled selected>-- Select Reason --</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Remarks</label>' +
                                                '<textarea name="dt-remarks-' + downtimeNumber + '" class="form-control"></textarea>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<div class="row">' +
                                                    '<div class="col-1">' +
                                                        '<button class="btn btn-primary" onClick="storeDowntimeReason(' + downtimeNumber + ')">Apply</button>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' ;
                if(data[index].end_time == null){
                    cardOpeningDiv = '<div class="card card-danger collapsed-card">';
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - Now</h3>';
                    downtimeListBody = '';
                }
                if(data[index].is_remark_filled == true){
                    cardOpeningDiv = '<div class="card card-success collapsed-card">';
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +' '+ data[index].downtime_reason +'ooo</h3>';
                    downtimeListBody = '';
                }
                downtimeList += cardOpeningDiv +
                                '<div class="card-header">'+
                                    dtTime +
                                    downtimeListBody +
                                '</div>' +
                            '</div>';
            }
            $('#downtime-list').html(downtimeList);
          }
        });
    };

    function storeDowntimeReason(downtime_number)
    {
        var downtimeCategory = $('select[name="dt-category-'+downtime_number+'"]').val();
        var downtimeReason = $('select[name="dt-reason-'+downtime_number+'"]').val();
        var downtimeRemarks = $('textarea[name="dt-remarks-'+downtime_number+'"]').val();
        $.ajax({
            url:'{{route('downtimeRemark.submit')}}',
            type:'POST',
            dataType:'json',
            data:{
                _token: '{{csrf_token()}}', 
                downtimeNumber: downtime_number,
                downtimeCategory: downtimeCategory,
                downtimeReason: downtimeReason,
                downtimeRemarks: downtimeRemarks,
            },
            success:function(response){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Success',
                    text: 'Data Updated Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });
                location.reload();
            },
            error:function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Data Uncomplete',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })
    };

    function updateReason(downtime_number)
    {
        var downtimeCategory = $('[name="dt-category-'+downtime_number+'"]').val();
            if (downtimeCategory == 'management') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled selected>-- Select Reason --</option>' +
                    '<option value="briefing">Briefing</option>' +
                    '<option value="check Shot Blast">Cek Shot Blast</option>' +
                    '<option value="Cek Mesin">Cek Mesin</option>' +
                    '<option value="Pointing / Roll / Bubble">Pointing / Roll / Bubble</option>' +
                    '<option value="Setting Awal">Setting Awal</option>' +
                    '<option value="Selesai Satu">Selesai Satu</option>' +
                    '<option value="Bersih-bersih Area">Bersih-bersih Area</option>' +
                    '<option value="Preventive Maintenance">Preventive Maintenance</option>'
                )
            }
            if (downtimeCategory == 'waste') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled selected>-- Select Reason --</option>' +
                    '<option value="Bongkar Pasang">Bongkar Pasang</option>' +
                    '<option value="Tunggu Bahan">Tunggu Bahan</option>' +
                    '<option value="Ganti Bahan">Ganti Bahan</option>' +
                    '<option value="Tunggu Dies">Tunggu Dies</option>' +
                    '<option value="Gosok Dies">Gosok Dies</option>' +
                    '<option value="Ganti Part Shot Blast">Ganti Part Shot Blast</option>' +
                    '<option value="Putus Dies">Putus Dies</option>' +
                    '<option value="Setting Ulang">Setting Ulang</option>' +
                    '<option value="Ganti Polishing">Ganti Polishing</option>' +
                    '<option value="Ganti Nozzle">Ganti Nozzle</option>' +
                    '<option value="Ganti Roller">Ganti Roller</option>' +
                    '<option value="Dies Rusak">Dies Rusak</option>' +
                    '<option value="Trouble Mesin">Trouble Mesin</option>' +
                    '<option value="Validasi QC">Validasi QC</option>' +
                    '<option value="Mesin Trouble">Mesin Trouble</option>' +
                    '<option value="Tambahan Waktu Setting">Tambahan Waktu Setting</option>'
                )
            }
    };

    function storeData(data)
    {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ route('production.store') }}',
            data: {
                workorder_id: data.workorder_id,
                bundle_num: data.bundle_num,
                dies_num: data.dies_num,
                diameter_ujung: data.diameter_ujung,
                diameter_tengah: data.diameter_tengah,
                diameter_ekor: data.diameter_ekor,
                kelurusan_aktual: data.kelurusan_aktual,
                panjang_aktual: data.panjang_aktual,
                berat_fg: data.berat_fg,
                pcs_per_bundle: data.pcs_per_bundle,
                bundle_judgement: data.bundle_judgement,
                visual: data.visual,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Production report data has been submitted',
                    showConfirmButton: false,
                    timer: 2000
                });
                location.reload();
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Went Wrong',
                    html: '<b class="text-danger">' + JSON.parse(response.responseText)
                        .message + '</b> <br><br> <B>detail</b>: ' + response
                        .responseText,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    };

    $('#workorder-details').on('click',function()
    {
        Swal.fire({
            title: '<strong>{{$workorder->wo_number}}</strong>',
            html:
            '<div class="row">' +
                '<div class="col-4">' +
                    '<div class="row">' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">Created By</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Supplier</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Grade</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Diameter</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">QTY/Coil</label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">{{$createdBy->name}}</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->bb_supplier}}</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->bb_grade}}</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->bb_diameter}} mm</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->bb_qty_pcs}} pcs/ {{$workorder->bb_qty_coil}} pcs</label>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-4">' +
                    '<div class="row">' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">Size</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Tolerance</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Reduction Rate</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Shape</label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->fg_size_1}} mm X {{$workorder->fg_size_2}} mm</label>' + 
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->tolerance_minus}} %</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->fg_reduction_rate}} %</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->fg_shape}}</label>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-4">' +
                    '<div class="row">' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">Status</label>' +
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">Machine</label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-6">' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->status_wo}}</label>' + 
                            '</div>' +
                            '<div class="row">' +
                                '<label class="float-left">{{$workorder->machine->name}}</label>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>',
            width: '1200px',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:'Close',
            confirmButtonAriaLabel: 'Thumbs up, great!',
        });
    });

    $('#print-label').on('click', function()
    {
        event.preventDefault();
        window.open("{{ url('/report/' . $workorder->id . '/printToPdf') }}");
    });

    $("[name='bundle-num']").on('change', function(event)
    {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ route('production.getSmeltingNum') }}',
            data: {
                workorder_id: '{{ $workorder->id }}',
                bundle_num: $("[name='bundle-num']").val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#smelting-num").html('No. Leburan: ' + response);
            }
        })
    });

    $('#production-report').on('submit', function(event)
    {
        event.preventDefault();
        var bundle_num = $("[name='bundle-num']").val();
        var workorder_id = $("[name='workorder_id']").val();
        var dies_number = $("[name='dies-number']").val();
        var diameter_ujung = $("[name='diameter-ujung']").val();
        var diameter_tengah = $("[name='diameter-tengah']").val();
        var diameter_ekor = $("[name='diameter-ekor']").val();
        var kelurusan_aktual = $("[name='kelurusan-aktual']").val();
        var panjang_aktual = $("[name='panjang-aktual']").val();
        var berat_fg = $("[name='berat-fg']").val();
        var pcs_per_bundle = $("[name='pcs-per-bundle']").val();
        var bundle_judgement = $("[name='bundle-judgement']").val();
        var visual = $("[name='visual']").val();
        var data = {
            bundle_num: bundle_num,
            workorder_id: workorder_id,
            dies_num: dies_number,
            diameter_ujung: diameter_ujung,
            diameter_tengah: diameter_tengah,
            diameter_ekor: diameter_ekor,
            kelurusan_aktual: kelurusan_aktual,
            panjang_aktual: panjang_aktual,
            berat_fg: berat_fg,
            pcs_per_bundle: pcs_per_bundle,
            bundle_judgement: bundle_judgement,
            visual: visual
        };
        storeData(data);
    });

    $('a.smelting-number').on('click',function(event)
    {
        $.ajax({
            url:'{{route('production.getProductionInfo')}}',
            type:'POST',
            dataType:'json',
            data:{
                smelting_number:event.currentTarget.id,
                workorder_id:'{{$workorder->id}}',
                _token:'{{csrf_token()}}'
            },
            success:function(response){
                var bundle_judgement = 'Not Good';
                if(response.bundle_judgement==1){bundle_judgement='Good'}
                var visual = 'Not Good';
                if(response.visual==1){'Good'}
                Swal.fire({
                    title: '<strong>'+response.bundle_num+'</strong>',
                    html:
                    '<div class="row">' +
                        '<div class="col-1">' +
                        '</div>' +
                        '<div class="col-5">' +
                            '<div class="row">' +
                                '<div class="col-6">' +
                                    '<div class="row">' +
                                        '<label class="float-left">Dies Number</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Diameter Ujung</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Diameter Tengah</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Diameter Ekor</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Kelurusan Aktual</label>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-6">' +
                                    '<div class="row">' +
                                        '<label class="float-left">' + response.dies_num + '</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">' + response.diameter_ujung + ' mm</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">' + response.diameter_tengah + ' mm</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">' + response.diameter_ekor + ' mm</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">' + response.kelurusan_aktual + ' mm</label>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-5">' +
                            '<div class="row">' +
                                '<div class="col-6">' +
                                    '<div class="row">' +
                                        '<label class="float-left">Berat FG</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Pcs Per Bundle</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Bundle Judgement</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">Visual</label>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-6">' +
                                    '<div class="row">' +
                                        '<label class="float-left">'+ response.berat_fg +' mm</label>' + 
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">'+ response.pcs_per_bundle +'</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">'+ bundle_judgement +'</label>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<label class="float-left">'+ visual +'</label>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-1">' +
                        '</div>' +
                    '</div>',
                    width: '1000px',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:'OK',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                });
            },
        });

        
    });
</script>
@endpush