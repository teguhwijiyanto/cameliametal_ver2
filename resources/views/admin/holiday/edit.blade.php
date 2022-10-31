@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Holiday</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.holiday.update',$holiday)}}" method="POST">
                                @csrf
                                @method("PUT")
								<!--
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{old('name') ?? $holiday->name}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                -->
                                <div class="form-group">
                                        <div class="input-group date" id="name" data-target-input="nearest">
                                            <label style="padding-right: 10px ">Date :</label>
                                            <input name="name" type="text" class="form-control datetimepicker-input @error('name') is-invalid @enderror" data-target="#name" value="{{old('name') ?? $holiday->name}}" readonly  onkeyup="this.value=''+this.value+'';"/>
                                            <div class="input-group-append" data-target="#name" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
										@error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input value="Edit" type="submit" class="btn btn-primary">
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
<script>
    $(function () {
        $('#name').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });
    });   
</script>
@endpush