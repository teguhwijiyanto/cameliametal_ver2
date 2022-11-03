@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('templates.partials.alerts')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">On Process</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="onprocess-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th>Order Number</th> --}}
										<th>Machine</th>
                                        <th>WO Number</th>
                                        <th>BB Supplier</th>
                                        <th>BB Grade</th>
                                        <th>BB Diameter (mm)</th>
                                        <th>BB Qty (Kg / Coil)</th>
                                        <th>FG Customer</th>
                                        <th>FG Straightness Std (mm)</th>
                                        <th>FG Size (mm x mm)</th>
                                        <th>FG Tolerance (mm)</th>
                                        <th>FG Reduction Rate (%)</th>
                                        <th>FG Shape</th>
                                        <th>FG Kg per bundle (Kg)</th>
                                        <th>FG Pcs per bundle (Pcs)</th>
                                        <th>Workorder Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->   
    <form action="" method="POST" id="processForm">
        @csrf
        <input type="submit" value="Process" style="display:none">
    </form>
@endsection
 
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {

        $('#onprocess-table').DataTable({
            processing:true,
            serverSide:true,
            ajax:'{{route('workorder.showOnProcess')}}',
            columns:[
                // {data:'wo_order_num'},
			    {data:'machine'},
                {data:'wo_number'},
                {data:'bb_supplier'},
                {data:'bb_grade'},
                {data:'bb_diameter'},
                {data:'bb_qty_combine'},
                {data:'fg_customer'},
                {data:'straightness_standard'},
                {data:'fg_size_combine'},
                {data:'tolerance'},
                {data:'fg_reduction_rate'},
                {data:'fg_shape'},
                {data:'fg_qty_kg'},
                {data:'fg_qty_pcs'},
                // {data:'status_prod'},
                {data:'status_wo'},
                {data:'user'},  
                {data:'created_at'},
				{data:'action'}
            ],
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
<<<<<<< HEAD
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
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +' '+ data[index].downtime_reason +'</h3>';
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

=======
>>>>>>> e3fe6842971beb80616e77c4b3678eb36515d644
        
    });
</script>
@endpush