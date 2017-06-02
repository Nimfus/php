@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Coupons</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="9">Total ({{ count($coupons->data) }})
                <a href="{{ route('coupons.create') }}" class="pull-right">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Amount Off, cents</th>
            <th>Percent Off, %</th>
            <th>Duration</th>
            <th>Duration in months</th>
            <th>Redeemed / Max redemptions</th>
            <th>Validity</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($coupons->data as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->amount_off or 'n/a' }}</td>
                <td>{{ $coupon->percent_off or 'n/a' }}</td>
                <td>{{ $coupon->duration }}</td>
                <td>{{ $coupon->duration_in_months }}</td>
                <td>{{ $coupon->times_redeemed }} of {{ $coupon->max_redemptions }}</td>
                <td>{{ $coupon->valid == 1 ? 'valid' : 'not valid' }}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($coupon->created)->toDateString() }}</td>
                <td>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $coupon->id }}"
                       data-model="Coupon" data-route="{{ route('coupons.destroy', $coupon->id) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No coupons found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection