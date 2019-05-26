@extends('layouts.app')

@section('content')

    <!-- START ARTICLE -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title title is-4">
                {{ __('halfdream::auth.reset') }}
            </p>
        </header>
        <div class="card-content">

            @if (session('status'))
                <div class="message is-success">
                    <div class="message-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

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

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">{{ __('halfdream::auth.send_reset') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END ARTICLE -->

@endsection
