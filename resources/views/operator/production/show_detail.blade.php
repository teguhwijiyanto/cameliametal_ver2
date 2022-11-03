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
                                    <h5 class="card-title">Performance Report </h5>
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
                                                <span class="float-right" id="performance_id"></span>
                                                <div class="progress progress-sm" id="performance_bar">
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Availability
                                                <span class="float-right" id="availability_id"></span>
                                                <div class="progress progress-sm" id="availability_bar">
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Quality
                                                <span class="float-right" id="quality_id"></span>
                                                <div class="progress progress-sm" id="quality_bar">
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Overall Equipment Effectiveness
                                                <span class="float-right" id="oee_id"></span>
                                                <div class="progress progress-sm" id="oee_bar">
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
                                                <!--
                                                <span class="description-text float-left">Workorder status_wo: {{$workorder->status_wo}}</span>
                                                <br>
												<span class="description-text float-left">Workorder created_at: {{$workorder->created_at}}</span>
                                                <br>
												<span class="description-text float-left">Workorder updated_at: {{$workorder->updated_at}}</span>
                                                <br>
                                                -->

                                                <div class="dropdown-divider"></div>
                                                <a href="#" id="workorder-details" class="descriprion-text">See More</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span id="total_production_id"></span>
                                                <span class="description-text">TOTAL PRODUCTION</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span id="total_downtime_id"></span>
                                                <span class="description-text">TOTAL DOWNTIME</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <span id="total_good_product_id"></span>
                                                <span class="description-text">TOTAL GOOD PRODUCT</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 


            <!-- BAR CHART -->
            <div class="card card-primary card-outline collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Management Downtime Chart</h3>

                    <input type='hidden' id="Management_Briefing">
                    <input type='hidden' id="Management_Check_Shot_Blast">
                    <input type='hidden' id="Management_Cek_Mesin">
                    <input type='hidden' id="Management_Pointing_Roll_Bubble">
                    <input type='hidden' id="Management_Setting_Awal">
                    <input type='hidden' id="Management_Selesai_Satu">
                    <input type='hidden' id="Management_Bersih_bersih_Area">
                    <input type='hidden' id="Management_Preventive_Maintenance">

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="showManagementDowntimeChart();">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



            <!-- BAR CHART -->
            <div class="card card-primary card-outline collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Waste Downtime Chart</h3>

