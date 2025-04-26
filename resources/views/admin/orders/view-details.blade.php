@extends('admin.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">View order</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                @if (session('status'))
                                    <h5 class="alert alert-{{ session('type') }}">{{ session('msg') }}</h5>
                                @endif
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form action="{{ url('order/order-status/' . $order->id) }}" method="post">
                                            @method('put')
                                            @csrf


                                            <div class="mt-3">
                                                <p class="fw-bold">Delivery status :</p>
                                                <select class="form-select" name="order_status" required>
                                                    <option value="" disabled>Choose one</option>
                                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Order
                                                        placed
                                                    </option>
                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                                        Shipped</option>
                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Out
                                                        For Delivery
                                                    </option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>
                                                        Delivered</option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>
                                                        Canceled</option>
                                                </select>
                                            </div>

                                            <div class="my-3">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5>Order Details</h5>
                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <p><b>OrderId :</b> <span>{{ $order->order_id }}</span>
                                                </p>
                                                <p><b>Order Placed :</b>
                                                    <span>{{ $order->created_at->format('d-M-Y') }}</span></p>
                                                <p><b>User Device :</b> <span>{{ $order->user_device }}</span></p>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <p><b>Payment Mode :</b> <span>{{ $order->payment_method }}</span></p>
                                                @if ($order->payment_id)
                                                    @php
                                                        $transId = json_decode($order->payment_id);
                                                    @endphp
                                                    <p><b>Transaction ID :</b>
                                                        <span>{{ $transId->data->transactionId }}</span></p>
                                                @endif

                                                <p><b>Order Total :</b> <span>Rs.{{ $order->total_amount }}</span></p>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sno = 0;
                                                @endphp
                                                @foreach ($order->orderDetails as $val)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('admin-files/products/' . $val->product->main_img) }}"
                                                                alt="product-image" class="img-fluid order__list-img"
                                                                width="100" height="100" loading="lazy">
                                                        </td>
                                                        <td>
                                                            <div class="order__list-info">
                                                                <div class="order__list-title">
                                                                    {{ $val->product->product_name }}
                                                                </div>

                                                                @if (!empty($val->size))
                                                                    <div class="order__list-opt">
                                                                        size :
                                                                        {{ $val->size }}{{ !empty($val->color) ? ' | color : ' . $val->color : '' }}
                                                                    </div>
                                                                @endif
                                                                <div class="order__list-quantity">
                                                                    Price : {{ $val->product_price }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $val->quantity }}</td>
                                                        <td>{{ $val->product_price * $val->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="fw-bold">
                                                    <td colspan="3" class="text-start">Grand Total :</td>
                                                    <td>Rs. {{ $order->total_amount }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <h5>Shipping Address</h5>
                                    <hr>
                                    <div>
                                        <p><b>Name :</b> <span>{{ $order->full_name }}</span></p>
                                        <p><b>Address :</b> <span>{{ $order->address }}, {{ $order->city }},
                                                {{ $order->state }} - {{ $order->pincode }}</span></p>

                                        <p><b>Phone :</b> <span>{{ $order->mobile }}</span></p>
                                        <p><b>Email :</b> <span>{{ $order->email }}</span></p>
                                        <p><b>Message :</b> <span>{{ $order->message }}</span></p>
                                    </div>

                                    <hr>
                                    <h5>Customer Details</h5>
                                    <hr>
                                    <div>
                                        <p><b> Name :</b> {{ $order->user->name }}</p>
                                        <p><b>Email :</b> {{ $order->user->email }}</p>
                                        <p><b>Mobile :</b> {{ $order->user->mobile }}</p>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
