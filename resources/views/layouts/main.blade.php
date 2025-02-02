<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="cicada">
    <link rel="shortcut icon" href="{{ asset('images/cicada.webp') }}" type="image/x-icon">

    <title>Cicada | Where Bold Streetwear Meets Creative Expression</title>
    <meta name="title" content="Cicada | Where Bold Streetwear Meets Creative Expression" />
    <meta name="description"
        content="Step into the world of Cicada, where streetwear meets fearless creativity. Experience innovative designs crafted with artistry and attitude, pushing the boundaries of modern fashion." />


    <!-- css -->
    @include('links.styles')

    <script src="{{ asset('js/main.js') }}"></script>
    <!-- styles -->
    @stack('styles')

</head>

<body>
    <!-- cdd preloader -->
    {{-- <div id="preloader">
        <img src="{{ asset('images/cicada.webp') }}" alt="loading-logo" class="preload-logo">
    </div> --}}
    <!-- navbar -->
    @include('common.nav')

    <!-- content of the page -->
    <main class="page-wrapper">
        @yield('content')
    </main>

    <!-- footer -->
    @include('common.footer')


    <!-- js -->
    @include('links.scripts')
    <!-- scripts -->
    @stack('scripts')


    <script>
    // Check if the element with ID 'productSwiper' exists
if (document.querySelector('#productSwiper')) {
    const swiper = new Swiper('#productSwiper', {
        // autoplay: {
        //     delay: 5000,
        // },
        slidesPerView: 4,
        slidesPerGroup: 4,
        effect: "none",
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 2,
                slidesPerGroup: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                slidesPerGroup: 1,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 4,
                slidesPerGroup: 1,
                spaceBetween: 24,
            },
            // 1200: {
            //     slidesPerView: 4,
            //     slidesPerGroup: 1,
            //     spaceBetween: 60,
            //     pagination: false,
            // },
        },
        grabCursor: true,
    });
} 

    </script>


    <!-- add Scripts -->

</body>

</html>