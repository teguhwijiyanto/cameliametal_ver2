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
                            <h3 class="card-title">On Check</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="oncheck-table" class="table table-bordered table-hover">
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

        $('#oncheck-table').DataTable({
            processing:true,
            serverSide:true,
            ajax:'{{route('workorder.showOnCheck')}}',
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
        
    });
</script>
@endpush