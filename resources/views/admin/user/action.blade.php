<a href="{{route('admin.user.edit',$model)}}" class="btn btn-warning">Edit</a>
<button dusk="delete_{{$model->id}}" href="{{route('admin.user.destroy',$model)}}" class="btn btn-danger" id="delete">Delete</button>
<button dusk="reset_{{$model->id}}" href="{{route('admin.user.reset.password')}}" class="btn btn-success" id="reset-password">Reset Password</button>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 $('button#delete').on('click', function(e){
     e.preventDefault();
     var href = $(this).attr('href');
     Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').action=href;
            document.getElementById('deleteForm').submit();
            
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
    })
 });
 $('button#reset-password').on('click', function(e){
     e.preventDefault();
     var href = $(this).attr('href');
     Swal.fire({
        title: 'Are you sure?',
        text: "This user password will be default(12345678), You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('resetPasswordForm').action=href;
            document.getElementById('resetPasswordForm').submit();
            
            Swal.fire(
            'Updated!',
            'Password has been reset',
            'success'
            )
        }
    })
 });
</script>