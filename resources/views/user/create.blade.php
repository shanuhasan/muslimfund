@extends('layouts.app')

@section('title', 'Add User')
@section('user', 'active')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('user') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.store') }}" id="userForm" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid	@enderror" id="name"
                                                placeholder="Enter Name">
                                            @error('name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control  @error('phone') is-invalid	@enderror"
                                                id="phone" name="phone" placeholder="Enter Phone">
                                            @error('phone')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Role</label>
                                            <select class="form-control select2" name="role_id" style="width: 100%;">
                                                <option>Select</option>
                                                @foreach (roles() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email"
                                                class="form-control  @error('email') is-invalid	@enderror"
                                                id="exampleInputEmail1" placeholder="Enter email">
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid	@enderror"
                                                id="exampleInputPassword1" placeholder="Password">
                                            @error('password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select class="form-control select2" name="status" style="width: 100%;">
                                                @foreach (status() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        
    </script>
@endsection
