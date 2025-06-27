@extends('layouts.main')


@section('content')
    <!-- hero banner -->
    {{-- <section>
        <div class="ccd-banners">
            <div class="">
                <div class="ccd-banner__mob lg-hide">
                    <div class="swiper" id="banner__swiper-mob">
                        <div class="swiper-wrapper">
                         

                            @forelse ($mobBanner as $val)
                                <div class="swiper-slide">

                                    <div class="product__media-pic">
                                        <img src="{{ asset('admin-files/banners/' . $val->image) }}"
                                            class="product__media-pic img-fluid" alt="product-img" loading="lazy">
                                    </div>

                                </div>
                            @empty
                                <div class="swiper-slide">

                                    <div class="product__media-pic">
                                        <img src="{{ asset('images/b3.jpg') }}" class="product__media-pic img-fluid"
                                            alt="product-img" loading="lazy">
                                    </div>

                                </div>
                                <div class="swiper-slide">

                                    <div class="product__media-pic">
                                        <img src="{{ asset('images/b1.jpg') }}" class="product__media-pic img-fluid"
                                            alt="product-img" loading="lazy">
                                    </div>

                                </div>
                            @endforelse


                        </div>
                        
                        <div class="swiper-pagination"></div> 

                    </div>
                </div>
               
                <div class="ccd-banner__desk sm-hide">
                    <div class="ccd-banner__slide">
                        @if ($deskBanner)
                            <img src="{{ asset('admin-files/banners/' . $deskBanner->image) }}"
                                class="ccd-banner__img img-fluid" alt="" loading="lazy">
                        @else
                            <img src="{{ asset('images/b6.jpg') }}" class="ccd-banner__img img-fluid" alt=""
                                loading="lazy">
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- hero text -->
    {{-- <section>
        <div class="container">
            <div class="ccd-hero-txt">
                <h1 class="ccd-hero-txt__title">Discover "Be Greatness" with CICADA</h1>
                <p class="ccd-hero-txt__desc">
                    we trace each step that leads them to greatness
                </p>
                <!-- <a href="products.html" class="btn btn--primary">Shop Now</a> -->
            </div>
        </div>
    </section>
    <style>
        .ccd-hero-txt {
            font-family: Helvetica, Arial, sans-serif;
            padding: 100px 20px 0;
            text-align: center;

            .ccd-hero-txt__title {
                font-size: 50px;
                margin-bottom: 20px;
            }

            .ccd-hero-txt__desc {
                color: #b2b2b2;
                font-size: 18px;
            }

            @media (max-width: 576px) {
                & {
                    padding-top: 50px
                }

                .ccd-hero-txt__title {
                    font-size: 28px;
                }

            }
        }
    </style> --}}
    <section>
        <div class="ccd-text-anime">
            <div>discover “be greatness” with cicada</div>
            <div>seacada - engineered compressions</div>
            {{-- <div>Dive into the world of Cicada</div> --}}
            <div>cicada - timeless through every season</div>
            <div>seacada - power. precision. performance</div>
        </div>
    </section>
    
    <style>
        /* hero text anime */
        .ccd-text-anime {
            font-family: 'Arial', sans-serif;
            background: #000;
            color: #fff;
            width: 100vw;
            height: 40vh;
            font-weight: 500;
            font-size: 28px;
            position: relative;
            overflow: hidden;
            line-height: 1
        }
    
        .ccd-text-anime>div {
            animation: come2life linear 10s infinite;
            transform-origin: center center;
            opacity: 0;
            width: 250px;
            height: 200px;
            position: absolute;
            backface-visibility: hidden;
        }
    
        .ccd-text-anime>div:nth-child(1) {
            left: 30vw;
            top: 10vh;
            animation-delay: 0s;
        }
    
        .ccd-text-anime>div:nth-child(2) {
            left: 10vw;
            top: 20vh;
            animation-delay: 4s;
        }
    
        .ccd-text-anime>div:nth-child(3) {
            left: 20vw;
            top: 20vh;
            animation-delay: 8s;
        }
    
        .ccd-text-anime>div:nth-child(4) {
            left: 25vw;
            top: 10vh;
            animation-delay: 6s;
        }
    
        .ccd-text-anime>div:nth-child(5) {
            left: 40vw;
            top: 30vh;
            animation-delay: 2s;
        }
    
        @keyframes come2life {
            0% {
                transform: scale3d(0, 0, 1) rotate(0.02deg);
                opacity: 0;
                filter: blur(10px);
            }
    
            25% {
                transform: scale3d(1, 1, 1) rotate(0.02deg);
                opacity: 1;
                filter: blur(0px);
            }
    
            40% {
                opacity: 1;
                filter: blur(0px);
            }
    
            80% {
                opacity: 0;
            }
    
            100% {
                transform: scale3d(3, 3, 1) rotate(0.02deg);
                filter: blur(10px);
            }
        }
    </style>

    @include('home-parts.featureProduct', ['featuredProducts' => $featuredProducts])


    <!-- brands -->
    @if ($brands->count())
        <section>
            <div class="ccd-brand">
                <div class="container page--width">
                    @forelse ($brands as $brand)
                        <div class="brand-section">
                            <h2 class="page--title">{{ $brand->brand_name }}</h2>
                            <div class="ccd-brand__wrap text-center">
                                <div class="ccd-brand__poster">
                                    <img src="{{ asset('admin-files/brands/brand-img/' . $brand->brand_img) }}"
                                        class="ccd-brand__img img-fluid" alt="{{ $brand->brand_name }}">
                                </div>
                                <div class="ccd-brand__link mt-4">
                                    <a href="{{ route('brandproducts', ['slug' => $brand->slug]) }}" class="btn-main">Shop
                                        now</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No brands available at the moment.</p>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    {{-- latest trend --}}
    @if ($latestProducts->count())
        <section>
            <div class="container page--width">

                <h2 class="page--title text-capitalize">Latest Collections</h2>
                <div class="row mb-2 products--row">
                    @foreach ($latestProducts as $product)
                        <div class="col-lg-3 col-6 col-md-4">
                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="">
                                <div class="ccd-card">
                                    <div class="ccd-card__media">
                                        <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                            class="ccd-card__img" alt="{{ $product->slug }}" loading="lazy">
                                    </div>
                                    <div class="ccd-card__content">
                                        <h3 class="ccd-card__title">
                                            {{ $product->product_name }}
                                        </h3>
                                        <p class="ccd-card__info">
                                            <span class="ccd-card__org">Rs {{ $product->actual_price }}</span>
                                            <span class="ccd-card__sell">Rs {{ $product->offer_price }}</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                {{-- "See more" button --}}
                <div class="ccd-card__link text-center">
                    <a href="{{ route('collections') }}" class="btn-main">Explore Now</a>
                </div>


            </div>
        </section>
    @endif




    {{-- category and its products --}}
    {{-- <section>
        <div class="container page--width">
            @foreach ($category_products as $category)
                <h2 class="page--title text-capitalize">{{ $category->category_name }}</h2>
                <div class="row mb-2 products--row">
                    @foreach ($category->product->take(4) as $product)
                        <div class="col-lg-3 col-6 col-md-4">
                            <div class="ccd-card">
                                <div class="ccd-card__media">
                                    <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                        class="ccd-card__img" alt="{{ $product->product_name }}" loading="lazy">
                                </div>
                                <div class="ccd-card__content">
                                    <h3 class="ccd-card__title">
                                        <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                            class="link link--hover">
                                            {{ $product->product_name }}
                                        </a>
                                    </h3>
                                    <p class="ccd-card__info">
                                        <span class="ccd-card__org">Rs {{ $product->actual_price }}</span>
                                        <span class="ccd-card__sell">Rs {{ $product->offer_price }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                @if ($category->product->count() > 0)
                    <div class="ccd-card__link text-center">
                        <a href="{{ route('category.show', ['slug' => $category->slug]) }}" class="btn-main">See more</a>
                    </div>
                @endif
            @endforeach
        </div>
    </section> --}}

    <!-- mobile app links -->
    <section class="ccd-apps_section">
        <div class="container page--width">
            <div class="ccd-apps">
                <div class="row  justify-content-center align-items-center">
                    <div class="col-lg-7">
                        <div class="ccd-apps_text text-center text-lg-start">
                            <h2 class="ccd-apps_title page--head">Shop Anywhere</h2>
                            <p class="ccd-apps_desc">All through our mobile app.
                                Available now on iOS and Android.</p>
                            {{-- <div class="ccd-apps_links">
                                <a href="https://play.google.com/store/apps/details?id=com.cicada.app"
                                    class="ccd-apps_link">
                                    <img src="{{ asset('images/apps/Google-play-logo.png') }}" alt="Google Play"
                                        class="img-fluid">
                                </a>
                                <a href="https://apps.apple.com/us/app/cicada/id123456789" class="ccd-apps_link">
                                    <img src="{{ asset('images/apps/App-Store-logo.png') }}" alt="App Store"
                                        class="img-fluid">
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-5 sm-hide">
                        <div class="ccd-apps_media text-center">
                            <img src="{{ asset('images/apps/Mobile-app.png') }}" class="img-fluid"
                                alt="cicada-mobile-apps">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* mobile apps */
        .ccd-apps_section {
            padding: 100px 0;
            /* background: linear-gradient(180deg, #ffffff 0%, rgba(0, 0, 0, 0) 100%); */
            background-color: #000000;
            /* background-image: url('images/apps/bg-slice.png'); */
            background-position: 50% 0%;
            background-repeat: no-repeat;
            background-size: contain;
            position: relative;
            z-index: 1;

            .ccd-apps {
                .ccd-apps_text {
                    .ccd-apps_title {
                        text-transform: uppercase;
                        margin-top: 0;
                        font-weight: 700;
                    }

                    .ccd-apps_desc {
                        /* margin-bottom: 30px; */
                        text-align: justify;
                    }

                    .ccd-apps_links {
                        display: flex;
                        gap: 20px;

                        .ccd-apps_link {
                            transition: all 0.3s ease;

                            &:hover {
                                transform: translateY(-5px);
                            }
                        }


                        img {
                            width: 140px;
                        }


                    }
                }

                .ccd-apps_media {
                    background-image: url('images/apps/Vector-mask.svg');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: contain;

                    img {
                        width: 270px;
                    }
                }
            }

            @media (max-width:991px) {
                & {
                    padding: 50px 0;
                }

                & .ccd-apps_links {
                    justify-content: center !important;
                }

            }
        }
    </style>

@endsection

@push('scripts')
    <script>
        const swiperBanner = new Swiper('#banner__swiper-mob', {
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

                // "1200": {
                //     "slidesPerView": 4,
                //     "slidesPerGroup": 1,
                //     "spaceBetween": 60,
                //     "pagination": false
                // }
            },
            grabCursor: true,
        });
    </script>
@endpush
