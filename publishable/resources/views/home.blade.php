@extends('layouts.app')

@section('content')

    <!-- START ARTICLE -->
    <div class="card">
        <header class="card-header">
            <p class="card-header-title title is-4">
                {{ __('halfdream::front.home.title') }}
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

            {{ __('halfdream::front.home.welcome') }}

        </div>
    </div>
    <!-- END ARTICLE -->

@endsection
