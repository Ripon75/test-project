<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    {{-- Social media css --}}
    <link rel="stylesheet" href="{{ asset("css/social-media.css") }}">

    <title> @yield('title')</title>

    @stack('styles')
</head>

<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Social media -->
    <a href="#" class="float">
        <i class="fa fa-plus icon"></i>
    </a>
    <div class="submenu">
        <div>
            <a href="https://m.me/riponahmedjr" target="_blank">
                <i class="fa-brands fa-facebook-messenger icon"></i>
            </a>
        </div>
        <div>
            <a href="https://wa.me/+8801764997485" target="_blank">
                <i class="fa-brands fa-whatsapp icon"></i>
            </a>
        </div>
    </div>
    <!-- End social media -->

    {{-- Load script --}}
    @include("admin.layout.script")

    {!! Toastr::message() !!}

    @stack('scripts')
</body>
</html>
