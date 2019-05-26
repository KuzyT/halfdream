@extends('layouts.app')

@section('content')

    <!-- START ARTICLE -->
    <div class="card is-vertical">
        @if ($item->image)
            <div class="card-image">
                <figure class="image">
                    <img src="{{ image($item->image) }}" alt="{{ $item->title }}">
                </figure>
            </div>
        @endif
        <div class="card-content">
            <h4 class="title is-4">
                {{ $item->title }}
            </h4>
            <p class="content">
                {!! $item->content !!}
            </p>
        </div>
    </div>

    <!-- END ARTICLE -->

@endsection
