
<section>
    <div class="container page--width">
        <h2 class="page--title">Top Featured Drop</h2>
        <div class="ccd-product-slider">
            <div class="swiper" id="productSwiper">
                <div class="swiper-wrapper">
                   
                    @foreach ($featuredProducts as $product)
                        <div class="swiper-slide">
                            <div class="ccd-card">
                                <div class="ccd-card__media">
                                    <img src="{{ asset('admin-files/products/' . $product->main_img) }}" 
                                         class="ccd-card__img" 
                                         alt="{{ $product->product_name }}" 
                                         loading="lazy">
                                </div>
                                <div class="ccd-card__content">
                                    <h4 class="ccd-card__title">
                                        {{-- <a href="" class="link link--hover">{{ $product->product_name }}</a> --}}
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
             
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
