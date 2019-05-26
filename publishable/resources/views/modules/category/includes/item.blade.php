@php
    $partial = !empty($partial);
@endphp

<div class="card is-vertical">
    @if ($item->image)
        <div class="card-image">
            <figure class="image">
                <img src="{{ image($item->image) }}" alt="{{ $item->title }}">
            </figure>
        </div>
    @endif
    <div class="card-content">
        @if ($item->posts_count)
            <span class="tag is-primary is-pulled-right">{{ $item->posts_count }}</span>
        @endif
        <h4 class="title is-4">
            @if ($partial)
                <a href="{{ __route('category.show', ['seo' => $item->seo_url]) }}">{{ $item->title }}</a>
            @else
                {{ $item->title }}
            @endif
        </h4>
        @if ($item->content)
            <p class="content">
                {!! $item->content !!}
            </p>
        @endif
        @if ($item->gallery)
            <p class="content">
                <gallery :images="{{ $item->GalleryImages }}" :thumbs="{{ $item->GalleryThumbs }}"></gallery>
            </p>
        @endif
    </div>
</div>
