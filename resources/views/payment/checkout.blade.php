@extends('layouts.main')


@section('content')
    <section>
        <div class="ccd-checkout">
            <div class="container">
                <h1 class="page--head text-center animate__animated animate__bounce animate__delay-2s">Checkout</h1>
                <form class="ccd-checkout__form" method="POST" action="{{ route('submitOrder') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="ccd-checkout__header">
                                <h2 class="ccd-checkout__title page--title">Billing Address</h2>
                                <p class="ccd-checkout__subtitle text-main">Please fill out the form below to complete your
                                    order.</p>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="fullname" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                                        @error('fullname')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="ccd-form-group">

                                        <label for="address" class="form-label">Door No / Street name *</label>
                                        <textarea class="form-control" id="address" rows="3" name="address"  required>{{ old('address') }}</textarea>
                                        @error('address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="city" class="form-label">City *</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="pincode" class="form-label">Pincode *</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" required>
                                        @error('pincode')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="state" class="form-label">State *</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
                                        @error('state')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ccd-form-group">
                                        <label for="mobile" class="form-label">Mobile *</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                                        @error('mobile')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="ccd-checkout__pay">
                                <h2 class="ccd-checkout__title page--title">Payment Method</h2>
                                <div class="ccd-checkout__payment-method">
                                    <div class="profile__accordion accordion">
                                        <details open>
                                            <summary role="button" aria-expanded="false">
                                                <div class="summary__title">
                                                    <span class="icon icon-accordion">
                                                        <img width="50" height="50"
                                                            src="https://img.icons8.com/fluency/50/bhim.png"
                                                            alt="bhim" />
                                                    </span>
                                                    <h2 class="h4 accordion__title inline-richtext">
                                                        Pay via UPI
                                                    </h2>
                                                </div>
                                                <svg aria-hidden="true" focusable="false" class="icon icon-caret"
                                                    viewBox="0 0 10 6">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                                        fill="currentColor">
                                                    </path>
                                                </svg>

                                            </summary>
                                            <div class="accordion__content">
                                                <div class="profile__block">

                                                    <div class="py-3 text-center">
                                                        <div>
                                                            <img width="50" height="50"
                                                                src="https://img.icons8.com/fluency/50/google-pay-new.png"
                                                                alt="google-pay-new" />
                                                            <img width="48" height="48"
                                                                src="https://img.icons8.com/color/48/phone-pe.png"
                                                                alt="phone-pe" />
                                                            <img width="50" height="50"
                                                                src="https://img.icons8.com/ios-filled/50/bhim-upi.png"
                                                                alt="bhim-upi" />
                                                            <img width="48" height="48"
                                                                src="https://img.icons8.com/color/48/bank-card-front-side.png"
                                                                alt="bank-card-front-side" />
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" name="pay_method" value="online" class="btn-sec">Pay now</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </details>
                                    </div>
                                    <div class="profile__accordion accordion">
                                        <details>
                                            <summary role="button" aria-expanded="false">
                                                <div class="summary__title">
                                                    <span class="icon icon-accordion">
                                                        <img width="48" height="48"
                                                            src="https://img.icons8.com/color/48/cash-in-hand.png"
                                                            alt="cash-in-hand" />
                                                    </span>
                                                    <h2 class="h4 accordion__title inline-richtext">
                                                        Cash on Delivery
                                                    </h2>
                                                </div>
                                                <svg aria-hidden="true" focusable="false" class="icon icon-caret"
                                                    viewBox="0 0 10 6">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                                        fill="currentColor">
                                                    </path>
                                                </svg>

                                            </summary>
                                            <div class="accordion__content">
                                                <div class="profile__block">
                                                    <div class="py-3 text-center">
                                                        <p>Total Price: 449.00</p>
                                                        <button type="submit" name="pay_method" value="cod" class="btn-sec">Place Order</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </details>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>



    <style>
        .ccd-form-group {
            margin-bottom: 20px;
        }
    </style>
@endsection
