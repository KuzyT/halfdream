@extends('layouts.app')

@section('content')

    <!-- START ARTICLE -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title title is-4">
                {{ __('halfdream::auth.verify.title') }}
            </p>
        </header>
        <div class="card-content">

            @if (session('resent'))
                <div class="message is-success">
                    <div class="message-body">
                        {{ __('halfdream::auth.verify.success.') }}
                    </div>
                </div>
            @endif

            {{ __('halfdream::auth.verify.before') }}
            {{ __('halfdream::auth.verify.not_receive') }}, <a href="{{ route('verification.resend') }}">{{ __('halfdream::auth.verify.request') }}</a>.

        </div>
    </div>
    <!-- END ARTICLE -->

@endsection
