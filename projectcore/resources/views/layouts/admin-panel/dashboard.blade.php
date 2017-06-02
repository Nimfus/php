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

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
<div class="container-fluid" style="min-height:100%;">
    <div class="row main-frame">
        <div class="col-md-2 sidebar">
            @include('layouts.admin-panel.sidebar')
        </div>
        <div class="col-md body-wrapper">
            <div class="col-xs header">
                <form class="form-inline" method="post" action="{{ asset('logout') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-outline-primary btn-sm">Log Out</button>
                </form>
                <h6>Welcome, #{{ auth()->user()->name }}</h6>
            </div>
            <div class="col-xs page-title">
                <h5>Dashboard</h5>
                @include('layouts.admin-panel.breadcrumbs')
            </div>
            @include('layouts.admin-panel.notifications')
            @include('layouts.admin-panel.remove-modal')
            <div class="col-xs">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sticky-top">...</div>
</div>

<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
