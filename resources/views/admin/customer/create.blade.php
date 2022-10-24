@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Customer</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.customer.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Size</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <input name="size_1" type="text" class="form-control @error('size_1') is-invalid @enderror" placeholder="Size 1" value="{{old('size_1')}}">
                                            @error('size_1')
                                                <span class="text-danger help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-1">
                                            <label for="">mm</label>
                                        </div>
                                        <div class="col-5">
                                            <input name="size_2" type="text" class="form-control @error('size_2') is-invalid @enderror" placeholder="Size 2" value="{{old('size_2')}}">
                                            @error('size_2')
                                                <span class="text-danger help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-1">
                                            <label for="">mm</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Shape</label>
                                    <select name="shape" class="form-control @error('shape') is-invalid @enderror">
                                        <option disabled selected value> -- select an option -- </option>
                                        <option id="shape-round" value="Round"
                                        @if (old('shape') == 'Round')
                                            selected                                            
                                        @endif>Round</option>
                                        <option id="shape-square" value="Square"
                                        @if (old('shape') == 'Square')
                                            selected                                            
                                        @endif>Square</option>  
                                        <option id="shape-hexagon" value="Hexagon"
                                        @if (old('shape') == 'Hexagon')
                                            selected                                            
                                        @endif>Hexagon</option>  
                                    </select>
                                    @error('shape')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Standar Kelurusan</label>
                                    <input name="straightness_standard" type="text" class="form-control @error('straightness_standard') is-invalid @enderror" placeholder="Straightness Standard" value="{{old('straightness_standard')}}">
                                    @error('straightness_standard')
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