@extends('layouts.app')

@section('title', 'Bank Account')
@section('account', 'active')

@php
    $account = App\Models\Account::accountDetail($user->id);
@endphp
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bank Account</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('account') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-3">
                                        <label for="name">Photo</label>
                                        @if (!empty($user->photo_media_id))
                                            <div>
                                                <img src="{{ asset('media/' . App\Models\Media::getImage($user->photo_media_id)) }}"
                                                    alt=""
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-3">
                                        <label for="name">Signature</label>
                                        @if (!empty($user->signature_media_id))
                                            <div>
                                                <img src="{{ asset('media/' . App\Models\Media::getImage($user->signature_media_id)) }}"
                                                    alt=""
                                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <h3>Name:- <strong> {{ $user->name }}</strong></h3><br>
                            <h3>Account No.:- <strong>
                                    {{ $account->account_number }}
                                </strong></h3><br>
                            <h3>Current Balance:-<strong>
                                    Rs. {{ $account->balance }}
                                </strong></h3>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('account.update', $user->guid) }}" id="userForm" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Name<span style="color: red">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid	@enderror" id="name"
                                                placeholder="Enter Name" value="{{ $user->name }}">
                                            @error('name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone">Phone<span style="color: red">*</span></label>
                                            <input type="text" class="form-control  @error('phone') is-invalid	@enderror"
                                                id="phone" name="phone" placeholder="Enter Phone"
                                                value="{{ $user->phone }}">
                                            @error('phone')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Email address<span
                                                    style="color: red">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control  @error('email') is-invalid	@enderror"
                                                id="exampleInputEmail1" placeholder="Enter email"
                                                value="{{ $user->email }}">
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status<span style="color: red">*</span></label>
                                            <select class="form-control select2" name="status" style="width: 100%;">
                                                @foreach (status() as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $key == $user->status ? 'selected' : '' }}>{{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="hidden" name="photo_media_id" id="photo_media_id" value="">
                                        <div class="mb-3">
                                            <label for="image">Upload Photo<span style="color: red">*</span></label>
                                            <div id="image" class="dropzone dz-clickable">
                                                <div class="dz-message needsclick">
                                                    <br>Drop files here or click to upload.<br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="hidden" name="signature_media_id" id="signature_media_id"
                                            value="">
                                        <div class="mb-3">
                                            <label for="image2">Upload Signature<span style="color: red">*</span></label>
                                            <div id="image2" class="dropzone dz-clickable">
                                                <div class="dz-message needsclick">
                                                    <br>Drop files here or click to upload.<br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Update</button>
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
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('media.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#photo_media_id").val(response.image_id);
                //console.log(response)
            }
        });

        const dropzone2 = $("#image2").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('media.create') }}",
            maxFiles: 1,
            paramName: 'image2',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#signature_media_id").val(response.image_id);
                //console.log(response)
            }
        });
    </script>
@endsection
