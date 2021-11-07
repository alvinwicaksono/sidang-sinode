<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sinode GKJ</title>
        <link rel="icon" type="image/png" href="assets/img/GKJ.png"/>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ckeditor.css') }}">

        @livewireStyles
        

        <!-- Scripts -->

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/trix.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" defer></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
        <script src="{{ asset('assets/js/allFontawesome.js') }}" defer></script>
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        

        @if (config('sweetalert.alwaysLoadJS') === true && config('sweetalert.neverLoadJS') === false )
            <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
        @endif
        @if (Session::has('alert.config'))
            @if(config('sweetalert.animation.enable'))
                <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
            @endif
            @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
                <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
            @endif
            <script>
                Swal.fire({!! Session::pull('alert.config') !!});
            </script>
        @endif


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @include('sweetalert::alert')
        <script>
            window.livewire.on('alert', param=>{
                toastr[param['type']](param['message'],param['title']);
            });
        </script>

        <!-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">
                    $(document).ready(function () {
                        $('.ckeditor').ckeditor();
                    });
        </script> -->

<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

    </body>

</html>
