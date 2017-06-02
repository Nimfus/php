@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Users</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="5">Total ({{ $users->total() }})
                <a href="{{ route('users.create') }}" class="pull-right">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name or '' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pencil editor"></i></a>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $user->id }}" data-model="User" data-route="{{ route('users.destroy', $user->id) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No users found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav class="pagination-wrapper">
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </nav>
@endsection