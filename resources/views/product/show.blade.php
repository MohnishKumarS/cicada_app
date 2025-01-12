@extends('layouts.main')


@section('content')
    <!-- single product view -->
    <section>
        <main class="ccd--product">
            <div class="container page--width">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product__media-wrapper product__column-sticky">
                            <div class="sm-hide">
                                <ul class="product__media-gallery">
                                    <li class="product__media-desk"><img
                                            src="{{ asset('admin-files/products/' . $product->main_img) }}" id="productImage"
                                            alt="product-{{ $product->slug }}" class="img-fluid product__media-img"
                                            width="150" height="150" loading="lazy">
                                    </li>
                                    @php
                                        $other_img = empty($product->additional_images) ? [] : explode(',', $product->additional_images);
                                    @endphp
                                    @if (count($other_img))
                                        @foreach ($other_img as $img)
                                            <li class="product__media-desk"><img
                                                    src="{{ asset('admin-files/products/' . $img) }}"
                                                    alt="product-{{ $product->slug }}" class="img-fluid product__media-img"
                                                    width="150" height="150" loading="lazy">
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>

                            <div class="product__media-slider lg-hide">
                                <div class="swiper" id="product__swiper-mob">
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide">
                                            <div class="product__media-pic">
                                                <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                                    class="product__media-pic img-fluid" alt="product-{{ $product->slug }}"
                                                    loading="lazy">
                                            </div>
                                        </div>
                                        @if (count($other_img))
                                            @foreach ($other_img as $img)
                                                <div class="swiper-slide">
                                                    <div class="product__media-pic">
                                                        <img src="{{ asset('admin-files/products/' . $img) }}"
                                                            class="product__media-pic img-fluid"
                                                            alt="product-{{ $product->slug }}" loading="lazy">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif


                                    </div>
                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product__info-wrapper product__column-sticky">
                            <div class="product__brand">{{ $product->brand->brand_name }}</div>
                            <h1 class="product__title">{{ $product->product_name }}</h1>
                            <p class="product__description">{{ $product->product_description }}</p>
                            <div class="product__price"><span class="price-org">Rs. {{ $product->actual_price }}</span>
                                <span class="price-sell">Rs. {{ $product->offer_price }}</span>
                            </div>
                            <p class="product__off"> Free Shipping all over India</p>
                            <div class="product__reviews">
                                @if ($product->color)
                                    <p class="product__sub-cat">Colors*</p>
                                    <div class="product__color">
                                        <div class="color-selector">
                                            @php
                                                $colors = explode(',', $product->color);
                                            @endphp
                                            @foreach ($colors as $color)
                                                <input class="color-input" type="radio" name="color"
                                                    id="color-{{ strtolower($color) }}" value="{{ strtolower($color) }}">
                                                <label for="color-{{ strtolower($color) }}"
                                                    class="color-label">{{ strtoupper($color) }}</label>
                                            @endforeach

                                        </div>
                                    </div>
                                @endif

                                <p class="product__sub-cat">Size*</p>
                                <div class="product__size">
                                    <div class="size-selector">
                                        @php
                                            $sizes = explode(',', $product->size);
                                        @endphp
                                        @foreach ($sizes as $size)
                                            <input class="size-input" type="radio" name="size"
                                                id="size-{{ strtolower($size) }}" value="{{ strtolower($size) }}">
                                            <label for="size-{{ strtolower($size) }}"
                                                class="size-label">{{ strtoupper($size) }}</label>
                                        @endforeach

                                    </div>
                                </div>
                                <p class="product__sub-cat">Quantity*</p>
                                <div class="product__quatity">
                                    <div class="input-group input-group-lg" style="width: 140px;">
                                        <span class="input-group-text" onclick="changeQuantity(this,-1)">-</span>
                                        <input type="text" class="form-control text-center js--quantity" name="quantity"
                                            id="quantity" value="1" max="10" min="1" readonly>
                                        <span class="input-group-text" onclick="changeQuantity(this,1)">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="product__actions">
                                <button class="btn-main product__btn" onclick="addToCart({{ $product->id }})">Add to
                                    Cart</button>
                                <button class="btn-sec product__btn">Buy it Now</button>
                            </div>

                            <div class="product__desc">
                                <ul>
                                    <li>Unisex</li>
                                    <li>220 GSM</li>
                                    <li>Fabric : 100% cotton</li>
                                    <li>Soft, Breathable and Oversized Fit</li>
                                </ul>
                            </div>
                            <div class="product__info">

                                <div class="product__accordion accordion">
                                    <details id="Details-collapsible-row-0-template--22125670007096__main">
                                        <summary role="button" aria-expanded="false"
                                            aria-controls="ProductAccordion-collapsible-row-0-template--22125670007096__main">
                                            <div class="summary__title">
                                                <svg class="icon icon-accordion" aria-hidden="true" focusable="false"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M5.81971 2.09623C5.66962 2.09623 5.54176 2.15186 5.44395 2.25357L1.21145 6.65441C1.1088 6.76918 1.05429 6.90939 1.05429 7.05112C1.05429 7.20712 1.10783 7.34015 1.20568 7.44189L3.32991 9.65061C3.44515 9.76252 3.57826 9.81363 3.71113 9.81363C3.85775 9.81363 3.9834 9.76402 4.08701 9.65628L4.09094 9.6522L4.7024 9.02972C4.85658 8.87275 5.08721 8.82933 5.28453 8.92013C5.48186 9.01093 5.60604 9.21761 5.59798 9.44182L5.31373 17.3532C5.31817 17.6495 5.55481 17.8928 5.84081 17.8928H6.18836L14.1803 17.9038C14.4659 17.9035 14.7026 17.6607 14.7074 17.3648L14.4021 9.4433C14.3934 9.21885 14.5174 9.01164 14.7148 8.92044C14.9122 8.82925 15.1432 8.87254 15.2976 9.02968L15.9059 9.6489C16.0215 9.76199 16.1553 9.81363 16.2889 9.81363C16.4354 9.81363 16.561 9.76407 16.6646 9.65628L18.7886 7.44788C18.8912 7.33314 18.9457 7.19288 18.9457 7.05112C18.9457 6.89515 18.8922 6.76218 18.7943 6.66041L14.5618 2.25956C14.4515 2.15289 14.3167 2.09623 14.1803 2.09623H12.6411C12.5341 2.09623 12.3259 2.19376 12.1903 2.3422L12.181 2.35239C11.5962 2.9605 10.8184 3.29107 9.99479 3.29107C9.1624 3.29107 8.38522 2.95368 7.75232 2.28271L7.74644 2.27647C7.63884 2.1587 7.50017 2.09623 7.35906 2.09623H5.81971ZM4.69845 1.47842C5.00127 1.16356 5.40048 1 5.81971 1H7.35906C7.80667 1 8.21475 1.19917 8.50754 1.51779C8.94944 1.98502 9.45762 2.19485 9.99479 2.19485C10.5398 2.19485 11.0467 1.97904 11.4314 1.5813C11.6973 1.29312 12.1609 1 12.6411 1H14.1803C14.6114 1 15.0018 1.18292 15.2913 1.46809L15.3017 1.47828L19.5398 5.88527C19.8426 6.20007 20 6.61513 20 7.05112C20 7.49942 19.824 7.90545 19.5498 8.20642L19.54 8.21718L17.4101 10.4314C17.0921 10.7621 16.6905 10.9099 16.2889 10.9099C16.0115 10.9099 15.7438 10.8349 15.5054 10.6946L15.7613 17.3337C15.7616 17.341 15.7617 17.3483 15.7617 17.3557C15.7617 18.2613 15.0513 19 14.1803 19L6.18836 18.989H5.84081C4.96982 18.989 4.25938 18.2503 4.25938 17.3447C4.25938 17.3379 4.2595 17.331 4.25974 17.3242L4.49783 10.6977C4.25265 10.8427 3.98187 10.9099 3.71113 10.9099C3.29738 10.9099 2.90507 10.743 2.59955 10.4412L2.58975 10.4316L0.460183 8.21704C0.157401 7.90221 0 7.48707 0 7.05112C0 6.60279 0.176044 6.19683 0.450248 5.89588L0.460047 5.88513L4.69845 1.47842Z">
                                                    </path>
                                                </svg>
                                                <h2 class="h4 accordion__title inline-richtext">
                                                    Size Chart
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
                                        <div class="accordion__content"
                                            id="ProductAccordion-collapsible-row-0-template--22125670007096__main">

                                            <div class="text-center"><img class="img-fluid size-img"
                                                    src="https://cdn.shopify.com/s/files/1/0685/4279/1992/files/Untitled_design_-_2023-03-17T161428.021_480x480.png?v=1679220480"
                                                    alt="size-chart"></div>
                                        </div>
                                    </details>
                                </div>
                                <div class="product__accordion accordion">
                                    <details id="Details-collapsible-row-1-template--22125670007096__main">
                                        <summary role="button" aria-expanded="false"
                                            aria-controls="ProductAccordion-collapsible-row-1-template--22125670007096__main">
                                            <div class="summary__title">
                                                <svg class="icon icon-accordion" aria-hidden="true" focusable="false"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M0 3.75156C0 3.47454 0.224196 3.24997 0.500755 3.24997H10.647C10.9235 3.24997 11.1477 3.47454 11.1477 3.75156V5.07505V5.63362V6.10938V13.6616C10.9427 14.0067 10.8813 14.1101 10.5516 14.6648L7.22339 14.6646V13.6614H10.1462V4.25316H1.00151V13.6614H2.6842V14.6646H0.500755C0.224196 14.6646 0 14.44 0 14.163V3.75156Z">
                                                    </path>
                                                    <path
                                                        d="M18.9985 8.08376L11.1477 6.10938V5.07505L19.6212 7.20603C19.8439 7.26203 20 7.46255 20 7.69253V14.1631C20 14.4401 19.7758 14.6647 19.4992 14.6647H17.3071V13.6615H18.9985V8.08376ZM11.1477 13.6616L13.3442 13.6615L13.3443 14.6647L10.5516 14.6648L11.1477 13.6616Z">
                                                    </path>
                                                    <path
                                                        d="M7.71269 14.1854C7.71269 15.6018 6.56643 16.75 5.15245 16.75C3.73847 16.75 2.59221 15.6018 2.59221 14.1854C2.59221 12.7691 3.73847 11.6209 5.15245 11.6209C6.56643 11.6209 7.71269 12.7691 7.71269 14.1854ZM5.15245 15.7468C6.01331 15.7468 6.71118 15.0478 6.71118 14.1854C6.71118 13.3231 6.01331 12.6241 5.15245 12.6241C4.29159 12.6241 3.59372 13.3231 3.59372 14.1854C3.59372 15.0478 4.29159 15.7468 5.15245 15.7468Z">
                                                    </path>
                                                    <path
                                                        d="M17.5196 14.1854C17.5196 15.6018 16.3733 16.75 14.9593 16.75C13.5454 16.75 12.3991 15.6018 12.3991 14.1854C12.3991 12.7691 13.5454 11.6209 14.9593 11.6209C16.3733 11.6209 17.5196 12.7691 17.5196 14.1854ZM14.9593 15.7468C15.8202 15.7468 16.5181 15.0478 16.5181 14.1854C16.5181 13.3231 15.8202 12.6241 14.9593 12.6241C14.0985 12.6241 13.4006 13.3231 13.4006 14.1854C13.4006 15.0478 14.0985 15.7468 14.9593 15.7468Z">
                                                    </path>
                                                </svg>
                                                <h2 class="accordion__title">
                                                    Shipping
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
                                        <div class="accordion__content"
                                            id="ProductAccordion-collapsible-row-1-template--22125670007096__main">
                                            <p><strong>Average Processing Time:</strong></p>
                                            <ul>
                                                <li><strong>Metros:</strong>&nbsp;2-5 business days</li>
                                                <li><strong>Rest of India:&nbsp;</strong>3-7 business days</li>
                                            </ul>

                                        </div>
                                    </details>
                                </div>
                                <div class="product__accordion accordion">
                                    <details id="Details-collapsible-row-2-template--22125670007096__main">
                                        <summary role="button" aria-expanded="false"
                                            aria-controls="ProductAccordion-collapsible-row-2-template--22125670007096__main">
                                            <div class="summary__title">
                                                <svg class="icon icon-accordion" aria-hidden="true" focusable="false"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.5235 4.79973C6.76257 4.92905 4.08307 6.62063 1.1722 9.66543C0.993412 9.85244 0.993412 10.1474 1.1722 10.3344C4.08307 13.3793 6.76258 15.0709 9.52351 15.2003C12.2733 15.3291 15.2667 13.9138 18.8217 10.3399C19.0086 10.152 19.0086 9.84814 18.8217 9.6602C15.2667 6.0863 12.2733 4.67093 9.5235 4.79973ZM9.47509 3.7592C12.6521 3.61039 15.9149 5.26347 19.5564 8.92433C20.1479 9.5189 20.1479 10.4812 19.5564 11.0758C15.9149 14.7366 12.6521 16.3897 9.47508 16.2408C6.30917 16.0924 3.3912 14.1603 0.42305 11.0555C-0.141017 10.4655 -0.141017 9.53435 0.423051 8.94433C3.3912 5.8396 6.30918 3.90749 9.47509 3.7592Z">
                                                    </path>
                                                    <path
                                                        d="M13.5807 10.0002C13.5807 11.9741 11.9742 13.5586 10.012 13.5586C8.04979 13.5586 6.44327 11.9741 6.44327 10.0002C6.44327 8.02617 8.04979 6.44176 10.012 6.44176C11.9742 6.44176 13.5807 8.02617 13.5807 10.0002ZM10.012 12.5169C11.4096 12.5169 12.5426 11.3901 12.5426 10.0002C12.5426 8.6102 11.4096 7.48342 10.012 7.48342C8.61438 7.48342 7.48138 8.6102 7.48138 10.0002C7.48138 11.3901 8.61438 12.5169 10.012 12.5169Z">
                                                    </path>
                                                </svg>
                                                <h2 class="h4 accordion__title inline-richtext">
                                                    Care Instruction
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
                                        <div class="accordion__content"
                                            id="ProductAccordion-collapsible-row-2-template--22125670007096__main">
                                            <p><strong>Wash &amp; Care:</strong></p>
                                            <ul>
                                                <li>Do not iron directly on the print</li>
                                                <li>Always turn your garment&nbsp;<em>INSIDE
                                                        OUT&nbsp;</em>before&nbsp;<strong>washing &amp;
                                                        drying&nbsp;</strong>to prevent fading</li>
                                                <li>Hand/Machine wash with similar clothes
                                                    in&nbsp;<em>COLD</em>&nbsp;water</li>
                                                <li>Dry on a flat surface as hanging may cause measurement variations
                                                </li>
                                            </ul>

                                        </div>
                                    </details>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </main>

        <!-- viewCart popup Modal -->
        <div class="modal fade" id="viewCartModal" tabindex="-1" aria-labelledby="viewCartModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewCartModalLabel">
                            <svg class="icon icon-checkmark" aria-hidden="true" focusable="false"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 9" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.35.643a.5.5 0 01.006.707l-6.77 6.886a.5.5 0 01-.719-.006L.638 4.845a.5.5 0 11.724-.69l2.872 3.011 6.41-6.517a.5.5 0 01.707-.006h-.001z"
                                    fill="currentColor"></path>
                            </svg> Item added to your cart
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                class="icon icon-close" fill="none" viewBox="0 0 18 17">
                                <path
                                    d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z"
                                    fill="currentColor">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="product-info">
                            <div class="product-view">
                                <div class="product-media">
                                    <img id="modalProductImage" src="" class="img-fluid" alt=""
                                        loading="lazy" width="100" height="100">
                                </div>
                                <div class="product-desc">
                                    <p id="cartCount"></p>
                                    <p id="modalProductName" class="product-name"></p>
                                    <div id="modalProductSize" class="product-size"></div>
                                    <div id="modalProductColor" class="product-color"></div>
                                </div>
                            </div>
                            <div class="product-links">
                                <a href="{{ url('cart') }}" class="btn-sec">View Cart</a>
                                <a href="" class="btn-main">Check out</a>
                                <a href="{{ url('/') }}" class="link--text text-center">Continue shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- featured product -->
        @if ($related_product->count())
            <div class="related-prod pt-md-5">
                <div class="container page--width">
                    <h2 class="page--title">You may also like</h2>
                    <div class="row products--row">

                        @foreach ($related_product as $pro)
                            <div class="col-lg-3 col-6 col-md-4">
                                <div class="ccd-card">
                                    <div class="ccd-card__media">
                                        <img src="{{ asset('admin-files/products/' . $pro->main_img) }}"
                                            class="ccd-card__img" alt="{{ $pro->slug }}" loading="lazy">
                                    </div>
                                    <div class="ccd-card__content">
                                        <h4 class="ccd-card__title">
                                            <a href="{{ route('product.show', ['slug' => $pro->slug]) }}"
                                                class="link link--hover">{{ $pro->product_name }}</a>
                                        </h4>
                                        <p class="ccd-card__info">
                                            <span class="ccd-card__org">Rs {{ $pro->actual_price }}</span>
                                            <span class="ccd-card__sell">Rs {{ $pro->offer_price }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="ccd-card__link text-center">
                        <a href="#" class="btn-main">See more</a>
                    </div>
                </div>
            </div>
        @endif

    </section>

@endsection

@push('scripts')
    <script>
        const swiper = new Swiper('#product__swiper-mob', {
            "autoplay": {
                "delay": 5000
            },
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": false,
            "pagination": {
                "el": '.swiper-pagination',
                "clickable": true,
            },
            "breakpoints": {
                "320": {
                    "slidesPerView": 1,
                    "slidesPerGroup": 1,
                    "spaceBetween": 10
                },

            },
            grabCursor: true,
        });
    </script>
@endpush
