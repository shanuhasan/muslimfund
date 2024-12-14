@extends('layouts.app')

@section('title', 'Accounts')
@section('account', 'active')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Accounts</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('account.create') }}" class="btn btn-primary">Add</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('message')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Accounts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Account No.</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isNotEmpty())
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @foreach ($user->accounts as $account)
                                                        {{ $account->account_number }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if ($user->status == '1')
                                                        <span class="badge bg-success">{{ status($user->status) }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ status($user->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('account.edit', $user->guid) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('account.delete', $user->guid) }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" align="center">Record Not Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {!! $users->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script></script>
@endsection
