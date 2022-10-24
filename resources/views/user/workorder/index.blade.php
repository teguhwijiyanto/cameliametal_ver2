@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Workorder Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="search-form" class="" role="form">
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
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label style="padding-right: 10px ">Workorder Number : </label>
                                            <input name="wo_number" type="text" class="form-control @error('wo_number') is-invalid @enderror" value="{{old('wo_number')}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <button style="padding-left: 10px; padding-right: 10px" type="submit" class="btn btn-primary">Search</button>
                                    <button id="clear-button" style="margin-left: 10px; padding-left: 10px; padding-right: 10px" class="btn btn-danger">Clear Search</button>    
                                </div>
                            </form>
                            <br><br>
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>WO Number</th>
                                        <th>Total Runtime (min)</th>
                                        <th>Total Downtime (min)</th>
                                        <th>Total Production (Pcs)</th>
                                        {{-- <th>Status Production</th> --}}
                                        <th>Status WO</th>
                                        <th>Created At</th>
                                        <th>Action</th>
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
@endsection

@push('scripts')
<script>
    $(function () {
        $('#reservationdatetime1').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });
        $('#reservationdatetime2').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });
    
        var oTable = $('#dataTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:
            {
                method: 'GET',
                url:'{{route('workorder.ajaxRequestAll')}}',
                data: function (d) {
                    d.report_date_1 = $('input[name=report_date_1]').val();
                    d.report_date_2 = $('input[name=report_date_2]').val();
                    d.wo_number     = $('input[name=wo_number]').val();
                },
            },
            columns:[
                {data:'DT_RowIndex',orderable:false, searchable:false},
                {data:'wo_number'},
                {data:'total_runtime'},
                {data:'total_downtime'},
                {data:'total_production'},
                // {data:'status_prod'},
                {data:'status_wo'},
                {data:'created_at'},
                {data:'action'}
            ],
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            oTable.draw();
        });

        $('#clear-button').on('click', function(e) {
            e.preventDefault();
            $('input[name=report_date_1]').val('');
            $('input[name=report_date_2]').val('');
            $('input[name=wo_number]').val('');
            $('#search-form').submit();
        });
    });

    
</script>
@endpush