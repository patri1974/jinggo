<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- head --}}
    {!!$seo->head!!}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="180x180" href="{{url('logo2.png')}}" />
    <meta name="robots" content="noodp" />
    <title>@if (@isset($search)) {{$search}} -  @endif @yield('title')</title>
	<link rel="canonical" href="{{@url()->full()}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="@if(@isset($search)) {{$search}} -  @endif{{@$seo->description}}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{@url()->full()}}" />
    <meta property="og:site_name" content="@if(@isset($search)) {{$search}} -  @endif{{@$seo->site_name}}" /> 
    <meta property="og:image" content="{{url('logo2.png')}}" />
    <meta property="og:title" content="@if(@isset($search)) {{$search}} -  @endif{{str_replace('MaxPreps',$seo->site_name,@$data->first()->kategori)}}" /> 
    <meta property="og:description" content="@if (@isset($search)) {{$search}} -  @endif{{@$seo->description}}" /> 
    <meta property="og:locale" content="en_US" />
 

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    {!!@$css!!}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img
                    style="height: 50px" src="{{url("logo2.png")}}" alt="high school sport logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" >
                            <a class="nav-link" style="color: white" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" style="color: white"  href="{{route('new')}}">New</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" style="color: white"  href="{{route('schedule')}}">Schedule</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('iklan')
            @yield('content')
        </main>
    </div>
</body>

@yield('script')
{!!@$script!!}
<footer>
    <hr class="bg-white" style="background-color: white">
    <div class="row justify-content-center">
		<div class="col-md-6">
            <p class="text-center">
                ?? 2021 <a href="{{url('')}}" title="{{@$seo->site_name}}">{{@$seo->site_name}}</a>
            </p>
        </div>
		<div class="col-md-6">
            <p class="text-center">
                <a rel="nofollow" href="{{url('')}}/privacy-policy">Privacy Policy</a> | <a rel="nofollow" href="{{url('')}}/dmca">DMCA</a> | <a rel="nofollow" href="{{url('')}}/contact">Contact</a>
            </p>
        </div>
	</div>
</footer>
</html>
