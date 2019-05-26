@extends('halfdream::admin.layouts.master')

@section('title'){{ $title }}@endsection

@section('actions')

@endsection

@section('content')
    <div class="columns is-multiline">
        <div class="column">
            {{ __('halfdream::admin.welcome') }}
        </div>
    </div>
@endsection
