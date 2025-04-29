@extends('admin.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Contact List</h4>
                        </div>
                        <div class="card-body">
                            <div id="delete-message" class="mb-5 mt-2"></div>
                            <div class="table-responsive">
                                <table id="usersTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Orders</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = 0;
                                        @endphp
                                        @foreach ($users as $user)
                                            @php $sno++ @endphp
                                            <tr>
                                                <td>{{ $sno }}</td>
                                                <td>{{ $user->name}}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->mobile }}</td>
                                                <td>
                                                    {{ $user->orders_count}}
                                                </td>
                                                <td>{{ $user->created_at->format('d-M-Y') }} <br> {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
