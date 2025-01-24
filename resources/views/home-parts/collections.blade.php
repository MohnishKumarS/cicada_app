@extends('layouts.main')

@section('content')

    <!-- product collections -->
    <section>
        <div class="ccd-product-shop">
            <div class="container">
                <h1 class="page--head animate__animated animate__bounce animate__delay-2s">Collections</h1>
                @if ($category_collections->count() > 0)
                <div class="ccd-product-shop__items">
                    <div class="row products--row">
                        @foreach ($category_collections as $category)
                        <div class="col-lg-4 col-6 col-md-4">
                            <div class="ccd-card">
                                <div class="ccd-card__media">
                                    <img src="{{ asset('admin-files/category/' . $category->category_image) }}" class="ccd-card__img" alt="category-img"
                                        loading="lazy">
                                </div>
                                <h3 class="ccd-card__head">
                                    <a href="{{ route('category.show', ['slug' => $category->slug]) }}" class="link">{{$category->category_name}}
                                        <span class="icon-wrap">
                                            <svg viewBox="0 0 14 10" fill="none" aria-hidden="true" focusable="false"
                                                class="icon icon-arrow" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.537.808a.5.5 0 01.817-.162l4 4a.5.5 0 010 .708l-4 4a.5.5 0 11-.708-.708L11.793 5.5H1a.5.5 0 010-1h10.793L8.646 1.354a.5.5 0 01-.109-.546z"
                                                    fill="currentColor">
                                                </path>
                                            </svg>
                                        </span></a>
                                </h3>

                            </div>
                        </div>
                        @endforeach
                      

                    </div>
                </div>
                @else
                <div class="ccd--empty" >
                    <div class="ccd-empty__icon">
                        <img src="{{asset('images/cicada.webp')}}" class="img-fluid ccd-empty__logo" width="100" height="100"
                            alt="cicada-logo">
                    </div>
                    <h3 class="ccd-empty__title page--head">Collection is Not Available Yet!</h3>
                    <div class="ccd-empty__link">
                        <a href="{{url('collections')}}" class="btn-main">Return to Shop</a>
                    </div>
                </div>
                @endif
             
            </div>
        </div>
    </section>

    @endsection