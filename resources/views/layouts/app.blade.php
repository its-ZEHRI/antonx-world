<!doctype html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('public/images/logo_@3x.png') }}">
    <!-- Page Title  -->
    <title>AntonX Dashboard | AntonX Private Limited</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/dashlite.css?ver=2.2.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('public/assets/css/theme.css?ver=2.2.0') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Style for custome scroll bar -->
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        #book_row:nth-child(1) {
            border-right: 3px solid #bdbcbc;
        }
    </style>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('includes.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('includes.header')
                <!-- main header @e -->
                <!-- content @s -->
                @yield('content')
                <!-- content @e -->
                <!-- footer @s -->

                @include('includes.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('public/assets/js/bundle.js?ver=2.2.0') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.js?ver=2.2.0') }}"></script>
    <script src="{{ asset('public/assets/js/example-chart.js?ver=2.2.0') }}"></script>
    <script src="{{ asset('public/assets/js/charts/chart-ecommerce.js?ver=2.2.0') }}"></script>
    {{-- <script src="{{ asset('public/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script> --}}

    <!-- Custom JS File -->
    <script src="{{ asset('public/assets/js/ajax.js') }}"></script>
    <script src="{{ asset('public/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    {{-- <script src="{{ asset('public/assets/bundles/jquery-ui/jquery-ui.min.js') }}" defer></script> --}}
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    @yield('footer_scripts')

</body>

</html>