<input type='hidden' id='Waste_Bongkar_Pasang'>
<input type='hidden' id='Waste_Tunggu_Bahan'>
<input type='hidden' id='Waste_Ganti_Bahan'>
<input type='hidden' id='Waste_Tunggu_Dies'>
<input type='hidden' id='Waste_Gosok_Dies'>
<input type='hidden' id='Waste_Ganti_Part_Shot_Blast'>
<input type='hidden' id='Waste_Putus_Dies'>
<input type='hidden' id='Waste_Setting_Ulang'>
<input type='hidden' id='Waste_Ganti_Polishing'>
<input type='hidden' id='Waste_Ganti_Nozzle'>
<input type='hidden' id='Waste_Ganti_Roller'>
<input type='hidden' id='Waste_Dies_Rusak'>
<input type='hidden' id='Waste_Trouble_Mesin'>
<input type='hidden' id='Waste_Validasi_QC'>
<input type='hidden' id='Waste_Mesin_Trouble'>
<input type='hidden' id='Waste_Tambahan_Waktu_Setting'>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="showWasteDowntimeChart();">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

                    {{-- Production Report Column --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline collapsed-card">
                                <div class="card-header">
                                    <div class="col-6">
                                        <h5 class="card-title">Production Report 
										@if (count($smeltingInputList) == 0)
										(<i class="fas fa-check text-success"></i>)
										<input type="hidden" id="is_prod_report_complete" value="1">
										@else
										<input type="hidden" id="is_prod_report_complete" value="0">
										@endif										
										</h5> 
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
                                                        <label for="">Berat Check Good</label>
                                                        <input type="text" name="berat-fg"
                                                            class="form-control @error('berat-fg') is-invalid @enderror"
                                                            placeholder="Berat Check Good"
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
                                <div class="card-header" id="div_str_check">
                                    Click This Button to Check The Workorder Process
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <!--<a href="#" class="btn btn-primary">Check Workorder</a>-->
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




    function showWasteDowntimeChart(){

var Waste_Bongkar_Pasang=document.getElementById("Waste_Bongkar_Pasang").value;  
var Waste_Tunggu_Bahan=document.getElementById("Waste_Tunggu_Bahan").value;  
var Waste_Ganti_Bahan=document.getElementById("Waste_Ganti_Bahan").value;  
var Waste_Tunggu_Dies=document.getElementById("Waste_Tunggu_Dies").value;  
var Waste_Gosok_Dies=document.getElementById("Waste_Gosok_Dies").value;  
var Waste_Ganti_Part_Shot_Blast=document.getElementById("Waste_Ganti_Part_Shot_Blast").value;  
var Waste_Putus_Dies=document.getElementById("Waste_Putus_Dies").value;  
var Waste_Setting_Ulang=document.getElementById("Waste_Setting_Ulang").value;  
var Waste_Ganti_Polishing=document.getElementById("Waste_Ganti_Polishing").value;  
var Waste_Ganti_Nozzle=document.getElementById("Waste_Ganti_Nozzle").value;  
var Waste_Ganti_Roller=document.getElementById("Waste_Ganti_Roller").value;  
var Waste_Dies_Rusak=document.getElementById("Waste_Dies_Rusak").value;  
var Waste_Trouble_Mesin=document.getElementById("Waste_Trouble_Mesin").value;  
var Waste_Validasi_QC=document.getElementById("Waste_Validasi_QC").value;  
var Waste_Mesin_Trouble=document.getElementById("Waste_Mesin_Trouble").value;  
var Waste_Tambahan_Waktu_Setting=document.getElementById("Waste_Tambahan_Waktu_Setting").value;  

    var areaChartData = {
      labels  : ['Bongkar Pasang', 'Tunggu Bahan', 'Ganti Bahan', 'Tunggu Dies', 'Gosok Dies', 'Ganti Part Shot Blast', 'Putus Dies', 'Setting Ulang', 'Ganti Polishing', 'Ganti Nozzle', 'Ganti Roller', 'Dies Rusak', 'Trouble Mesin', 'Validasi QC', 'Mesin Trouble', 'Tambahan Waktu Setting'],
      datasets: [
        {
          label               : 'Waste Downtime',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [Waste_Bongkar_Pasang, Waste_Tunggu_Bahan, Waste_Ganti_Bahan, Waste_Tunggu_Dies, Waste_Gosok_Dies, Waste_Ganti_Part_Shot_Blast, Waste_Putus_Dies, Waste_Setting_Ulang, Waste_Ganti_Polishing, Waste_Ganti_Nozzle, Waste_Ganti_Roller, Waste_Dies_Rusak, Waste_Trouble_Mesin, Waste_Validasi_QC, Waste_Mesin_Trouble, Waste_Tambahan_Waktu_Setting]
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

		    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    //var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets
    barChartData.datasets = temp1
    //barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

	} // function showWasteDowntimeChart(){




    function showManagementDowntimeChart(){

var Management_Briefing=document.getElementById("Management_Briefing").value;  
var Management_Check_Shot_Blast=document.getElementById("Management_Check_Shot_Blast").value;  
var Management_Cek_Mesin=document.getElementById("Management_Cek_Mesin").value;  
var Management_Pointing_Roll_Bubble=document.getElementById("Management_Pointing_Roll_Bubble").value;  
var Management_Setting_Awal=document.getElementById("Management_Setting_Awal").value;  
var Management_Selesai_Satu=document.getElementById("Management_Selesai_Satu").value;  
var Management_Bersih_bersih_Area=document.getElementById("Management_Bersih_bersih_Area").value;  
var Management_Preventive_Maintenance=document.getElementById("Management_Preventive_Maintenance").value;  

    var areaChartData = {
      labels  : ['Briefing', 'Check Shot Blast', 'Cek Mesin', 'Pointing / Roll / Bubble', 'Setting Awal', 'Selesai Satu', 'Bersih-bersih Area', 'Preventive Maintenance'],
      datasets: [
        {
          label               : 'Management Downtime',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [Management_Briefing, Management_Check_Shot_Blast, Management_Cek_Mesin, Management_Pointing_Roll_Bubble, Management_Selesai_Satu, Management_Bersih_bersih_Area, Management_Preventive_Maintenance]
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

		    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    //var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets
    barChartData.datasets = temp1
    //barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

	} // function showManagementDowntimeChart(){




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
			var is_all_remarks_filled = 1;
			var downtime_duration = 0;
			var actual_downtime_duration = 0;

                    var Management_Briefing = 0;
                    var Management_Check_Shot_Blast = 0;
                    var Management_Cek_Mesin = 0;
                    var Management_Pointing_Roll_Bubble = 0;
                    var Management_Setting_Awal = 0;
                    var Management_Selesai_Satu = 0;
                    var Management_Bersih_bersih_Area = 0;
                    var Management_Preventive_Maintenance = 0;

                    var Waste_Bongkar_Pasang = 0;
                    var Waste_Tunggu_Bahan = 0;
                    var Waste_Ganti_Bahan = 0;
                    var Waste_Tunggu_Dies = 0;
                    var Waste_Gosok_Dies = 0;
                    var Waste_Ganti_Part_Shot_Blast = 0;
                    var Waste_Putus_Dies = 0;
                    var Waste_Setting_Ulang = 0;
                    var Waste_Ganti_Polishing = 0;
                    var Waste_Ganti_Nozzle = 0;
                    var Waste_Ganti_Roller = 0;
                    var Waste_Dies_Rusak = 0;
                    var Waste_Trouble_Mesin = 0;
                    var Waste_Validasi_QC = 0;
                    var Waste_Mesin_Trouble = 0;
                    var Waste_Tambahan_Waktu_Setting = 0;

            for (let index = 0; index < data.length; index++) {
                var downtimeNumber = data[index].downtime_number;
                var dt_category_selected = "";
				var dt_category_str = "";

				if(data[index].is_remark_filled==0) {
                    is_all_remarks_filled = 0;
				}

                if(data[index].is_waste_downtime==1) {
                    dt_category_selected = "<option value='management'>Management Downtime</option><option value='waste' selected>Waste Downtime</option>";
					dt_category_str = "Waste Downtime";
                    downtime_duration = downtime_duration + (data[index].end_time - data[index].start_time);
                    actual_downtime_duration = actual_downtime_duration + data[index].duration;

if (data[index].downtime_reason=="Bongkar Pasang"){  Waste_Bongkar_Pasang = Waste_Bongkar_Pasang + data[index].duration; }
if (data[index].downtime_reason=="Tunggu Bahan"){  Waste_Tunggu_Bahan = Waste_Tunggu_Bahan + data[index].duration; }
if (data[index].downtime_reason=="Ganti Bahan"){  Waste_Ganti_Bahan = Waste_Ganti_Bahan + data[index].duration; }
if (data[index].downtime_reason=="Tunggu Dies"){  Waste_Tunggu_Dies = Waste_Tunggu_Dies + data[index].duration; }
if (data[index].downtime_reason=="Gosok Dies"){  Waste_Gosok_Dies = Waste_Gosok_Dies + data[index].duration; }
if (data[index].downtime_reason=="Ganti Part Shot Blast"){  Waste_Ganti_Part_Shot_Blast = Waste_Ganti_Part_Shot_Blast + data[index].duration; }
if (data[index].downtime_reason=="Putus Dies"){  Waste_Putus_Dies = Waste_Putus_Dies + data[index].duration; }
if (data[index].downtime_reason=="Setting Ulang"){  Waste_Setting_Ulang = Waste_Setting_Ulang + data[index].duration; }
if (data[index].downtime_reason=="Ganti Polishing"){  Waste_Ganti_Polishing = Waste_Ganti_Polishing + data[index].duration; }
if (data[index].downtime_reason=="Ganti Nozzle"){  Waste_Ganti_Nozzle = Waste_Ganti_Nozzle + data[index].duration; }
if (data[index].downtime_reason=="Ganti Roller"){  Waste_Ganti_Roller = Waste_Ganti_Roller + data[index].duration; }
if (data[index].downtime_reason=="Dies Rusak"){  Waste_Dies_Rusak = Waste_Dies_Rusak + data[index].duration; }
if (data[index].downtime_reason=="Trouble Mesin"){  Waste_Trouble_Mesin = Waste_Trouble_Mesin + data[index].duration; }
if (data[index].downtime_reason=="Validasi QC"){  Waste_Validasi_QC = Waste_Validasi_QC + data[index].duration; }
if (data[index].downtime_reason=="Mesin Trouble"){  Waste_Mesin_Trouble = Waste_Mesin_Trouble + data[index].duration; }
if (data[index].downtime_reason=="Tambahan_Waktu_Setting"){  Waste_Tambahan_Waktu_Setting = Waste_Tambahan_Waktu_Setting + data[index].duration; }

				}
                if(data[index].is_waste_downtime==0) {
                    dt_category_selected = "<option value='management' selected>Management Downtime</option><option value='waste'>Waste Downtime</option>";
					dt_category_str = "Management Downtime";
                    downtime_duration = downtime_duration + (data[index].end_time - data[index].start_time);

if (data[index].downtime_reason=="Briefing"){  Management_Briefing = Management_Briefing + data[index].duration; }
if (data[index].downtime_reason=="Check Shot Blast"){  Management_Check_Shot_Blast = Management_Check_Shot_Blast + data[index].duration; }
if (data[index].downtime_reason=="Cek Mesin"){  Management_Cek_Mesin = Management_Cek_Mesin + data[index].duration; }
if (data[index].downtime_reason=="Pointing / Roll / Bubble"){  Management_Pointing_Roll_Bubble = Management_Pointing_Roll_Bubble + data[index].duration; }
if (data[index].downtime_reason=="Setting Awal"){  Management_Setting_Awal = Management_Setting_Awal + data[index].duration; }
if (data[index].downtime_reason=="Selesai Satu"){  Management_Selesai_Satu = Management_Selesai_Satu + data[index].duration; }
if (data[index].downtime_reason=="Bersih-bersih Area"){  Management_Bersih_bersih_Area = Management_Bersih_bersih_Area + data[index].duration; }
if (data[index].downtime_reason=="Preventive Maintenance"){  Management_Preventive_Maintenance = Management_Preventive_Maintenance + data[index].duration; }

				}

                var cardOpeningDiv = '<div class="card card-success collapsed-card">';
                var dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +' ('+data[index].duration+') &nbsp; <span><b>['+dt_category_str+']</b> '+data[index].downtime_reason+' <i>('+data[index].remarks+')</i></span></h3>';
                var downtimeListBody = '<div class="card-tools">' +
                                            '<button type="button" class="btn btn-tool"data-card-widget="collapse"><i class="fas fa-plus"></i></button>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="card-body">' +
                                        '<div class="col-12">' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Category</label>' +
                                                '<select onchange="updateReason('+downtimeNumber+')" name="dt-category-' + downtimeNumber + '" class="form-control">' +
                                                    '' + dt_category_selected + '' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Reason</label>' +
                                                '<select name="dt-reason-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="'+data[index].downtime_reason+'" selected>'+data[index].downtime_reason+'</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Remarks</label>' +
                                                '<textarea name="dt-remarks-' + downtimeNumber + '" class="form-control">'+ data[index].remarks +'</textarea>' +
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
				/*
                if(data[index].is_remark_filled == true){
                    cardOpeningDiv = '<div class="card card-success collapsed-card">';
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +' '+ data[index].downtime_reason +'sss</h3>';
                    downtimeListBody = '';
                }
				*/
                downtimeList += cardOpeningDiv +
                                '<div class="card-header">'+
                                    dtTime +
                                    downtimeListBody +
                                '</div>' +
                            '</div>';

            }
            $('#downtime-list').html(downtimeList);
		
		/*
		actual_downtime_duration
WO :
		id
wo_number
		status_wo
			created_at
			updated_at
*/

var status_wo = '{{$workorder->status_wo}}';
var created_at = '{{$workorder->created_at}}';
var updated_at = '{{$workorder->updated_at}}';

var actual_qty_production = '{{$actual_qty_production}}';
var jml_smelting = '{{$jml_smelting}}';
var fg_qty_pcs = '{{$workorder->fg_qty_pcs}}';

var total_good_product = '{{$total_good_product}}';

    var currentdate = new Date(); 
    var now_datetime = "" + currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

var diff = 0;
var planned_runtime = 0;

if(status_wo=="closed") {
    diff = Math.abs(new Date(updated_at) - new Date(created_at));
}
else {
    diff = Math.abs(new Date(now_datetime) - new Date(created_at));
	//diff = Math.abs(new Date(updated_at) - new Date(created_at));
}

    var planned_runtime = Math.floor((diff/1000)/60); // count diff in minutes

    var actual_runtime = Math.abs(planned_runtime - actual_downtime_duration);

var planned_qty_production = jml_smelting*fg_qty_pcs;
var performance_x = actual_qty_production / planned_qty_production * 100;
var performance = (Math.round(performance_x * 100) / 100).toFixed(2);
$('#performance_id').html(performance);
var performance_prcntg = performance * 100;
$('#performance_bar').html("<div class='progress-bar bg-primary' style='font-weight:bold; width: "+performance+"%'></div>");

var availability_x = actual_runtime / planned_runtime * 100;
var availability = (Math.round(availability_x * 100) / 100).toFixed(2);
availability_x = (Math.floor(availability_x)).toFixed(2);
$('#availability_id').html(availability_x);
var availability_prcntg = availability * 100;
$('#availability_bar').html("<div class='progress-bar bg-danger' style='font-weight:bold; width: "+availability_prcntg+"%'></div>");

var quality_x = total_good_product / actual_qty_production * 100;
//var quality = (Math.round(quality_x * 100) / 100).toFixed(2);
var quality = (Math.round(quality_x) / 100).toFixed(2);
$('#quality_id').html(quality_x);
var quality_prcntg = quality * 100;
$('#quality_bar').html("<div class='progress-bar bg-success' style='font-weight:bold; width: "+quality_x+"%'></div>");

var oee_x = performance_x * availability_x * quality_x * 100;
//var oee = (Math.round(oee_x * 100) / 100).toFixed(2);
//var oee = (Math.round(oee_x) / 100).toFixed(2);

var oee = (performance / 100) * (availability_x / 100) * (quality_x / 100) * 100;
//oee = (Math.round(oee)).toFixed(5);
//let text = "Hello world!";
oee = oee.toString();
oee = oee.substr(0, 4);

$('#oee_id').html(oee);
var oee_prcntg = oee;
$('#oee_bar').html("<div class='progress-bar bg-warning' style='font-weight:bold; width: "+oee_prcntg+"%'></div>");
 

$('#total_production_id').html("<h5 class='description-header'><b>"+actual_qty_production+"</b> pcs</h5>");
$('#total_downtime_id').html("<h5 class='description-header'><b>"+actual_downtime_duration+"</b> minutes</h5>");
$('#total_good_product_id').html("<h5 class='description-header'><b>"+total_good_product+"</b> pcs</h5>");




    //alert(performance);



            $('#Management_Briefing').val(Management_Briefing);
            $('#Management_Check_Shot_Blast').val(Management_Check_Shot_Blast);
            $('#Management_Cek_Mesin').val(Management_Cek_Mesin);
            $('#Management_Pointing_Roll_Bubble').val(Management_Pointing_Roll_Bubble);
            $('#Management_Setting_Awal').val(Management_Setting_Awal);
            $('#Management_Selesai_Satu').val(Management_Selesai_Satu);
            $('#Management_Bersih_bersih_Area').val(Management_Bersih_bersih_Area);
            $('#Management_Preventive_Maintenance').val(Management_Preventive_Maintenance);

            $('#Waste_Bongkar_Pasang').val(Waste_Bongkar_Pasang);
            $('#Waste_Tunggu_Bahan').val(Waste_Tunggu_Bahan);
            $('#Waste_Ganti_Bahan').val(Waste_Ganti_Bahan);
            $('#Waste_Tunggu_Dies').val(Waste_Tunggu_Dies);
            $('#Waste_Gosok_Dies').val(Waste_Gosok_Dies);
            $('#Waste_Ganti_Part_Shot_Blast').val(Waste_Ganti_Part_Shot_Blast);
            $('#Waste_Putus_Dies').val(Waste_Putus_Dies);
            $('#Waste_Setting_Ulang').val(Waste_Setting_Ulang);
            $('#Waste_Ganti_Polishing').val(Waste_Ganti_Polishing);
            $('#Waste_Ganti_Nozzle').val(Waste_Ganti_Nozzle);
            $('#Waste_Ganti_Roller').val(Waste_Ganti_Roller);
            $('#Waste_Dies_Rusak').val(Waste_Dies_Rusak);
            $('#Waste_Trouble_Mesin').val(Waste_Trouble_Mesin);
            $('#Waste_Validasi_QC').val(Waste_Validasi_QC);
            $('#Waste_Mesin_Trouble').val(Waste_Mesin_Trouble);
            $('#Waste_Tambahan_Waktu_Setting').val(Waste_Tambahan_Waktu_Setting);

            var is_prod_report_complete = $('#is_prod_report_complete').val();
			if(is_prod_report_complete==0 && is_all_remarks_filled==0) {
				$('#div_str_check').html("<div style='color:red;'><b>Please fill all Production Report (per Bundle) AND all Downtime Report!!</b></div>");
				$('#check').prop('disabled', true);
			}
			if(is_prod_report_complete==0 && is_all_remarks_filled==1) {
				$('#div_str_check').html("<div style='color:red;'><b>Please fill all Production Report (per Bundle)!!</b></div>");
				$('#check').prop('disabled', true);
			}
			if(is_prod_report_complete==1 && is_all_remarks_filled==0) {
				$('#div_str_check').html("<div style='color:red;'><b>Please fill all Downtime Report!!</b></div>");
				$('#check').prop('disabled', true);
			}
			if(is_prod_report_complete==1 && is_all_remarks_filled==1) {
				$('#div_str_check').html("Click This Button to Check The Workorder Process");
				$('#check').prop('disabled', false);
			}

/*
var diff = Math.abs(new Date(data[index].end_time) - new Date(data[index].start_time));
var minutes = Math.floor((diff/1000)/60);
*/

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
                    '<option value="Briefing">Briefing</option>' +
                    '<option value="Check Shot Blast">Cek Shot Blast</option>' +
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
                    title: '<strong>'+response.bundle_num+' - </strong> &nbsp; [<a href="http://localhost:8000/report/'+response.id+'/printToPdf" target="_blank">Print to PDF</a>]',
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
