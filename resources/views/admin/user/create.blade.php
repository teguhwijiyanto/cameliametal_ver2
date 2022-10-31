@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Account</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.user.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Employee Id</label>
                                    <input name="employeeId" type="text" class="form-control @error('employeeId') is-invalid @enderror" placeholder="Employee Id" value="{{old('employeeId')}}">
                                    @error('employeeId')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" value="{{old('role')}}">
                                        <option disabled selected value> -- select role -- </option>
                                        <option value="super-admin">Super Admin</option>
                                        <option value="office-admin">Office Admin</option>  
                                        <option value="operator">Operator</option>
										<option value="supervisor">Supervisor</option>  
                                        <option value="warehouse">Warehouse</option>
                                    </select>
                                    @error('role')
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