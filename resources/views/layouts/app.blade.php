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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page">
    <div id="app">
        <nav class="bg-header">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-2">
                    <h1>
                        <a class="navbar-brand text-default text-xl" 
                        href="{{ url('/owners') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </h1>

                    <div>

                        <!-- Right Side Of Navbar -->
                        <div class="navbar-nav ml-auto flex items-center">
                            <!-- Authentication Links -->
                            @guest                            
                                <a class="nav-link" 
                                    href="{{ route('login') }}">
                                    {{ __('Login') }}</a>                             
                                @if (Route::has('register'))
                                    <a class="nav-link" 
                                        href="{{ route('register') }}">
                                        {{ __('Register') }}</a>
                                @endif
                            @else

                                <div class="flex">


                                <theme-switcher></theme-switcher>


                                <dropdown align="right" width="200px">
                                    
                                    <template v-slot:trigger>
                                        
                                        <button 

                                            class="text-default flex items-center 

                                                focus:outline-none"> 


                                            <img width="35" 

                                                src="{{gravatar_url(auth()->user()->email)}}"

                                                class="mr-2 rounded-full">


                                            {{ auth()->user()->name }}

                                        </button>

                                    </template>


                                    <!-- <a href="#" class="dropdown-menu-link" onclick="

                                        javascript: document

                                        .querySelector('#logout-form')

                                        .submit()"

                                    >
                                        Logout

                                    </a> -->

                                    <form id="logout-form" method="POST" 

                                        action="/logout"

                                    >
                                        
                                        @csrf

                                        <button type="submit" 

                                            class="dropdown-menu-link w-full 

                                                text-left">
                                                
                                            Logout    

                                        </button>

                                    </form>

                                </dropdown>


                                </div>
                                <!-- 
                                <div class="dropdown-menu dropdown-menu-right ml-2" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-default" 
                                    href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div> -->                                
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
