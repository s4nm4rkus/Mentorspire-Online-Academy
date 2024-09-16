<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/titlelogo.ico') }}">

    <title>{{ config('app.name', 'test') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Genos:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/homelayout.css') }}" />
    <script src="https://kit.fontawesome.com/7a0950bba0.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/083ba5d621.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body style="height: 100vh">
    <div id="app">

        <nav class="navbar navbar-expand-md shadow-sm fixed-top">
            <div class="container-fluid">
                <a type="button" class="bx-icon-btns custom-icon" data-bs-toggle="offcanvas"
                    data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="fa-solid fa-bars fa-lg" style="color: white;"></i>
                </a>
                <a class="navbar-brand" style="position: absolute;" href="{{ route('home') }}">
                    Mentorspire IOT
                </a>
                <div></div>
                <div class="icon-badge-container">

                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
            aria-labelledby="staticBackdropLabel">
            <div class="d-flex">
                <div class="d-flex flex-column align-self-center" style="flex-basis: 100%; height: 10rem;">
                    <div class="d-flex mt-2">
                        <a type="button" class="bx-icon-btns custom-icon closebtn" data-bs-dismiss="offcanvas"
                            aria-label="Close">
                            <i class="fa-solid fa-arrow-left fa-lg"></i>
                        </a>
                    </div>
                    <img class="ms-3 mt-3" src="{{ asset('images/logomentor.png') }}" alt=""
                        style="height: auto; width: 85%">
                </div>
            </div>

            <div class="offcanvas-body d-flex custom-offcanvas-body">
                <div>
                    <ul class="navbar-nav custom-navbar-nav">
                        <li class="nav-item custom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link custom-nav-link" href="{{ route('home') }}"><i
                                    class="fa-solid fa-house pe-1 " style="font-size: 15px;"></i>
                                {{ __('HOME') }}</a>
                        </li>
                        <li class="nav-item custom-nav-item {{ request()->routeIs('testingpage') ? 'active' : '' }}">
                            <a class="nav-link custom-nav-link" href="{{ route('testingpage') }}"> <i
                                    class="fa-solid fa-rocket pe-2"
                                    style="font-size: 15px;"></i>{{ __('TESTING PAGE') }}</a>
                        </li>
                        <li class="nav-item custom-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                            <a class="nav-link custom-nav-link" href="{{ route('about') }}"><i
                                    class="fa-solid fa-circle-info pe-2"
                                    style="font-size: 15px;"></i>{{ __('ABOUT US') }}</a>
                        </li>
                    </ul>
                    <hr class="hrnav custom-hrnav" style="width:250px; border: 1px solid; position:absolute;">

                    @auth
                        @if (auth()->user()->role === 'user')
                            <div class="mt-3" style="display: flex; align-items: center;">
                                <i class="fa-solid fa-user me-3" style="font-size: 24px;"></i>
                                <label class="nav-link custom-progress-label mt-1"
                                    style="font-size: 18px; font-weight: 400;">
                                    {{ $user->firstname }}
                                    {{ $user->lastname }} </label>
                            </div>
                            <hr class="hrnav custom-hrnav" style="width:250px; border: 1px solid; position:absolute;">


                            <label class="nav-link custom-progress-label mt-3" style="font-size: 12px">Progress:</label>
                            <div class="scrollable-content p-0 mt-2" style="max-height: 220px; overflow: auto;">
                                @foreach ($courseProgress as $progressData)
                                    @php
                                        $course = $progressData['course'];
                                        $progress = $progressData['progress'];
                                        $completedActivities = $progressData['completedActivities'];
                                        $totalActivities = $progressData['totalActivities'];
                                    @endphp
                                    <div style="display: flex; align-items: center;">
                                        <label class="nav-link custom-progress-label mt-2"
                                            style="font-size: 13px; font-weight: 400;"><i
                                                class="fa-solid fa-caret-right pe-1" style="font-size: 12px"></i>
                                            {{ $course->course_title ?? 'No Course Title' }}
                                        </label>
                                    </div>

                                    @if ($totalActivities > 0)
                                        <div class="d-flex justify-space-between">
                                            <p class="ms-0 mt-0 mb-0 p-0"
                                                style="color: white; font-size: 10px; font-weight: 200; margin-right: 47%">
                                                Completed activity:
                                            </p>
                                            <p class=" ms-0 mt-0 mb-0 p-0"
                                                style="color: white; font-size: 9px; text-align: right; ">
                                                {{ $completedActivities }} / {{ $totalActivities }}
                                            </p>
                                        </div>
                                        <div class="progress p-0 m-0" role="progressbar" aria-label="Progress Bar"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="background-color: #F0F0F0; border-radius:50px; width:250px; height: 10px; margin-top: 2px;">
                                            <div class="progress-bar d-flex"
                                                style="width: {{ $progress }}%; background-color: #FFBC36;">
                                            </div>
                                        </div>
                                    @else
                                        <p style="font-size: 11px; font-weight: 200; margin-left: 15px">There is no
                                            activity yet.</p>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endauth

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <div class="mt-3" style="display: flex; align-items: center;">
                                <i class="fa-solid fa-user me-3" style="font-size: 23px;"></i>
                                <label class="nav-link custom-progress-label mt-2"
                                    style="font-size: 18px; font-weight: 400;">
                                    {{ $user->firstname }}
                                    {{ $user->lastname }}<span style="font-size: 14px; font-weight:200;"> (admin)</span>
                                </label>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="offcanvas-footer ps-1.5 mb-4">
                <hr class="hrnav ms-3" style="width:250px; border: 1px solid;">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary ms-3" style="width: 40%;">
                            {{ __('Log Out') }}<i class="fa-solid fa-arrow-right-from-bracket ps-2"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>



    <div class="main-content">
        <main class="">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>


    {{-- Code for notification log in --}}
    @if (session('admin_login_notification'))
        <div class="push-notification">
            <span>{{ session('admin_login_notification') }}</span>
        </div>
    @endif


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/createcourse.js') }}"></script>
    <script src="{{ asset('js/contactUs.js') }}"></script>
    <script src="{{ asset('js/homelayout.js') }}"></script>
    <script src="{{ asset('js/enrollcourse.js') }}"></script>
</body>

</html>
