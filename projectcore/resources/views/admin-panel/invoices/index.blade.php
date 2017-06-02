@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Coupons</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="8">Total ({{ count($invoices->data) }})

            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Amount due</th>
            <th>Period Start</th>
            <th>Period End</th>
            <th>Total</th>
            <th>Date</th>
            <th>Closed</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($invoices->data as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->amount_due / 100 }} $</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($invoice->period_start)->toDateString() }}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($invoice->period_end)->toDateString() }}</td>
                <td>{{ $invoice->total / 100 }} $</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($invoice->date)->toDateString() }}</td>
                <td>{{ $invoice->closed ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('invoices.show', $invoice->id) }}"><i class="fa fa-download editor"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No invoices found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection