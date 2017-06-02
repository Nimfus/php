<script type="text/x-template" id="login-component">
    <div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8{{ $errors->has('email') ? ' has-error' : '' }}"
                 :class="{' has-error': errors.has('email') }">
                <v-text-input v-model.trim="email" id="email"
                              type="email" v-validate="'required|email'" name="email" label="Email"></v-text-input>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                <span class="help-block" v-show="errors.has('email')">
                    <strong>@{{ errors.first('email') }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8{{ $errors->has('password') ? ' has-error' : '' }}"
                 :class="{' has-error': errors.has('password') }">
                <v-text-input v-model.trim="password" id="password" v-validate="'required|min:6'" type="password" name="password" label="Password"></v-text-input>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                <span class="help-block" v-show="errors.has('password')">
                    <strong>@{{ errors.first('password') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                 <v-checkbox label="Remember Me" id="remember" name="remember" v-on:change="rememberMe()"
                             v-model="remember"></v-checkbox>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 flex-group">
                <v-btn success type="submit" class="btn btn-sm blue darken-1m">
                    Login
                </v-btn>
                <a href="{{ asset('facebook') }}" class="btn btn-sm blue darken-1m">
                    <i class="fa fa-facebook"></i> Facebook
                </a>
                <a class="btn btn-sm blue darken-1" href="{{ url('/password/reset') }}">
                    Forgot Your Password?
                </a>
            </div>
        </div>
    </div>
</script>