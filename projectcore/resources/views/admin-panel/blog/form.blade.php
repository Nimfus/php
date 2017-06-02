@extends('layouts.admin-panel.dashboard')

@section('content')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <div class="col-xs">
        <p>Blog Post</p>
    </div>
    <div class="col-xs-8">
        <form class="form col-xs" method="POST" action="{{ isset($post) ? route('posts.update', $plan->id) : route('posts.store') }}">
            @if(isset($post))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Title</label>
                <div class="col-xs">
                    <input name="title" class="form-control @if($errors->has('title')) error-border @endif" type="text" value="{{ isset($post) ? $post->title : old('title') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('title')) {{ $errors->first('title') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Slug</label>
                <div class="col-xs">
                    <input name="title" class="form-control @if($errors->has('slug')) error-border @endif" type="text" value="{{ isset($post) ? $post->slug : old('slug') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Publish</label>
                <div class="col-xs">
                    <input name="published" class="form-control @if($errors->has('published')) error-border @endif" type="checkbox" value="1"
                            {{ isset($post) && $post->published == 1 || old('published') == 1 ? 'checked' : old('published') }}>
                    <span class="text-danger error text-sm-left">@if($errors->has('published')) {{ $errors->first('slug') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-xs-4 col-form-label">Slug</label>
                <div class="col-xs">
                    <div id="summernote"></div>
                    <input name="title" class="form-control @if($errors->has('slug')) error-border @endif" type="text" value="{{ isset($post) ? $post->slug : old('slug') }}">
                    <span class="text-danger error text-sm-left">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</span>
                </div>
            </div>

            <div class="form-group row">
                <input type="submit" class="btn btn-outline-primary btn-sm mx-auto" value="{{ isset($plan) ? 'Update' : 'Create' }}">
            </div>
        </form>
    </div>
@endsection