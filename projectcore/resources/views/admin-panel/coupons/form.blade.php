@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Coupon</p>
    </div>
    <div class="col-xs-8">
        <form class="form col-xs" method="POST" action="{{ isset($coupon) ? route('coupons.update', $plan->id) : route('coupons.store') }}">
            @if(isset($coupon))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Coupon ID</label>
                <div class="col-xs">
                    <input name="id" class="form-control @if($errors->has('id')) error-border @endif" type="text" value="{{ isset($coupon) ? $coupon->id : old('id') }}"
                            {{ isset($coupon) ? 'disabled' : '' }}>
                    <span class="text-danger error text-sm-left">@if($errors->has('id')) {{ $errors->first('id') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="duration" class="col-xs-4 col-form-label">Duration</label>
                <div class="col-xs">
                    <select class="form-control @if($errors->has('currency')) error-border @endif" name="duration" {{ isset($coupon) ? 'disabled' : '' }}>
                        <option>-- Please select --</option>
                        @foreach($durations as $duration)
                            <option value="{{ $duration }}" @if(isset($coupon) && $coupon->duration == $duration || old('duration') == $duration) selected @endif>{{ strtoupper($duration) }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error text-sm-left">@if($errors->has('duration')) {{ $errors->first('duration') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount_off" class="col-xs-4 col-form-label">Amount Off (cents)</label>
                <div class="col-xs">
                    <input name="amount_off" class="form-control @if($errors->has('amount_off')) error-border @endif" type="number" value="{{ isset($coupon) ? $coupon->amount_off : old('amount_off') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('amount_off')) {{ $errors->first('amount_off') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="currency" class="col-xs-4 col-form-label">Currency</label>
                <div class="col-xs">
                    <select class="form-control @if($errors->has('currency')) error-border @endif" name="currency" {{ isset($plan) ? 'disabled' : '' }}>
                        <option>-- Please select --</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency }}" @if(isset($coupon) && $coupon->currency == $currency || old('currency') == $currency) selected @endif>{{ strtoupper($currency) }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error text-sm-left">@if($errors->has('currency')) {{ $errors->first('currency') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="duration_in_months" class="col-xs-4 col-form-label">Duration in months</label>
                <div class="col-xs">
                    <input name="duration_in_months" class="form-control @if($errors->has('duration_in_months')) error-border @endif" type="number" {{ isset($coupon) ? 'disabled' : '' }}
                    value="{{ isset($coupon) ? $coupon->duration_in_months : old('duration_in_months') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('duration_in_months')) {{ $errors->first('duration_in_months') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="max_redemptions" class="col-xs-4 col-form-label">Max redemptions</label>
                <div class="col-xs">
                    <input name="max_redemptions" class="form-control @if($errors->has('max_redemptions')) error-border @endif" type="number" {{ isset($coupon) ? 'disabled' : '' }}
                    value="{{ isset($coupon) ? $coupon->max_redemptions : old('max_redemptions') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('max_redemptions')) {{ $errors->first('max_redemptions') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="percent_off" class="col-xs-4 col-form-label">Percent off</label>
                <div class="col-xs">
                    <input name="percent_off" class="form-control @if($errors->has('percent_off')) error-border @endif" type="number" {{ isset($coupon) ? 'disabled' : '' }}
                    value="{{ isset($coupon) ? $coupon->percent_off : old('percent_off') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('percent_off')) {{ $errors->first('percent_off') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <input type="submit" class="btn btn-outline-primary btn-sm mx-auto" value="{{ isset($plan) ? 'Update' : 'Create' }}">
            </div>
        </form>
    </div>
@endsection