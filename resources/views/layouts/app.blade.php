<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('images/logo.png') }}" />

        <!-- Styles -->
        <link href="{{ url('css/milligram.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script type="text/javascript" src={{ url('js/app.js') }} defer>
        </script>
    </head>
    <body>
        <main>
            <header>
                <nav>
                <a href="{{ url('/home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" id="logo"></a>
                <h1><a href="{{ url('/home') }}">BrainShare</a></h1>
                    <ul>
                        <li><a href="{{ route('showAbout') }}">About us</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/contact') }}">Contacts</a></li>
                    @if (Auth::check())
                    @if (Auth::user()->isAdmin())
                        <li><a href="{{ url('/administration') }}">Administration</a></li>
                    @elseif (Auth::user()->isModerator())
                        <li><a href="{{ url('/administration') }}">Moderation</a></li>
                    @endif
                        <li><a class="button" href="{{ url('/logout') }}"> Logout </a></li> 
                        <li><a href="{{ url('/user/' . Auth::user()->id) }}">{{ Auth::user()->username }}</a></li>
                        </ul>
                    @endif
                </nav>
            </header>
            <section id="content">
                @yield('content')
            </section>
        </main>
    </body>
</html>