@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Logs</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="5">Total ({{ count($logs) }})
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($logs as $log)
            <tr>
                <td>{{ $log }}</td>
                <td>
                    <a href="{{ route('logs.show', $log) }}"><i class="fa fa-download editor"></i></a>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $log }}" data-model="Log file" data-route="{{ route('logs.destroy', $log) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No logs found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection