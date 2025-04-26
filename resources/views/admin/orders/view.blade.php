@extends('admin.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Orders List</h4>
                        </div>
                        <div class="card-body">
                            <div id="delete-message" class="mb-5 mt-2"></div>
                            <div class="table-responsive">
                                <table id="usersTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>OrderID</th>
                                            <th>Payment</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Placed on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = 1;
                                        @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $sno++ }}</td>
                                                <td><a href="{{url('order/view/'.$order->id)}}" class="btn btn-secondary">{{ $order->order_id }}</a></td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>Rs.{{ $order->total_amount }}</td>
                                                <td>
                                                    @switch($order->status)
                                                        @case(0)
                                                            <span class="badge text-bg-primary">Placed</span>
                                                        @break

                                                        @case(1)
                                                            <span class="badge text-bg-info">Shipped</span>
                                                        @break

                                                        @case(2)
                                                            <span class="badge text-bg-warning">Out for Delivery</span>
                                                        @break

                                                        @case(3)
                                                            <span class="badge text-bg-success">Delivered</span>
                                                        @break

                                                        @case(4)
                                                            <span class="badge text-bg-danger">Canceled</span>
                                                        @break

                                                        @default
                                                            <span class="badge text-bg-secondary">Unknown</span>
                                                    @endswitch
                                                </td>
                                                <td>{{ $order->created_at->format('d-M-Y') }} <br>
                                                    {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>

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
