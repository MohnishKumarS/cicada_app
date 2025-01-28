@extends('layouts.main')

@section('content')

    <!-- cart page -->
    <section>
        <div class="cart-wrapper">
            <div class="container page--width">
                <div class="ccd--cart">
                    <div class="cart__title-wrap ">
                        <h1 class="page--head">Your cart</h1>
                        <a href="{{ url('/') }}" class="link--text">Continue shopping</a>
                    </div>

                    {{-- @php
                        print_r($validCartItems);
                        echo '<br> ---- Grouped array ------- <br>';
                        // Group cart items by product_id and size
                        $groupedCartItems = collect($validCartItems)->groupBy(function ($item) {
                            return $item['product_id'] . '_' . $item['size'];
                        });
                        $grandTotal = 0;
                        // print_r($groupedCartItems);
                    @endphp --}}
                    {{-- {{$groupedCartItems}} --}}
                    @if (count($finalCart) > 0)
                        @php
                            // Calculate the grand total (sum of all total prices)
                            $grandTotal = $finalCart->sum('total_price');
                        @endphp
                        <table class="cart-table">
                            <thead>
                                <tr class="cart-table__head">
                                    <th colspan="2" width="50%">Product</th>
                                    <th class="lg-hide text-end" width="10%">Total</th>
                                    <th class="sm-hide" width="20%">Quantity</th>
                                    <th class="sm-hide text-end" width="10%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finalCart as $groupKey => $group)
                                    @php
                                        $cartItem = $group;
                                        $product = $products->firstWhere('id', $cartItem['product_id']);
                                        // $totalQuantity = $group->sum('quantity');
                                        // // Calculate total price for this group
                                        // $groupTotalPrice = $product->offer_price * $totalQuantity;
                                        // $grandTotal += $groupTotalPrice; // Add to the grand total
                                    @endphp
                                    
                                    @if ($product)
                                        <tr class="cart-item" id="{{ $cartItem['product_id'] }}-{{ $cartItem['size'] }}-{{ $cartItem['color'] }}">
                                            <td class="cart-item__media">
                                                <div class="cart-item__pic">
                                                    <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                                        alt="{{ $product->product_name }}" class="cart-item__img img-fluid"
                                                        width="100" height="100" loading="lazy">
                                                </div>
                                            </td>
                                            <td class="cart-item__info">
                                                <div>
                                                    <div class="cart-item__name">
                                                        <a href="{{ route('product.show', $product->slug) }}"
                                                            class="link link--hover">{{ $product->product_name }}</a>
                                                    </div>
                                                    <div class="cart-item__price">Rs.
                                                        {{ number_format($product->offer_price, 2) }}</div>
                                                    <div class="cart-item__size">Size: {{ $cartItem['size'] }}</div>
                                                    @if ($cartItem['color'])
                                                        <div class="cart-item__color">Color: {{ $cartItem['color'] }}</div>
                                                    @endif
                                                    <div class="cart-item__actions-wrapper lg-hide mt-3">
                                                        <div class="product__quantity">
                                                            <div class="input-group input-group-lg" style="width: 140px;">
                                                                <span class="input-group-text"
                                                                    onclick="CartQuantityChange(this, -1)"
                                                                    data-product-id="{{ $cartItem['product_id'] }}"
                                                                    data-size="{{ $cartItem['size'] }}"
                                                                    data-color="{{ $cartItem['color'] }}">-</span>
                                                                <input type="text"
                                                                    class="form-control text-center cart-quantity"
                                                                    value="{{ $group['quantity'] }}" readonly>
                                                                <span class="input-group-text"
                                                                    onclick="CartQuantityChange(this, 1)"
                                                                    data-product-id="{{ $cartItem['product_id'] }}"
                                                                    data-size="{{ $cartItem['size'] }}"
                                                                    data-color="{{ $cartItem['color'] }}">+</span>
                                                            </div>
                                                        </div>
                                                        <div class="product__remove">
                                                            <button
                                                                onclick="removeItemFromCart('{{ $cartItem['product_id'] }}', '{{ $cartItem['size'] ?? '' }}', '{{ $cartItem['color'] ?? '' }}')">

                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                                    aria-hidden="true" focusable="false"
                                                                    class="icon icon-remove">
                                                                    <path
                                                                        d="M14 3h-3.53a3.07 3.07 0 00-.6-1.65C9.44.82 8.8.5 8 .5s-1.44.32-1.87.85A3.06 3.06 0 005.53 3H2a.5.5 0 000 1h1.25v10c0 .28.22.5.5.5h8.5a.5.5 0 00.5-.5V4H14a.5.5 0 000-1z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M6.91 1.98c.23-.29.58-.48 1.09-.48s.85.19 1.09.48c.2.24.3.6.36 1.02h-2.9c.05-.42.17-.78.36-1.02zm4.84 11.52h-7.5V4h7.5v9.5z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M6.55 5.25a.5.5 0 00-.5.5v6a.5.5 0 001 0v-6a.5.5 0 00-.5-.5zM9.45 5.25a.5.5 0 00-.5.5v6a.5.5 0 001 0v-6a.5.5 0 00-.5-.5z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-item__totals lg-hide text-end">
                                                <div class="cart-item__tprice">Rs.
                                                    {{ number_format($group['total_price']) }}</div>
                                            </td>
                                            <td class="cart-item__actions sm-hide">
                                                <div class="cart-item__actions-wrapper">
                                                    <div class="product__quantity">
                                                        <div class="input-group input-group-lg" style="width: 140px;">
                                                            <span class="input-group-text"
                                                                onclick="CartQuantityChange(this, -1)"
                                                                data-product-id="{{ $cartItem['product_id'] }}"
                                                                data-size="{{ $cartItem['size'] }}"
                                                                data-color="{{ $cartItem['color'] }}">-</span>
                                                            <input type="text"
                                                                class="form-control text-center cart-quantity"
                                                                value="{{ $group['quantity'] }}" readonly>
                                                            <span class="input-group-text"
                                                                onclick="CartQuantityChange(this, 1)"
                                                                data-product-id="{{ $cartItem['product_id'] }}"
                                                                data-size="{{ $cartItem['size'] }}"
                                                                data-color="{{ $cartItem['color'] }}">+</span>
                                                        </div>

                                                    </div>
                                                    <div class="product__remove">
                                                        <button
                                                            onclick="removeItemFromCart('{{ $cartItem['product_id'] }}', '{{ $cartItem['size'] ?? '' }}', '{{ $cartItem['color'] ?? '' }}')">

                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                                aria-hidden="true" focusable="false"
                                                                class="icon icon-remove">
                                                                <path
                                                                    d="M14 3h-3.53a3.07 3.07 0 00-.6-1.65C9.44.82 8.8.5 8 .5s-1.44.32-1.87.85A3.06 3.06 0 005.53 3H2a.5.5 0 000 1h1.25v10c0 .28.22.5.5.5h8.5a.5.5 0 00.5-.5V4H14a.5.5 0 000-1zM6.91 1.98c.23-.29.58-.48 1.09-.48s.85.19 1.09.48c.2.24.3.6.36 1.02h-2.9c.05-.42.17-.78.36-1.02zm4.84 11.52h-7.5V4h7.5v9.5z"
                                                                    fill="currentColor"></path>
                                                                <path
                                                                    d="M6.55 5.25a.5.5 0 00-.5.5v6a.5.5 0 001 0v-6a.5.5 0 00-.5-.5zM9.45 5.25a.5.5 0 00-.5.5v6a.5.5 0 001 0v-6a.5.5 0 00-.5-.5z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-item__totals sm-hide text-end">
                                                <div class="cart-item__tprice">Rs.
                                                    {{ number_format($product->offer_price * $group['quantity']) }}</div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart__total-wrap">
                            <div class="cart__totals">
                                <h3 class="cart__totals-txt">Estimated total :</h3>
                                <div class="cart__total-price">Rs.{{ number_format($grandTotal, 2) }}</div>
                            </div>
                            <div class="cart__btn-wrap  mt-4">
                                <a href="{{ url('checkout') }}" class="btn-sec">Checkout now</a>
                            </div>
                        </div>
                </div>
            @else
                <div class="ccd--empty">
                    <div class="ccd-empty__icon">
                        <img src="images/cicada.webp" class="img-fluid ccd-empty__logo" width="100" height="100"
                            alt="cicada-logo">
                    </div>
                    <h3 class="ccd-empty__title page--head">Your cart is currently empty.</h3>
                    <div class="ccd-empty__link">
                        <a href="{{ url('collections') }}" class="btn-main">Return to Shop</a>
                    </div>
                </div>
                @endif
            </div>
        </div>


        {{-- <div class="related-prod pt-md-5">
        <div class="container page--width">
            <h2 class="page--title">
                Featured collection
            </h2>
            <div class="row products--row">
                <div class="col-lg-3 col-6 col-md-4">
                    <div class="ccd-card">
                        <div class="ccd-card__media">
                            <img src="assets/image/b8.jpg" class="ccd-card__img" alt="product-img" loading="lazy">
                        </div>
                        <div class="ccd-card__content">
                            <h4 class="ccd-card__title">
                                <a href="" class="link link--hover">ASAP Rocky Designed Oversized Tee</a>
                            </h4>
                            <p class="ccd-card__info">
                                <span class="ccd-card__org">Rs 999</span>
                                <span class="ccd-card__sell">Rs 599</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-4">
                    <div class="ccd-card">
                        <div class="ccd-card__media">
                            <img src="assets/image/b2.jpg" class="ccd-card__img" alt="product-img" loading="lazy">
                        </div>
                        <div class="ccd-card__content">
                            <h4 class="ccd-card__title">
                                <a href="" class="link link--hover">ASAP Rocky Designed Oversized Tee</a>
                            </h4>
                            <p class="ccd-card__info">
                                <span class="ccd-card__org">Rs 999</span>
                                <span class="ccd-card__sell">Rs 599</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-4">
                    <div class="ccd-card">
                        <div class="ccd-card__media">
                            <img src="assets/image/b3.jpg" class="ccd-card__img" alt="product-img" loading="lazy">
                        </div>
                        <div class="ccd-card__content">
                            <h4 class="ccd-card__title">
                                <a href="" class="link link--hover">ASAP Rocky Designed Oversized Tee</a>
                            </h4>
                            <p class="ccd-card__info">
                                <span class="ccd-card__org">Rs 999</span>
                                <span class="ccd-card__sell">Rs 599</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-4">
                    <div class="ccd-card">
                        <div class="ccd-card__media">
                            <img src="assets/image/b7.jpg" class="ccd-card__img" alt="product-img" loading="lazy">
                        </div>
                        <div class="ccd-card__content">
                            <h4 class="ccd-card__title">
                                <a href="" class="link link--hover">ASAP Rocky Designed Oversized Tee</a>
                            </h4>
                            <p class="ccd-card__info">
                                <span class="ccd-card__org">Rs 999</span>
                                <span class="ccd-card__sell">Rs 599</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ccd-card__link text-center">
                <a href="#" class="btn-main">View all</a>
            </div>
        </div>
       
    </div> --}}
    </section>
    <!-- featured product -->
    @include('home-parts.featureProduct', ['featuredProducts' => $featuredProducts])

@endsection
