@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Plans</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="5">Total ({{ count($plans->data) }})
                <a href="{{ route('plans.create') }}" class="pull-right">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Trial period</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($plans->data as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->amount / 100 }} {{ $plan->currency }} / {{ $plan->interval }}</td>
                <td>{{ $plan->trial_period_days or 'n/a' }}</td>
                <td>
                    <a href="{{ route('plans.edit', $plan->id) }}"><i class="fa fa-pencil editor"></i></a>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $plan->id }}"
                       data-model="Plan" data-route="{{ route('plans.destroy', $plan->id) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No plans found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection