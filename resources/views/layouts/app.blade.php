<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAMS</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Include Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- External JS -->
    <script src="{{ asset('assets/js/jQuery.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!--Progress Bar -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- External CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            color: #444;
            background: linear-gradient(to right, rgba(60, 97, 116, 0.8), rgba(60, 97, 116, 0.6)), url('{{ asset('images/bg.jpg') }}') ;
        }
    </style>

    <body>
    <div id="app">
        <div class="container">
            <button class="burger" onclick="toggleMenu()">
            </button>
            <div class="background"></div>
            <div class="menu">
                <nav>
                    <a style="animation-delay: 0.2s" href="{{route('home')}}">Home</a>
                    <a style="animation-delay: 0.3s" href="{{route('dashboard.index')}}">Dashboard</a>
                    <a style="animation-delay: 0.3s" href="{{route('grading.index')}}">Grading Schemes</a>
                    <a style="animation-delay: 0.4s" href="{{route('semester.index')}}">Semester</a>
                    <a style="animation-delay: 0.5s" href="{{route('subject.index')}}">Subject</a>
                    <a style="animation-delay: 0.6s" href="{{route('progress.index')}}">Progress</a>
                    <a style="animation-delay: 0.7s" href="{{route('study.index')}}">Study Tips</a>

                    <a style="animation-delay: 0.7s" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>
            <script type="text/javascript">
                const toggleMenu =
                    () => document.body
                        .classList.toggle("open");
            </script>
            </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
