@extends('layouts.main')


@section('content')
<section>
    <div class="ccd-order--view">
        <div class="container page--width">
            <h1 class="page--head">View Order</h1>
            <!-- view order  -->
            <div class="ccd-ov-wrap">
                <div class="ccd-ov-head">
                    <div>Order ID - cic_123456</div>
                    <div class="ccd-ov-status">
                        <span class="badge bg-success">Completed</span>
                    </div>
                    <div class="ccd-ov-date">Placed on Jan 10, 2024</div>
                </div>
                <div class="ccd-ov-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ccd-ov__products">
                                <h5 class="ccd-ov__head">Products</h5>

                                <div class="ccd--orders">
                                    <ul class="order__lists">
                                        <li class="order__list">
                                            <a href="" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="images/b7.jpg" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        Amaterasu u Itachi Designed Sweatshirt Itachi Designed
                                                        Sweatshirt
                                                    </div>
                                                    <div class="order__list-quantity">
                                                        Qty : 1
                                                    </div>

                                                </div>
                                                <div class="order__list-total">
                                                    Rs. 1999
                                                </div>
                                            </a>
                                        </li>
                                        <li class="order__list">
                                            <a href="" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="images/b4.jpg" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        Sweatshirt Itachi Designed Sweatshirt
                                                    </div>
                                                    <div class="order__list-quantity">
                                                        Qty : 1
                                                    </div>

                                                </div>
                                                <div class="order__list-total">
                                                    Rs. 999
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-5">
                            <div class="ccd-ov__info">
                                <div class="ccd-ov__shipping">
                                    <h5 class="ccd-ov__head">Shipping Address</h5>
                                    <p>John Doe<br>123 Main St<br>Anytown, USA</p>
                                </div>
                                <div class="ccd-ov__payment">
                                    <h5 class="ccd-ov__head">Payment Methods</h5>
                                    <p>Cash on Delivery</p>
                                </div>
                                <div class="ccd-ov__summary">
                                    <h5 class="ccd-ov__head">Order Summary</h5>
                                    <div class="ccd-ov__summary-info">
                                        <div class="row">
                                            <div class="col-3">
                                                <p>Items :</p>
                                            </div>
                                            <div class="col">
                                                <p>1</p>
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
                                                <p>Rs 2999</p>
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
