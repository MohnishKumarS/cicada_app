   @extends('layouts.main')


   @section('content')
       <!-- all products -->
       <section>
           <div class="container page--width">
               <div class="ccd--products">

                   @if ($category)
                       <h1
                           class="page--head text-center animate__animated animate__bounce animate__delay-2s text-capitalize">
                           {{ $category->category_name }}</h1>
                   @else
                       <h1
                           class="page--head text-center animate__animated animate__bounce animate__delay-2s text-capitalize">
                           {{ $brand->brand_name }}</h1>
                   @endif


                   <div class="products-body">
                       <div class="products__filters row">
                           <div class="col">
                               <div class="products__filters-lt" data-bs-toggle="offcanvas"
                                   data-bs-target="#ccd--filterSlider">
                                   <svg class="icon icon-filter" aria-hidden="true" focusable="false"
                                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                                       <path fill-rule="evenodd"
                                           d="M4.833 6.5a1.667 1.667 0 1 1 3.334 0 1.667 1.667 0 0 1-3.334 0ZM4.05 7H2.5a.5.5 0 0 1 0-1h1.55a2.5 2.5 0 0 1 4.9 0h8.55a.5.5 0 0 1 0 1H8.95a2.5 2.5 0 0 1-4.9 0Zm11.117 6.5a1.667 1.667 0 1 0-3.334 0 1.667 1.667 0 0 0 3.334 0ZM13.5 11a2.5 2.5 0 0 1 2.45 2h1.55a.5.5 0 0 1 0 1h-1.55a2.5 2.5 0 0 1-4.9 0H2.5a.5.5 0 0 1 0-1h8.55a2.5 2.5 0 0 1 2.45-2Z"
                                           fill="currentColor"></path>
                                   </svg> <span class="link--hover">Filter and sort</span>
                               </div>
                           </div>
                           <div class="col">
                               <div class="products__filters-rt">{{ $products->count() }} products</div>
                           </div>
                       </div>
                       <div class="products__container mt-3">
                           <!-- Product cards here -->
                           <div class="row products--row">
                               @foreach ($products as $product)
                                   <div class="col-lg-3 col-6 col-md-4">
                                       <div class="ccd-card animate__animated animate__fadeIn animate__delay-3s ">
                                           <div class="ccd-card__media">
                                               <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                                   class="ccd-card__img" alt="{{ $product->slug }}" loading="lazy">
                                           </div>
                                           <div class="ccd-card__content">
                                               <h4 class="ccd-card__title">
                                                   <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                       class="link link--hover">{{ $product->product_name }}</a>
                                               </h4>
                                               <p class="ccd-card__info">
                                                   <span class="ccd-card__org">Rs. {{ $product->actual_price }}</span>
                                                   <span class="ccd-card__sell">Rs. {{ $product->offer_price }}</span>
                                               </p>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>


       <!-- filter slider -->
       <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="ccd--filterSlider">
           <div class="offcanvas-header">
               <h5 class="offcanvas-title">Filters <span>({{ $products->count() }} products)</span></h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                   <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="icon icon-close"
                       fill="none" viewBox="0 0 18 17">
                       <path
                           d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z"
                           fill="currentColor">
                       </path>
                   </svg>
               </button>
           </div>
           <form action="{{ URL::current() }}" method="GET">
               <div class="offcanvas-body">
                   <h6 class="offcanvas-body__head">Sort By:</h6>
                   <div class="offcanvas-body__sort">
                       <div class="form-check">
                           <input class="form-check-input" type="radio" name="sortBy" value="featured"
                               {{ Request::get('sortBy') == 'featured' ? 'checked' : '' }}>
                           <label class="form-check-label offcanvas-body__name">
                               Featured
                           </label>
                       </div>
                       <div class="form-check">
                           <input class="form-check-input" type="radio" name="sortBy" value="latestsell"
                               {{ Request::get('sortBy') == 'latestsell' ? 'checked' : '' }}>
                           <label class="form-check-label offcanvas-body__name">
                               Latest Selling
                           </label>
                       </div>
                       <div class="form-check">
                           <input class="form-check-input" type="radio" name="sortBy" value="plow"
                               {{ request('sortBy') == 'plow' ? 'checked' : '' }}>
                           <label class="form-check-label offcanvas-body__name">
                               Price, low to high
                           </label>
                       </div>
                       <div class="form-check">
                           <input class="form-check-input" type="radio" name="sortBy" value="phigh"
                               {{ request('sortBy') == 'phigh' ? 'checked' : '' }}>
                           <label class="form-check-label offcanvas-body__name">
                               Price, high to low
                           </label>
                       </div>
                   </div>
               </div>
               <div class="offcanvas-footer">
                   <div class="row justify-content-center align-items-center text-center">
                       <div class="col">
                           <a href="{{ URL::current() }}" class="link--text">Remove all</a>
                       </div>
                       <div class="col">
                           <button type="submit" class="btn-main">Apply</button>
                       </div>
                   </div>
               </div>
           </form>
       </div>
   @endsection


