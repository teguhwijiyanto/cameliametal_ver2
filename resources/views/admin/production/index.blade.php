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
                            <h3 class="card-title">Production Data</h3>
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
                                        <th>Bundle Number</th>
                                        <th>No. Leburan</th>
                                        <th>Dies Number</th>
                                        {{-- <th>Area</th> --}}
                                        <th>Diameter Ujung</th>
                                        <th>Diameter Tengah</th>
                                        <th>Diameter Ekor</th>
                                        <th>Kelurusan Aktual</th>
                                        <th>Panjang Aktual</th>
                                        <th>Berat FG</th>
                                        <th>Pcs Per Bundle</th>
                                        <th>Bundle Judgement</th>
                                        <th>Visual</th>
                                        <th>Created At</th>
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
        ajax:'{{route('admin.production.data')}}',
        columns:[
            {data:'DT_RowIndex',orderable:false, searchable:false},
            {data:'wo_number'},
            {data:'bundle_num'},
            {data:'smelting_num'},
            {data:'dies_num'},
            // {data:'area'},
            {data:'diameter_ujung'},
            {data:'diameter_tengah'},
            {data:'diameter_ekor'},
            {data:'kelurusan_aktual'},
            {data:'panjang_aktual'},
            {data:'berat_fg'},
            {data:'pcs_per_bundle'},
            {data:'bundle_judgement'},
            {data:'visual'},
            {data:'created_at'},
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