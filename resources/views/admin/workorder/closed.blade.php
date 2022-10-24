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
                            <h3 class="card-title">Closed</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dataClosed" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>WO Number</th>
                                        <th>BB Supplier</th>
                                        <th>BB Grade</th>
                                        <th>BB Diameter</th>
                                        <th>BB Qty</th>
                                        <th>FG Customer</th>
                                        <th>FG Straightness Std</th>
                                        <th>FG Size</th>
                                        <th>FG Tolerance</th>
                                        <th>FG Reduction Rate</th>
                                        <th>FG Shape</th>
                                        <th>FG Kg per bundle</th>
                                        <th>FG Pcs per bundle</th>
                                        {{-- <th>Production Status</th> --}}
                                        <th>Workorder Status</th>
                                        <th>Machine</th>
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
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete" style="display:none">
    </form>
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
      $('#dataClosed').DataTable({
        processing:true,
        serverSide:true,
        ajax:'{{route('admin.workorder.dataclosed')}}',
        columns:[
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
            {data:'machine'},
            {data:'user'},  
            {data:'created_at'},
        ],
        "paging": false,
        "lengthChange": true,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush