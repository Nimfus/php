@extends('layouts.user-area.main')

@section('content')
    <div class="row">
        <div class="col-md-12 login-form-frame">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <registration-component></registration-component>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.user-area.templates._register')
