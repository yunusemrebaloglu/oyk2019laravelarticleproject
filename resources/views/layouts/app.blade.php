<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/photos.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm  d-block sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="navbar-brand">
                    {{$weather->city->name}}
                    {{$weather->temperature}}
					<img src='http://openweathermap.org/img/w/{{ $weather->weather->icon }}.png'/>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
								@if(Auth::user()->unreadNotifications()->count() > 0)
								<a id="navbarDropdownnotification" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<img src="{{ URL::to('/') }}/dist/images/notification.svg" alt="" height="25px" width="25px">{{Auth::user()->unreadNotifications()->count()}}
                                </a>
								@else
								<a id="navbarDropdownnotification" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<img src="{{ URL::to('/') }}/dist/images/notificationNnon.svg" alt="" height="25px" width="25px">
								</a>
								@endif

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownnotification">
									@foreach(Auth::user()->notifications()->latest()->take(25)->get() as $notification)
									<a class="dropdown-item @if(!$notification->read_at)  bg-info @endif" href="{{route('users.notification',$notification)}}">
											{{$notification->data['message']}}
									</a>

									@endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<img src="{{asset(Storage::url(Auth::user()->profile_image))}}" class="rounded-circle"  width="25"alt="">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.profile', request()->user()->id) }}">
                                        Profilim
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                        Kullanıcılar
                                    </a>
                                    <a class="dropdown-item" href="{{ route('article.index') }}">
                                        Bütün Yazılar
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.commentedArticles') }}">
                                        Yorum Yaptıklarım
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
