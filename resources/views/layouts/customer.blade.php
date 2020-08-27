<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ 'Welcome to the '.ucfirst($store->store_name) }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/'.$store->store_name) }}">
                        @empty($store->store_logo)
                            <img src="{{ '/demo_images/shop_black.png' }}" width="32" height="32">
                        @else
                            <img src="{{ '/storage/'.$store->store_logo }}" width="32" height="32">
                        @endempty
                        &nbsp;{{ ucfirst($store->store_name) }}
                    </a>
                </div>
            </nav>

            <main class="py-4 mt-5">
                @yield('content')
            </main>
        </div>
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-bottom">
            <div class="container">
                <span class="text-muted">{{ ucfirst($store->store_name).' Store' }} &copy; <?php echo date("Y"); ?></span>
            </div>
        </nav> -->
    </body>
</html>
