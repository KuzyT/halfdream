@extends('layouts.app')

@section('content')
    @include('modules.category.includes.item')

    @forelse($items as $item)
        @include('modules.post.includes.item', ['partial' => true, 'withCategory' => false])
    @empty
        <!-- START ARTICLE -->
        <div class="box">
            {{ __('halfdream::post.empty') }}
        </div>
        <!-- END ARTICLE -->
    @endforelse

    @if ($items->isNotEmpty() && ($items instanceof Illuminate\Pagination\LengthAwarePaginator))
        {{ $items->links('halfdream::vendor.pagination.bulma') }}
    @endif

@endsection
