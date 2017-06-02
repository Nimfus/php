<script type="text/x-template" id="registration-component">
    <div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8{{ $errors->has('name') ? ' has-error' : '' }}"
                 :class="{' has-error': errors.has('name') }">
                <v-text-input id="name" v-model.trim="name" type="text" name="name" v-validate="'required|min:3'" label="Name"></v-text-input>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <span class="help-block" v-show="errors.has('name')">
                    <strong>@{{ errors.first('name') }}</strong>
                </span>
            </div>
        </div>

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
                <v-text-input v-model.trim="password" id="password" v-validate="'required|min:6'"
                              type="password" name="password" label="Password"></v-text-input>
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
            <div class="col-md-offset-2 col-md-8{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                 :class="{' has-error': errors.has('password_confirmation') }">
                <v-text-input v-model.trim="password_confirmation" id="password_confirmation" v-validate="'confirmed:password'"
                              type="password" name="password_confirmation" label="Password confirmation"></v-text-input>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                <span class="help-block" v-show="errors.has('password_confirmation')">
                    <strong>@{{ errors.first('password_confirmation') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn blue darken-1 btn-sm" :disabled="errors.any() || fieldsEmpty()">
                    Register
                </button>
            </div>
        </div>
    </div>
</script>