<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/cicada.webp') }}" type="image/x-icon">

    <title>Cicada | Dashboard</title>

    {{-- css stylesheet  --}}
    @include('admin.links.styles')
    @stack('styles')

</head>

<body>
    <div class="wrapper">

        @include('admin.components.sidebar')
        <div class="main-panel">

            @include('admin.components.header')
            <div class="container">
                <div class="page-inner">
                    @yield('content')

                </div>
            </div>

            @include('admin.components.footer')
        </div>

    </div>




    {{-- js script  --}}
    @include('admin.links.scripts')
    @stack('scripts')

</body>

</html>