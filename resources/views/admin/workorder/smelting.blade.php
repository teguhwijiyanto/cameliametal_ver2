<a href="{{route('admin.smelting.create',['id'=>$model])}}" class="btn btn-primary">Data Leburan</a>

<div class="card card-body">
    <table class="table-bordered table-hover">
        <thead>
            <tr>
                <th>No. Bundle</th>
                <th>Berat</th>
                <th>No. Leburan</th>
            </tr>
        </thead>
        <tbody id="smelts-table-{{$model->id}}">
        </tbody>
    </table>
</div>

<script>
    // $('#smelts-table-{{$model->id}}').DataTable().clear().destroy();
    $.ajax({
        type: "GET",
        dataType: "json", 
        url: '{{route('admin.smelting.data_wo')}}',
        data: {
            wo_id:'{{$model->id}}',
        },
        success: function(data) {
            var content = '';
            for(let i = 0; i < data.length; i++){
                content += '<tr><td>' + data[i].bundle_num + '</td><td>' + data[i].weight + '</td><td>' + data[i].smelting_num + '</td></tr>';
            }
            $('tbody#smelts-table-{{$model->id}}').html(content);
        }
    });
</script>
