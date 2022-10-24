@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('templates.partials.alerts')
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">OEE Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="row">
                                <a href="{{route('admin.production.create')}}" class="btn btn-primary">Add Production Data</a>         
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>WO Number</th>
                                        <th>Dt Briefing</th>
                                        <th>Dt Check Shot Blast</th>
                                        <th>DT Check Mesin</th>
                                        <th>Dt Sambung Bahan</th>
                                        <th>Dt Bongkar Pasang Dies</th>
                                        <th>Dt Setting Awal</th>
                                        <th>Dt Selesai Satu Bundle</th>
                                        <th>Dt Cleaning Area Mesin</th>
                                        <th>Dt Tunggu Bahan Baku</th>
                                        <th>Dt Ganti Bahan Baku</th>
                                        <th>Dt Tunggu Dies</th>
                                        <th>Dt Gosok Dies</th>
                                        <th>Dt Ganti Part Shot Blast</th>
                                        <th>Dt Putus Dies</th>
                                        <th>Dt Setting Ulang Kelurusan</th>
                                        <th>Dt Ganti Polishing Dies</th>
                                        <th>Dt Ganti Nozle Polishing Mesin</th>
                                        <th>Dt Ganti Roller Straightener</th>
                                        <th>Dt Dies Rusak</th>
                                        <th>Dt Mesin Trouble Operator</th>
                                        <th>Dt Validasi QC</th>
                                        <th>Dt Mesin Trouble Maintenance</th>
                                        <th>Dt Istirahat</th>
                                        <th>Total Runtime</th>
                                        <th>Total Downtime</th>
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
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete" style="display:none">
    </form>
@endsection

@push('scripts')
<script>
    $(function () {
      $('#dataTable').DataTable({
        processing:true,
        serverSide:true,
        ajax:'{{route('admin.oee.data')}}',
        columns:[
            {data:'DT_RowIndex',orderable:false, searchable:false},
            {data:'wo_number'},
            {data:'dt_briefing'},
            {data:'dt_cek_shot_blast'},
            {data:'dt_cek_mesin'},
            {data:'dt_sambung_bahan'},
            {data:'dt_bongkar_pasang_dies'},
            {data:'dt_setting_awal'},
            {data:'dt_selesai_satu_bundle'},
            {data:'dt_cleaning_area_mesin'},
            {data:'dt_tunggu_bahan_baku'},
            {data:'dt_ganti_bahan_baku'},
            {data:'dt_tunggu_dies'},
            {data:'dt_gosok_dies'},
            {data:'dt_ganti_part_shot_blast'},
            {data:'dt_putus_dies'},
            {data:'dt_setting_ulang_kelurusan'},
            {data:'dt_ganti_polishing_dies'},
            {data:'dt_ganti_nozle_polishing_mesin'},
            {data:'dt_ganti_roller_straightener'},
            {data:'dt_dies_rusak'},
            {data:'dt_mesin_trouble_operator'},
            {data:'dt_validasi_qc'},
            {data:'dt_mesin_trouble_maintenance'},
            {data:'dt_istirahat'},
            {data:'total_runtime'},
            {data:'total_downtime'},
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush