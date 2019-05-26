@extends('halfdream::admin.layouts.master')

@section('title'){{ $title }}@endsection

@section('actions')
    <a href="{{ route('admin.module.create', $display->getKey()) }}" class="button is-primary">
        <span class="icon">
            <font-awesome-icon icon="plus"></font-awesome-icon>
        </span>
        <span>{{ __('halfdream::admin.create.button') }}</span>
    </a>
@endsection

@section('content')
    <div class="columns is-multiline">
        <div class="column">
            {!! $display->render() !!}
        </div>
    </div>
@endsection
