@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Supplier</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.supplier.update',$supplier)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{old('name') ?? $supplier->name}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Grade</label>
                                    <input name="grade" type="text" class="form-control @error('grade') is-invalid @enderror" placeholder="Grade" value="{{old('grade') ?? $supplier->grade}}">
                                    @error('email')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Diameter</label>
                                    <input name="diameter" type="text" class="form-control @error('diameter') is-invalid @enderror" placeholder="Diameter" value="{{old('diameter') ?? $supplier->diameter}}">
                                    @error('diameter')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <input name="qty_kg" type="text" class="form-control @error('qty_kg') is-invalid @enderror" placeholder="(Bahan Baku) Qty in Kg" value="{{old('qty_kg') ?? $supplier->qty_kg}}">
                                            @error('qty_kg')
                                                <span class="text-danger help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-1">
                                            <label for="">Kg</label>
                                        </div>
                                        <div class="col-5">
                                            <input name="qty_coil" type="text" class="form-control @error('qty_coil') is-invalid @enderror" placeholder="(Bahan Baku) Qty in Coil" value="{{old('qty_coil') ?? $supplier->qty_coil}}">
                                            @error('qty_coil')
                                                <span class="text-danger help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-1">
                                            <label for="">Coil</label>
                                        </div>
                                    </div>
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