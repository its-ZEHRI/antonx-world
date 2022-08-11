<!DOCTYPE html>
<html lang="zxx" class="js">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('/images/logo_@3x.png') }}">
    <!-- Page Title  -->
    <title>AntonX Leaderboard | AntonX Private Limited</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('/assets/css/dashlite.css?ver=2.2.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/assets/css/theme.css?ver=2.2.0') }}">

    <!-- Style for custome scroll bar -->
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 2px;
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

        .text-black-500 {
            color: black !important;
            font-weight: 500 !important;
        }

        .width_height {
            height: 20px !important;
            width: 20px !important;
        }

        .radius_10 {
            border-radius: 10px !important;
        }

        .txt-green {
            color: #038867 !important;
        }
    </style>
</head>

<body class="nk-body bg-lighter npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main">

            <div class="nk-wrap bg-white">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light"
                    style="border-bottom:1px solid white; box-shadow: unset; background-color: #F6F9FC !important;">
                    <div class="container-fluid">
                        <div class="nk-header-wrap" style="margin-left: -10px">
                            <div class="nk-header-brand">
                                <a href="{{ route('home') }}" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('/images/logo_@3x.png') }}"
                                        srcset="{{ asset('/images/logo_@3x.png') }}" alt="logo"
                                        width="200">
                                    <img class="logo-dark logo-img" src="{{ asset('/images/logo_name_@3x.png') }}"
                                        srcset="{{ asset('/images/logo_name_@3x.png') }}" alt="logo-dark"
                                        width="">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-search ml-3 ml-xl-0">
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools mr-1">
                                <span class="text-primary font-weight-bolder">
                                    <em class="icon ni ni-calendar"></em>
                                    <b> {{ date('l,', strtotime(get_date())) }}</b></span>
                                <span class="mr-3"><b>{{ date('jS M', strtotime(get_date())) }}</b></span>
                                <em class="icon ni ni-clock"></em>
                                <b><span id="time_span"></span></b>
                                {{-- <a href="{{ url()->previous() }}"
                                    class="btn py-0 px-1 btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em></a>
                                <a href="{{ url()->previous() }}"
                                    class="btn py-0 px-1 btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a> --}}
                                <a href="#" class="btn btn-icon fullscreen-btn ml-2">
                                    <em class="icon ni ni-maximize" style="font-size: 2em;"></em>
                                </a>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content" style="margin-top: 20px !important;padding:20px 0px;">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block nk-block-lg">
                                    <div class="row g-gs pt-1" style="max-height: 100vh;">
                                        <div class="col-lg-6" style="height: 93vh; overflow: hidden;">
                                            <div class="card card-full" style="box-shadow:unset;">
                                                <div class="card-inner pb-1 px-2">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h4>Leaderboard</h4>
                                                        </div>
                                                        <div class="card-tools d-block text-right">
                                                            <div class="text-soft" style="font-size:12px">Showing
                                                                records from</div>
                                                            <span class="text-black-500">
                                                                <span>{{ date('D, d M', strtotime('-1 days')) }}</span>
                                                                to
                                                                <span>{{ date('D, d M', strtotime('31 days')) }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <marquee direction="up" scrolldelay="300">
                                                    <div class="card-inner pt-1">
                                                        <?php $i = 1; ?>
                                                        @foreach ($users as $user)
                                                            @if ($loop->iteration == 1)
                                                                <div class="row mb-1 py-1 radius_10"
                                                                    style="background-image: linear-gradient(to right,#FFD94A, #FFF3B1);">
                                                                @elseif ($loop->iteration == 2)
                                                                    <div class="row mb-1 py-1 radius_10"
                                                                        style="background-image: linear-gradient(to right,#D7D8C8,#F4F4F4);">
                                                                    @elseif ($loop->iteration == 3)
                                                                        <div class="row mb-1 py-1 radius_10"
                                                                            style="background-image: linear-gradient(to right,#F4AA6B, #FFD4B1);">
                                                                        @else
                                                                            <div class="row mb-1 py-1 radius_10"
                                                                                style="background-color:#F4F6FA;">
                                                            @endif

                                                            <div class="col-6 col-lg-7 align-center">
                                                                @if ($loop->iteration == 1)
                                                                    <div class="user-avatar sm mr-1 p-0 width_height"
                                                                        style="background-color: #FF7C22">
                                                                        <span>{{ $i++ }}</span>
                                                                    </div>
                                                                @elseif($loop->iteration == 2)
                                                                    <div class="user-avatar sm mr-1 p-0 width_height"
                                                                        style="background-color: #A1A08C">
                                                                        <span>{{ $i++ }}</span>
                                                                    </div>
                                                                @elseif($loop->iteration == 3)
                                                                    <div class="user-avatar sm mr-1 p-0 width_height"
                                                                        style="background-color: #C76C40">
                                                                        <span>{{ $i++ }}</span>
                                                                    </div>
                                                                @else
                                                                    @if ($user->user_streak->streak_up > 0)
                                                                        <div class="user-avatar sm mr-1 p-0 width_height-20"
                                                                            style="height:20px;width:20px;background:#16A085 !important;">
                                                                            <span>{{ $i++ }}</span>
                                                                        </div>
                                                                    @elseif($user->user_streak->streak_down > 0)
                                                                        <div class="user-avatar sm bg-danger mr-1 p-0 width_height-20"
                                                                            style="height: 20px;width: 20px;">
                                                                            <span>{{ $i++ }}</span>
                                                                        </div>
                                                                    @else
                                                                        <div class="user-avatar sm bg-gray-dim mr-1 p-0 width_height-20"
                                                                            style="height: 20px;width: 20px;">
                                                                            <span>{{ $i++ }}</span>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                <div class="user-card">
                                                                    <div class="user-avatar d-none d-sm-flex"
                                                                        style="border-radius: 25%;">
                                                                        <img src="{{ asset($user->image_url) }}"
                                                                            alt="User"
                                                                            style="width: 100%; height:100%;object-fit: cover;border-radius: 25%" />
                                                                    </div>
                                                                    <div class="text-black-500">
                                                                        <div style="font-weight: 900;font-size: 16px;">
                                                                            {{ $user->name }}</div>
                                                                        <div
                                                                            style="font-weight: 500; margin-top: -5px;">
                                                                            {{ isset($user->designation->title) ? $user->designation->title : 'AntonX Asset' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 col-lg-2 align-center justify-center">
                                                                <span>
                                                                    @if ($user->user_streak->streak > 0)
                                                                        <em
                                                                            class="icon ni ni-hot-fill text-danger"></em>
                                                                        <span class="text-black-500">
                                                                            {{ $user->user_streak->streak }}
                                                                        </span>
                                                                    @elseif ($user->user_streak->streak_up > 0)
                                                                        <em
                                                                            class="icon ni ni-chevron-up-circle txt-green"></em>
                                                                        <span class="txt-green">
                                                                            {{ $user->user_streak->streak_up }}
                                                                        </span>
                                                                        <span class="txt-green"> places </span>
                                                                    @elseif ($user->user_streak->streak_down > 0)
                                                                        <em
                                                                            class="icon ni ni-chevron-down-circle text-danger"></em>
                                                                        <span class="text-danger">
                                                                            {{ $user->user_streak->streak_down }}
                                                                        </span>
                                                                        <span class="text-danger"> places </span>
                                                                    @endif

                                                                </span>
                                                            </div>
                                                            <div
                                                                class="col-4 col-lg-3 align-center justify-end text-black-500">
                                                                <span class="text-right">
                                                                    <img class="mb-1"
                                                                        src="{{ asset('/images/icons/hourglass.svg') }}"
                                                                        alt="">
                                                                    <span style="padding: 0 1px">
                                                                        {{ seconds_to_hours($user->seconds) }}</span>
                                                                    <span class="">hours</span></span>
                                                            </div>
                                                    </div>
                                                    @endforeach
                                                </marquee>
                                            </div>
                                        </div><!-- .card -->
                                        {{-- </div> --}}
                                        <div class="col-lg-6">
                                            <div class="card card-preview" style="box-shadow:unset">
                                                <div class="card-inner pb-2">
                                                    <div class="card-title-group">
                                                        <div class="card-title card-title-sm">
                                                            <h4>Featured Users</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner pt-2">
                                                    <div class="example-carousel ">
                                                        <div id="carouselExCap" class="carousel slide"
                                                            data-ride="carousel">
                                                            <ol class="carousel-indicators align-center">
                                                                @foreach ($featured_users as $f_user)
                                                                    <li data-target="#carouselExCap"
                                                                        data-slide-to="{{ $loop->index }}"
                                                                        class="@if ($loop->first) active @endif "
                                                                        style="border-radius:50%;width: 8px; height: 8px; left:4%;bottom: 4%;">
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                            <div class="carousel-inner text-black">
                                                                @foreach ($featured_users as $f_user)
                                                                    <div class="carousel-item text-right @if ($loop->first) active @endif"
                                                                        style="background:{{ $f_user->user->color }}; height:260px;">
                                                                        <div
                                                                            class="d-flex justify-end align-end w-100 h-100">
                                                                            <div class="position-relative"
                                                                                style="width: 250px;height: 250px;">
                                                                                <img src="{{ asset('/images/rectangles/f2.svg') }}"
                                                                                    width="25" alt="@"
                                                                                    style="position:absolute;bottom: 30%;left: 12%;">
                                                                                <img src="{{ asset('/images/rectangles/f1.svg') }}"
                                                                                    width="20" alt="@"
                                                                                    style="position: absolute;bottom: 32%;right: 3%;">
                                                                                <img src="{{ asset('/images/rectangles/f3.svg') }}"
                                                                                    width="25" alt="@"
                                                                                    style="position: absolute;top: 8%;left: 25%;">
                                                                                <img src="{{ asset('/images/rectangles/f4.svg') }}"
                                                                                    width="25" alt="@"
                                                                                    style="position: absolute;top: 35%;right: 10%;">
                                                                                <img src="{{ asset('/images/rectangles/f4.svg') }}"
                                                                                    width="20" alt="@"
                                                                                    style="position: absolute;top: 5%;right: 25%;">
                                                                                <img src="{{ asset($f_user->user->image_url) }}"
                                                                                    class="" alt="User"
                                                                                    style="width:100%;height:100%;object-fit: cover;">
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="carousel-caption d-none d-md-block text-left w-50">
                                                                            <h5 class="text-black-900">
                                                                                {{ $f_user->user->name }}</h5>
                                                                            <p class="text-black-900">
                                                                                <em
                                                                                    class="icon ni ni-hot-fill text-danger"></em>
                                                                                <span
                                                                                    class="text-black-500">{{ $f_user->title }}</span>
                                                                            </p>
                                                                            <p class="mt-4"
                                                                                style="
                                                                            font-weight: 500;
                                                                            line-height: 18px;
                                                                            letter-spacing: 0.2px;
                                                                            color: #363535;">
                                                                                {{ $f_user->description }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            {{-- <a class="carousel-control-prev" href="#carouselExCap"
                                                                role="button" data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExCap"
                                                                role="button" data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                                </a> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @auth
                                                    @if (Auth::user()->role->slug == 'super-admin' || Auth::user()->role->slug == 'admin')
                                                        <div class="card-inner py-2">
                                                            <div class="card-title-group">
                                                                <div class="card-title card-title-sm text-black-600">
                                                                    <h4>Check-in / Check-out </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-inner pt-2 pb-5" style="padding: 10px 36px;">
                                                            <div class="row py-2 p-2"
                                                                style="border-radius:20px;background:#e5e7eb">
                                                                <div class="col-7">
                                                                    <p class="text-black-500">Please scan the QR code via
                                                                        AntonX
                                                                        world app to check-in/
                                                                        check-out.</p>
                                                                    <p class="text-black-500"><b> Step 1</b><br>
                                                                        Open AntonX World app on your phone</p>
                                                                    <p class="text-black-500"><b>Step 2</b><br>
                                                                        Tap the scan button and place the
                                                                        QR code within the frame.</p>
                                                                </div>
                                                                <div class="col-5">
                                                                    <div
                                                                        class="d-flex justify-end align-center w-100 h-100">
                                                                        {!! QrCode::size(200)->generate($access_token->access_key) !!}
                                                                        {{-- {!! QrCode::format('png')->merge('public/images/antonX_logo.png', 0.3, true)->size(200)->generate($access_token->access_key) !!} --}}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                @endauth
                                            </div><!-- .card-preview -->
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <script src="{{ asset('/assets/js/bundle.js?ver=2.2.0') }}"></script>
    <script src="{{ asset('/assets/js/scripts.js?ver=2.2.0') }}"></script>

    {{-- <script src="{{ asset('/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/charts/chart-ecommerce.js?ver=2.2.0') }}"></script> --}}

    <!-- Custom JS File -->
    <script src="{{ asset('/assets/js/ajax.js') }}"></script>
    {{-- <script src="{{ asset('/assets/bundles/jquery-ui/jquery-ui.min.js') }}" defer></script> --}}
    <script src="{{ asset('/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>

    <script>
        // refersh this page after every 30 minutes
        setTimeout(() => {
            location.reload();
        }, 1800000);

        formatAMPM()

        function formatAMPM() {
            var date = new Date()
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            document.getElementById('time_span').innerHTML = strTime;
            setTimeout(formatAMPM, 1000);
        }

        // full screen call

        $(document).on("click", ".fullscreen-btn", function(e) {
            if (
                !document.fullscreenElement && // alternative standard method
                !document.mozFullScreenElement &&
                !document.webkitFullscreenElement &&
                !document.msFullscreenElement
            ) {
                // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(
                        Element.ALLOW_KEYBOARD_INPUT
                    );
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }
        });
    </script>

</html>
