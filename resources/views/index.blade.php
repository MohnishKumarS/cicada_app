@extends('layouts.main')

    
@section('content')

<!-- hero banner -->
<section>
        <div class="ccd-banners">
            <div class="">
                <div class="ccd-banner__mob lg-hide">
                    <div class="swiper" id="banner__swiper-mob">
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @forelse ($mobBanner as $val)
                            <div class="swiper-slide">

                                <div class="product__media-pic">
                                    <img src="{{ asset('admin-files/banners/'.$val->image) }}" class="product__media-pic img-fluid"
                                        alt="product-img" loading="lazy">
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
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                    </div>
                </div>
                {{-- desk view --}}
                <div class="ccd-banner__desk sm-hide">
                    <div class="ccd-banner__slide">
                        @if ($deskBanner)
                        <img src="{{ asset('admin-files/banners/'.$deskBanner->image) }}" class="ccd-banner__img img-fluid" alt="" loading="lazy">
                        @else
                        <img src="{{ asset('images/b6.jpg') }}" class="ccd-banner__img img-fluid" alt="" loading="lazy">
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                 class="ccd-brand__img img-fluid"  alt="{{ $brand->brand_name }}">
                        </div>
                        <div class="ccd-brand__link mt-4">
                            <a href="{{ route('brandproducts', ['slug' => $brand->slug]) }}" class="btn-main">Shop now</a>
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



    {{-- category and its products --}}
    <section>
        <div class="container page--width">
            @foreach($category_products as $category)
            <h2 class="page--title text-capitalize">{{ $category->category_name }}</h2>
                <div class="row mb-2 products--row">
                    @foreach($category->product->take(4) as $product) 
                        <div class="col-lg-3 col-6 col-md-4">
                            <div class="ccd-card">
                                <div class="ccd-card__media">
                                    <img src="{{ asset('admin-files/products/' . $product->main_img) }}" 
                                         class="ccd-card__img" 
                                         alt="{{ $product->product_name }}" 
                                         loading="lazy">
                                </div>
                                <div class="ccd-card__content">
                                    <h4 class="ccd-card__title">
                                        <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="link link--hover">
                                            {{ $product->product_name }}
                                        </a>
                                    </h4>
                                    <p class="ccd-card__info">
                                        <span class="ccd-card__org">Rs {{ $product->actual_price }}</span>
                                        <span class="ccd-card__sell">Rs {{ $product->offer_price }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                {{-- "See more" button--}}
                @if($category->product->count() > 0)
                    <div class="ccd-card__link text-center">
                        <a href="{{ route('category.show', ['slug' => $category->slug]) }}" class="btn-main">See more</a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    


   

    
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
