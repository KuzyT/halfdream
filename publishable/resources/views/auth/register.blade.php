@extends('layouts.app')

@section('content')

    <!-- START ARTICLE -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title title is-4">
                {{ __('halfdream::auth.signup') }}
            </p>
        </header>
        <div class="card-content">

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label class="label">{{ __('halfdream::auth.name') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" placeholder="{{ __('halfdream::auth.name') }}" value="{{ old('name') }}" required autofocus>
                        <span class="icon is-small is-left">
                            <font-awesome-icon icon="user"></font-awesome-icon>
                        </span>
                        @if ($errors->has('name'))
                            <span class="icon is-small is-right">
                                <font-awesome-icon icon="exclamation-triangle"></font-awesome-icon>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">{{ __('halfdream::auth.email') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="{{ __('halfdream::auth.email') }}" value="{{ old('email') }}" required>
                        <span class="icon is-small is-left">
                            <font-awesome-icon icon="envelope"></font-awesome-icon>
                        </span>
                        @if ($errors->has('email'))
                            <span class="icon is-small is-right">
                                <font-awesome-icon icon="exclamation-triangle"></font-awesome-icon>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">{{ __('halfdream::auth.password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="{{ __('halfdream::auth.password') }}" value="{{ old('password') }}" required>
                        <span class="icon is-small is-left">
                            <font-awesome-icon icon="lock"></font-awesome-icon>
                        </span>
                        @if ($errors->has('password'))
                            <span class="icon is-small is-right">
                                <font-awesome-icon icon="exclamation-triangle"></font-awesome-icon>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">{{ __('halfdream::auth.password_confirmation') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="password_confirmation" type="password" placeholder="{{ __('halfdream::auth.password_confirmation') }}" required>
                        <span class="icon is-small is-left">
                            <font-awesome-icon icon="lock"></font-awesome-icon>
                        </span>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">{{ __('halfdream::auth.signup') }}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- END ARTICLE -->

@endsection
