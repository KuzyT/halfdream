@extends('halfdream::admin.layouts.master')



@section('title'){{ $title }}@endsection

@section('content')
    <div class="columns is-multiline">
        <div class="column">
            {!! $form->render() !!}
        </div>
    </div>
@endsection