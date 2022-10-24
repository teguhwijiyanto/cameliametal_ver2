@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Machine</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.machine.update',$machine)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{old('name') ?? $machine->name}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Line</label>
                                    <select name="line_id" class="form-control @error('line_id') is-invalid @enderror">
                                        <option disabled selected value> -- select Line -- </option>
                                        @foreach ($lines as $line)
                                            <option value="{{$line->id}}"
                                                @if ($machine->line_id == $line->id)
                                                    selected
                                                @endif>{{$line->name}}</option>  
                                        @endforeach
                                    </select>
                                    @error('line_id')
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