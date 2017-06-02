@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Settings</p>
    </div>
    <div class="col-xs-8">
        <form class="form col-xs" method="POST" action="{{ isset($setting) ? route('settings.update', $setting->id) : route('settings.store') }}">
            @if(isset($setting))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <label for="name" class="col-xs-4 col-form-label">Name</label>
                <div class="col-xs">
                    <input name="name" class="form-control @if($errors->has('name')) error-border @endif" type="text" value="{{ isset($setting) ? $setting->name : old('name') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('name')) {{ $errors->first('name') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="value" class="col-xs-4 col-form-label">Value</label>
                <div class="col-xs">
                    <input name="value" class="form-control @if($errors->has('value')) error-border @endif" type="text" value="{{ isset($setting) ? $setting->value : old('value') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('value')) {{ $errors->first('value') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-xs-4 col-form-label">Description</label>
                <div class="col-xs">
                    <textarea class="form-control" rows="5" name="description">{{ isset($setting) ? $setting->description : old('value') }}</textarea>
                    <span class="text-danger error text-sm-left">@if($errors->has('description')) {{ $errors->first('description') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <input type="submit" class="btn btn-outline-primary btn-sm mx-auto" value="{{ isset($setting) ? 'Update' : 'Create' }}">
            </div>
        </form>
    </div>
@endsection