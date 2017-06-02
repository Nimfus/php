@extends('layouts.admin-panel.dashboard')

@section('content')
    <div class="col-xs">
        <p>Blog Posts</p>
    </div>
    <table class="table table-striped table-sm table-inverse table-hover">
        <thead>
        <tr>
            <th colspan="8">Total ({{ $posts->total() }})
                <a href="{{ route('posts.create') }}" class="pull-right">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </th>
        </tr>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Content</th>
            <th>Published</th>
            <th>Published at</th>
            <th>Created by</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ str_limit($post->content, 15) }}</td>
                <td>{{ $post->published }}</td>
                <td>{{ $post->published_at }}</td>
                <td>{{ $post->user->name }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}"><i class="fa fa-pencil editor"></i></a>
                    <a data-toggle="modal" data-target="#removeItemModal" data-id="{{ $user->id }}" data-model="Blog post" data-route="{{ route('posts.destroy', $post->id) }}"><i class="fa fa-times remover"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No users found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <nav class="pagination-wrapper">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </nav>
@endsection