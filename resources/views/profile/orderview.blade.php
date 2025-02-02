@extends('layouts.main')


@section('content')
    <section>
        <div class="ccd-order--view">
            <div class="container page--width">
                <h1 class="page--head">View Order</h1>
                <!-- view order  -->
                <div class="ccd-ov-wrap">
                    <div class="ccd-ov-head">
                        <div>Order ID - {{ $order->order_id }}</div>
                        <div class="ccd-ov-status">
                            <span class="badge bg-success">Completed</span>
                        </div>
                        <div class="ccd-ov-date">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                        </div>
                    </div>
                    {{-- {{ $order->orderDetails }} --}}
                    @php
                        $orderD = $order->orderDetails;
                    @endphp
                    <div class="ccd-ov-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ccd-ov__products">
                                    <h5 class="ccd-ov__head">Products</h5>

                                    <div class="ccd--orders">
                                        <ul class="order__lists">
                                            @if ($orderD->count())
                                                @foreach ($orderD as $val)
                                                    <li class="order__list">
                                                        <a href="{{route('product.show',$val->product->slug)}}" class="order__list-link">
                                                            <div class="order__list-pic">
                                                                <img src="{{ asset('admin-files/products/' . $val->product->main_img) }}"
                                                                    alt="product-image" class="img-fluid order__list-img"
                                                                    width="100" height="100" loading="lazy">
                                                            </div>
                                                            <div class="order__list-info">
                                                                <div class="order__list-title">
                                                                    {{ $val->product->product_name }}
                                                                </div>
                                                                <div class="order__list-quantity">
                                                                    Qty : {{ $val->quantity }}
                                                                </div>
                                                                @if (!empty($val->size))
                                                                    <div class="order__list-opt">
                                                                        size :
                                                                        {{ $val->size }}{{ !empty($val->color) ? ' | color : ' . $val->color : '' }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="order__list-total">
                                                                Rs. {{ $val->quantity * $val->product_price }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 ps-lg-5">
                                <div class="ccd-ov__info">
                                    <div class="ccd-ov__shipping">
                                        <h5 class="ccd-ov__head">Shipping Address</h5>
                                        <p>{{ $order->full_name }}<br>{{ $order->address }}<br>{{ $order->city }},
                                            {{ $order->state }} <br>Pincode - {{ $order->pincode }}</p>
                                    </div>
                                    <div class="ccd-ov__payment">
                                        <h5 class="ccd-ov__head">Payment Methods</h5>
                                        @if ($order->payment_method == 'cod')
                                            <p>Cash on Delivery</p>
                                        @else
                                            <p>Online UPI</p>
                                        @endif

                                    </div>
                                    <div class="ccd-ov__summary">
                                        <h5 class="ccd-ov__head">Order Summary</h5>
                                        <div class="ccd-ov__summary-info">
                                            <div class="row">
                                                <div class="col-3">
                                                    <p>Items :</p>
                                                </div>
                                                <div class="col">
                                                    <p>{{ $orderD->count() }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <p>Shipping :</p>
                                                </div>
                                                <div class="col">
                                                    <p>Free</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <p>Total :</p>
                                                </div>
                                                <div class="col">
                                                    <p>Rs. {{ number_format($order->total_amount, 2) }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- view order END -->


            </div>
        </div>

    </section>
@endsection
