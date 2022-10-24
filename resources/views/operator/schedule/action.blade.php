<button href="{{url('/operator/schedule/'.$model->id.'/process')}}" class="btn btn-success" id="process">Process</button>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 $('button#process').on('click', function(e){
     e.preventDefault();
     var href = $(this).attr('href');
     Swal.fire({
        title: 'Are you sure want to process this workorder?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, process it!'
        }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('processForm').action=href;
            document.getElementById('processForm').submit();
        }
    })
     
 });
</script>