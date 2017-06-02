<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100|Roboto:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/v.min.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token()
        ]); ?>
    </script>
</head>

<body>
<div class="container" data-app id="app">
    @if(auth()->check())
        @include('layouts.user-area.components')
    @endif
    <div class="row main-frame">
        <div class="col-xs body-wrapper">
            <div class="col-xs header">
                @if(auth()->user())
                <form class="form-inline" method="post" action="{{ asset('logout') }}">
                    {{ csrf_field() }}
                    <h6>Welcome, #{{ auth()->user()->name }} &nbsp;</h6>
                    <button type="submit" class="btn btn btn--dark btn--raised primary">Log Out</button>
                    <v-menu bottom rigth transition="v-slide-x-transition">
                        <v-btn primary dark slot="activator">Profile</v-btn>
                        <v-list>
                            <v-list-item>
                                <v-list-tile>
                                    <v-list-tile-title>
                                        <a href="{{ route('profile') }}">Settings</a>
                                    </v-list-tile-title>
                                </v-list-tile>
                            </v-list-item>
                            <v-list-item>
                                <v-list-tile>
                                    <v-list-tile-title>
                                        <a href="{{ route('profile') }}">Notifications</a>
                                    </v-list-tile-title>
                                </v-list-tile>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </form>
                @else
                    <a class="btn btn-sm teal darken-1" href="{{ url('login') }}">Login</a>
                    <a class="btn btn-sm blue darken-1" href="{{ url('register') }}">Register</a>
                @endif
            </div>
            @include('layouts.user-area._top-menu')
            @yield('content')
        </div>
    </div>
</div>
{{--<v-footer class="row footer">--}}
    {{--<span class="text-muted">Test</span>--}}
{{--</v-footer>footer--}}

<script src="{{ asset('js/vendor.js') }}"></script>
@include('layouts.user-area.templates._chat')
@include('layouts.user-area.templates._index')
<script src="{{ asset('js/frontend.js') }}"></script>
</body>

</html>

