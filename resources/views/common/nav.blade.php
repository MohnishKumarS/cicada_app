<!-- ccd header -->
<header class="ccd-nav">
        <div class="container page--width">
            <div class="ccd-nav__top">
                <nav>
                    <ul class="ccd-nav__items">
                        <li class="ccd-nav__item">
                            <a class="ccd-nav__link menu--link" data-bs-toggle="offcanvas" href="#header-menu--slider">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                    class="menu--icon icon icon-hamburger" fill="none" viewBox="0 0 18 16">
                                    <path
                                        d="M1 .5a.5.5 0 100 1h15.71a.5.5 0 000-1H1zM.5 8a.5.5 0 01.5-.5h15.71a.5.5 0 010 1H1A.5.5 0 01.5 8zm0 7a.5.5 0 01.5-.5h15.71a.5.5 0 010 1H1a.5.5 0 01-.5-.5z"
                                        fill="currentColor">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="ccd-nav__item">
                            <a href="{{url('/')}}" class="ccd-nav__link">
                                <img src="{{asset('images/logo.avif')}}" class="ccd-nav__brand" alt="cicada-logo">
                            </a>
                        </li>
                        <li class="ccd-nav__item">
                            <a href="{{route('account')}}" class="ccd-nav__link menu--link">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                    class="menu--icon icon icon-account" fill="none" viewBox="0 0 18 19">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6 4.5a3 3 0 116 0 3 3 0 01-6 0zm3-4a4 4 0 100 8 4 4 0 000-8zm5.58 12.15c1.12.82 1.83 2.24 1.91 4.85H1.51c.08-2.6.79-4.03 1.9-4.85C4.66 11.75 6.5 11.5 9 11.5s4.35.26 5.58 1.15zM9 10.5c-2.5 0-4.65.24-6.17 1.35C1.27 12.98.5 14.93.5 18v.5h17V18c0-3.07-.77-5.02-2.33-6.15-1.52-1.1-3.67-1.35-6.17-1.35z"
                                        fill="currentColor">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{route('cart.show')}}" class="ccd-nav__link menu--link position-relative">
                                <svg class="menu--icon icon icon-cart" aria-hidden="true" focusable="false"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M20.5 6.5a4.75 4.75 0 00-4.75 4.75v.56h-3.16l-.77 11.6a5 5 0 004.99 5.34h7.38a5 5 0 004.99-5.33l-.77-11.6h-3.16v-.57A4.75 4.75 0 0020.5 6.5zm3.75 5.31v-.56a3.75 3.75 0 10-7.5 0v.56h7.5zm-7.5 1h7.5v.56a3.75 3.75 0 11-7.5 0v-.56zm-1 0v.56a4.75 4.75 0 109.5 0v-.56h2.22l.71 10.67a4 4 0 01-3.99 4.27h-7.38a4 4 0 01-4-4.27l.72-10.67h2.22z">
                                    </path>
                                </svg>
                                <div class="ccd-cart__count">
                                    <span class="ccd-cart__num">0</span>
                                </div>
                            </a>

                        </li>
                    </ul>
                </nav>
            </div>
            <div class="ccd-nav__bottom sm-hide">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{'/'}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('collections')}}">All Collections</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item link link--hover" href="#">Action</a></li>
                            <li><a class="dropdown-item link link--hover" href="#">Another action</a></li>
                            <li><a class="dropdown-item link link--hover" href="#">Something else</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </header>


      <!-- header slider menu -->
      <div class="offcanvas offcanvas-start ccd-nav--menu" tabindex="-1" id="header-menu--slider">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title ccd-menu__title">
                <div class="ccd-menu__brand">
                    <img src="{{asset('images/cicada.webp')}}" class="img-fluid ccd-menu__logo" width="100" height="100"
                        alt="cicada-logo">
                </div>
                <div class="ccd-menu__head">
                    Cicada
                </div>
            </h5>
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
        <div class="offcanvas-body p-0">
            <ul class="ccd-menu__items">
                <li class="ccd-menu__item">
                    <a href="{{'/'}}" class="ccd-menu__link active">Home</a>
                </li>
                <li class="ccd-menu__item">
                    <a href="{{'all-collections'}}" class="ccd-menu__link">ALl Collections</a>
                </li>
                <li class="ccd-menu__item">
                    <a href="products.html" class="ccd-menu__link">All Product</a>
                </li>
                <li class="ccd-menu__item">
                    <a href="product.html" class="ccd-menu__link">Product</a>
                </li>


            </ul>
        </div>
        <div class="offcanvas-footer">
            <div class="ccd-menu__bottom">
                @auth
                <a href="{{route('logout')}}" class="ccd-menu__bottom-link menu--link" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                        class="menu--icon icon-account" fill="none" viewBox="0 0 18 19">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 4.5a3 3 0 116 0 3 3 0 01-6 0zm3-4a4 4 0 100 8 4 4 0 000-8zm5.58 12.15c1.12.82 1.83 2.24 1.91 4.85H1.51c.08-2.6.79-4.03 1.9-4.85C4.66 11.75 6.5 11.5 9 11.5s4.35.26 5.58 1.15zM9 10.5c-2.5 0-4.65.24-6.17 1.35C1.27 12.98.5 14.93.5 18v.5h17V18c0-3.07-.77-5.02-2.33-6.15-1.52-1.1-3.67-1.35-6.17-1.35z"
                            fill="currentColor">
                        </path>
                    </svg> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a href="{{route('login')}}" class="ccd-menu__bottom-link menu--link">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                        class="menu--icon icon-account" fill="none" viewBox="0 0 18 19">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 4.5a3 3 0 116 0 3 3 0 01-6 0zm3-4a4 4 0 100 8 4 4 0 000-8zm5.58 12.15c1.12.82 1.83 2.24 1.91 4.85H1.51c.08-2.6.79-4.03 1.9-4.85C4.66 11.75 6.5 11.5 9 11.5s4.35.26 5.58 1.15zM9 10.5c-2.5 0-4.65.24-6.17 1.35C1.27 12.98.5 14.93.5 18v.5h17V18c0-3.07-.77-5.02-2.33-6.15-1.52-1.1-3.67-1.35-6.17-1.35z"
                            fill="currentColor">
                        </path>
                    </svg> Login
                </a>
                @endauth
             
            </div>
        </div>
    </div>
