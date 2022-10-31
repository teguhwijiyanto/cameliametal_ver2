@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Account</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.user.update',$user)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" value="{{old('name') ?? $user->name}}">
                                    @error('name')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Employee Id</label>
                                    <input name="employeeId" type="text" class="form-control @error('employeeId') is-invalid @enderror" placeholder="email" value="{{old('employeeId') ?? $user->employeeId}}">
                                    @error('employeeId')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" value="{{old('role')}}">
                                        <option disabled selected value> -- select role -- </option>
                                        <option value="super-admin"
                                        @if ($role == 'super-admin')
                                            selected
                                        @endif>Super Admin</option>
                                        <option value="office-admin"
                                        @if ($role == 'office-admin')
                                            selected
                                        @endif>Office Admin</option>  
                                        <option value="operator"
                                        @if ($role == 'operator')
                                            selected
                                        @endif>Operator</option>
										<option value="supervisor"
                                        @if ($role == 'supervisor')
                                            selected
                                        @endif>Supervisor</option>
										<option value="warehouse"
                                        @if ($role == 'warehouse')
                                            selected
                                        @endif>Warehouse</option>
                                    </select>
                                    @error('role')
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