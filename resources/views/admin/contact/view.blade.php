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
                                <table id="contactsTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = 0;
                                        @endphp
                                        @foreach ($contacts as $contact)
                                            @php $sno++ @endphp
                                            <tr>
                                                <td>{{ $sno }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->mobile }}</td>
                                                <td>{{ $contact->message }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                                </td>
                                                <td>{{ $contact->created_at->format('d-M-Y') }}</td>



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
