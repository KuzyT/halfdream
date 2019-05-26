@extends('layouts.app')

@section('content')
    <!-- START ARTICLE -->
        @forelse($items as $item)
            @include('modules.category.includes.item', ['partial' => true])
        @empty
            <div class="box">
                {{ __('halfdream::category.empty') }}
            </div>
        @endforelse
    <!-- END ARTICLE -->

    @if ($items->isNotEmpty() && ($items instanceof Illuminate\Pagination\LengthAwarePaginator))
        {{ $items->links('halfdream::vendor.pagination.bulma') }}
    @endif

@endsection
