@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Breaktime</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.breaktime.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">From :</label>
                                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="From" value="{{old('name')}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">To :</label>
                                    <input name="name2" id="name2" type="text" class="form-control @error('name2') is-invalid @enderror" placeholder="To" value="{{old('name2')}}">
                                    @error('name2')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input value="Add" type="submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->  
@endsection

@push('scripts')
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    $(function () {
 
      $('input[id$="name"]').inputmask(
        "hh:mm:ss", {
        placeholder: "HH:MM:SS", 
        insertMode: false, 
        showMaskOnHover: false,
        hourFormat: "24"
      }
      );

	  $('input[id$="name2"]').inputmask(
        "hh:mm:ss", {
        placeholder: "HH:MM:SS", 
        insertMode: false, 
        showMaskOnHover: false,
        hourFormat: "24"
      }
      );

    });   
</script>
@endpush