@extends('layouts.user-area.main')

@section('content')
    <div id="settings">
        <form method="POST" id="photosUpload" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row form-group custom-form-wrapper {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-xs-3 control-label">Email</label>
                <input id="email" type="email" class="form-control col-xs-6" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
            </div>
            <div class="row form-group custom-form-wrapper {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-xs-3 control-label">Upload your photos</label>
                <div class="image-upload-section col-xs-6" id="photos"><div class="dz-message">Drop your photo here</div> </div>
                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="row form-group custom-form-wrapper">
                <input type="submit" id="btn" class="btn btn-outline-primary btn-sm margin-auto" value="Save">
            </div>
        </form>
    </div>
@endsection
