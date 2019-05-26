@extends('layouts.app')

@section('content')

    @include('modules.post.includes.item', ['withCategory' => true])

@endsection
