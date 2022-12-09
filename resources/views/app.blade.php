<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- favicon.ico -->
        <link rel="icon" type="image/x-icon" href="{{ global_asset('images/favicon.ico')}}">

        <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            <!-- <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script> -->
        @endenv

        <div id="full_loader" class="flex items-center justify-center fixed  top-0 bottom-0 left-0 right-0 m-auto  bg-black opacity-75">

            <div class="w-40 h-40 border-t-4 border-b-4 border-blue-900 rounded-full animate-spin"></div>
        </div>
    </body>

    <style>
        #full_loader{
            display: none;
            z-index: 99999;
        }
    </style>

</html>
