@extends('layouts.user-area.main')

@section('content')
    <div class="row">
        <div class="col-md-12 login-form-frame">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" novalidate>
                    {{ csrf_field() }}
                    <login-component></login-component>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.user-area.templates._login')
