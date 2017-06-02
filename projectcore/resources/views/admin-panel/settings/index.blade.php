@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Settings</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="5">Total ({{ $settings->total() }})
                <a href="{{ route('settings.create') }}" class="pull-right">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Value</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($settings as $setting)
            <tr>
                <td>{{ $setting->name }}</td>
                <td>{{ $setting->value }}</td>
                <td>{{ $setting->description }}</td>
                <td>
                    <a href="{{ route('settings.edit', $setting->id) }}"><i class="fa fa-pencil editor"></i></a>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $setting->id }}" data-model="Setting" data-route="{{ route('settings.destroy', $setting->id) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No settings found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav class="pagination-wrapper">
        {{ $settings->links('vendor.pagination.bootstrap-4') }}
    </nav>
@endsection