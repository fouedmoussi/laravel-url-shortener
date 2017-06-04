<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        table {
            table-layout: fixed;
        }
        td
        {
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="#">
                        Laravel url shortener
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        
                        <li>
                            <a href="{{route('get-form', ['lang'=> app()->getLocale()])}}"> {{trans('links.shortify')}}
                            </a>
                        </li>

                        <li>
                            <a href="{{route('all-links' , ['lang'=> app()->getLocale()])}}">   {{trans('links.allLinks')}}
                            </a>
                        </li>


                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login', ['lang'=> app()->getLocale()]) }}">{{trans('login.login')}}</a></li>
                        <li><a href="{{ route('register', ['lang'=> app()->getLocale()]) }}">{{trans('register.register')}}</a></li>
                        @else
                        <li>
                            <a href="{{route('user-links', ['lang'=> app()->getLocale()])}}">{{trans('links.myLinks')}} 
                               <span style="{{Auth::user()->links()->count() >= 10 ?     'color: #a94442;' : ''}}">({{Auth::user()->links()->count()}})</span> 
                            </a>
                        </li>

                        

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout', ['lang'=> app()->getLocale()]) }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    
                                    {{ trans('links.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout', ['lang'=> app()->getLocale()]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>


                        </li>

                    @endif
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ trans('links.language') }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{route(request()->route()->getName(), ['lang'=> 'en'])}}" style="{{app()->getLocale() == 'en' ?     'background-color: #3097d1;' : ''}}">
                                        En
                                    </a>

                                    <a href="{{route(request()->route()->getName(), ['lang'=> 'fr'])}}" style="{{app()->getLocale() == 'fr' ?     'background-color: #3097d1;' : ''}}">
                                        Fr
                                    </a>


                                </li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
