@extends('layouts.user-area.main')

@section('content')
    <div class="row">
        <div class="col-xs most-recent-section">
            @foreach($users as $user)
                <a href="">
                    <div class="img most-recent rounded-circle" style="background-image:url({{ asset('storage/images/avatars/' . $user->avatar) }});"></div>
                </a>
            @endforeach
        </div>
    </div>
    <index-component></index-component>
@endsection
