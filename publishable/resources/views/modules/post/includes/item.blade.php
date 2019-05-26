@php
    $partial = !empty($partial);
    $withCategory = !empty($withCategory);
@endphp

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
            @if ($partial)
                <a href="{{ __route('post.show', ['id' => $item->id, 'seo' => $item->seo_url]) }}">{{ $item->title }}</a>
            @else
                {{ $item->title }}
            @endif
        </h4>
        @if ($withCategory && $item->category)
            <a href="{{ __route('category.show', ['seo' => $item->category->seo_url]) }}" class="tag is-rounded is-pulled-right">{{ $item->category->title }}</a>
        @endif
        @if ($item->published)
            <h5 class="subtitle">{{ $item->published->diffForHumans() }}</h5>
        @endif
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
<!-- END ARTICLE -->
