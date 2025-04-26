@extends('layouts.main')


@section('content')
    <section>
        <div class="ccd-timeline">
            <div class="container page--width">
                <h1 class="page--head text-center">Order Status</h1>
                @php
                    use Carbon\Carbon;

                    // Convert order created_at to Carbon instance
                    $orderedDate = Carbon::parse($order->created_at);
                    $shippedDate = $orderedDate->copy()->addDays(2);
                    $outForDeliveryDate = $shippedDate->copy()->addDays(3);
                    $deliveredDate = $outForDeliveryDate->copy()->addDays(2);
                @endphp
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 ">
                        <div class="ccd-orderpg">
                            <h2>Order ID #{{ $order->order_id }}</h2>
                            <p>Placed on : {{ $orderedDate->format('M d, Y') }}</p>
                            <p>Expected Arrival : {{ $deliveredDate->format('M d, Y') }}</p>
                        </div>
                        <div
                            class="row flex-md-row flex-column justify-content-between align-items-center hh-grayBox text-center">
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Ordered<br><span><img width="48" height="48"
                                            src="https://img.icons8.com/color/48/paid.png" alt="paid" /></span></p>
                            </div>
                            <div class="order-tracking {{ $order->status > 0 ? 'completed' : '' }}">
                                <span class="is-complete"></span>
                                <p>Shipped<br><span><img width="48" height="48"
                                            src="https://img.icons8.com/officel/50/drop-shipping.png"
                                            alt="drop-shipping" /></span></p>
                            </div>
                            <div class="order-tracking {{ $order->status > 1 ? 'completed' : '' }}">
                                <span class="is-complete"></span>
                                <p>En Route<br><span><img width="48" height="48"
                                            src="https://img.icons8.com/color/48/shipped.png" alt="shipped" /></span></p>
                            </div>
                            <div class="order-tracking {{ $order->status > 2 ? 'completed' : '' }}">
                                <span class="is-complete"></span>
                                <p>Delivered<br><span><img width="48" height="48"
                                            src="https://img.icons8.com/external-febrian-hidayat-flat-febrian-hidayat/64/external-Delivered-delivery-and-logistic-febrian-hidayat-flat-febrian-hidayat.png"
                                            alt="external-Delivered-delivery-and-logistic-febrian-hidayat-flat-febrian-hidayat" /></span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="{{ route('view.order', [$order->id]) }}" class="btn-sec" type="submit">View Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .ccd-timeline {
            .ccd-orderpg {
                margin-bottom: 30px;

                h2 {
                    font-size: 20px;
                }

                p {
                    color: #b2b2b2;
                    margin-bottom: 10px
                }
            }

            .hh-grayBox {
                background-color: #181717;
                padding: 35px;
                margin: 20px 0;
                border-radius: 10px;
            }

            .order-tracking {
                text-align: center;
                flex: 1;
                min-width: 100px;
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .order-tracking .is-complete {
                display: block;
                position: relative;
                border-radius: 50%;
                height: 30px;
                width: 30px;
                background-color: #393939;
                margin-bottom: 10px;
                z-index: 2;
            }

            .order-tracking .is-complete:after {
                content: "";
                position: absolute;
                height: 14px;
                width: 7px;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(45deg);
                border: 2px solid transparent;
                opacity: 0;
            }

            .order-tracking.completed .is-complete {
                background-color: #27aa80;
            }

            .order-tracking.completed .is-complete:after {
                border-color: #fff;
                border-width: 0px 3px 3px 0;
                opacity: 1;
            }

            .order-tracking p {
                position: relative;
                color: #5a5858;
                background-color: #181717;
                font-size: 16px;
                margin-top: 5px;
                line-height: 20px;
            }

            .order-tracking p img {
                margin-top: 10px;
                filter: grayscale(100%);
            }

            .order-tracking p span {
                font-size: 14px;
            }

            .order-tracking.completed p {
                color: #ffffff;
            }

            .order-tracking.completed p img {
                filter: none
            }

            .order-tracking::before {
                content: "";
                display: block;
                height: 3px;
                width: 100%;
                background-color: #393939;
                position: absolute;
                top: 15px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 0;
            }

            .order-tracking.completed:before {
                background-color: #27aa80;
            }

            @media (max-width: 768px) {
                .order-tracking {
                    width: 100%;
                }

                .order-tracking p {
                    margin-top: 16px;
                    margin-bottom: 20px;
                    padding: 5px 0;
                }

                .order-tracking p img {
                    margin-top: 5px;
                }

                .order-tracking::before {
                    width: 3px;
                    height: 100%;
                    top: 0;
                    /* left: 15px;
                    transform: translateX(0); */
                }

                /* .order-tracking:first-child::before {
                    display: block;
                    height: 100%;
                } */

                /* .order-tracking .is-complete {
                    margin-left: 15px;
                } */
            }
        }
    </style>
@endsection
