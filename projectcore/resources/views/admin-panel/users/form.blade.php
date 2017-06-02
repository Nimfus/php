@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Users</p>
    </div>
    <div class="col-xs-8">
        <form class="form col-xs" method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.index') }}">
            @if(isset($user))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <label for="name" class="col-xs-4 col-form-label">Name</label>
                <div class="col-xs">
                    <input name="name" class="form-control @if($errors->has('name')) error-border @endif" type="text" value="{{ isset($user) ? $user->name : old('name') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('name')) {{ $errors->first('name') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-xs-4 col-form-label">Email</label>
                <div class="col-xs">
                    <input name="email" class="form-control @if($errors->has('email')) error-border @endif" type="email" value="{{ isset($user) ? $user->email : old('email') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('email')) {{ $errors->first('email') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-xs-4 col-form-label">Role</label>
                <div class="col-xs">
                    <select class="form-control @if($errors->has('role')) error-border @endif" name="role">
                        <option>-- Please select --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if(isset($user) && isset($user->role) && $user->role->id == $role->id) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error text-sm-left">@if($errors->has('role')) {{ $errors->first('role') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-xs-4 col-form-label">Password</label>
                <div class="col-xs">
                    <input name="password" class="form-control @if($errors->has('password')) error-border @endif" type="password">
                    <span class="text-danger error text-sm-left">@if($errors->has('password')) {{ $errors->first('password') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-xs-4 col-form-label">Password Confirmation</label>
                <div class="col-xs">
                    <input name="password_confirmation" class="form-control @if($errors->has('password')) error-border @endif" type="password">
                    <span class="text-danger error text-sm-left">@if($errors->has('password')) {{ $errors->first('password') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <input type="submit" class="btn btn-outline-primary btn-sm mx-auto" value="{{ isset($user) ? 'Update' : 'Create' }}">
            </div>
        </form>
    </div>
@endsection