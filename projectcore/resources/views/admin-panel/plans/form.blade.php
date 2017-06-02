@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Plan</p>
    </div>
    <div class="col-xs-8">
        <form class="form col-xs" method="POST" action="{{ isset($plan) ? route('plans.update', $plan->id) : route('plans.store') }}">
            @if(isset($plan))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Plan ID</label>
                <div class="col-xs">
                    <input name="id" class="form-control @if($errors->has('id')) error-border @endif" type="text" value="{{ isset($plan) ? $plan->id : old('id') }}"
                            {{ isset($plan) ? 'disabled' : '' }}>
                    <span class="text-danger error text-sm-left">@if($errors->has('id')) {{ $errors->first('id') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-xs-4 col-form-label">Plan Name</label>
                <div class="col-xs">
                    <input name="name" class="form-control @if($errors->has('name')) error-border @endif" type="text" value="{{ isset($plan) ? $plan->name : old('name') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('name')) {{ $errors->first('name') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="value" class="col-xs-4 col-form-label">Price (cents)</label>
                <div class="col-xs">
                    <input name="amount" class="form-control @if($errors->has('amount')) error-border @endif" type="number" {{ isset($plan) ? 'disabled' : '' }}
                           value="{{ isset($plan) ? $plan->amount : old('amount') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('amount')) {{ $errors->first('amount') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="currency" class="col-xs-4 col-form-label">Currency</label>
                <div class="col-xs">
                    <select class="form-control @if($errors->has('currency')) error-border @endif" name="currency" {{ isset($plan) ? 'disabled' : '' }}>
                        <option>-- Please select --</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency }}" @if(isset($plan) && $plan->currency == $currency || old('currency') == $currency) selected @endif>{{ strtoupper($currency) }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error text-sm-left">@if($errors->has('currency')) {{ $errors->first('currency') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="interval" class="col-xs-4 col-form-label">Interval</label>
                <div class="col-xs">
                    <select class="form-control @if($errors->has('interval')) error-border @endif" name="interval" {{ isset($plan) ? 'disabled' : ''}}>
                        <option value="">-- Please select --</option>
                        @foreach($intervals as $key => $value)
                            <option value="{{ $key }}" @if(isset($plan) && $plan->interval == $key || old('interval') == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error text-sm-left">@if($errors->has('interval')) {{ $errors->first('interval') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="value" class="col-xs-4 col-form-label">Trial Period in days (optional)</label>
                <div class="col-xs">
                    <input name="trial_period_days" class="form-control @if($errors->has('trial_period_days')) error-border @endif" type="number"
                           value="{{ isset($plan) ? $plan->trial_period_days : old('trial_period_days') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('trial_period_days')) {{ $errors->first('trial_period_days') }} @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <input type="submit" class="btn btn-outline-primary btn-sm mx-auto" value="{{ isset($plan) ? 'Update' : 'Create' }}">
            </div>
        </form>
    </div>
@endsection