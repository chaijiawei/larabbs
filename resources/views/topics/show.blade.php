@extends('layouts.app')

@section('title', $topic->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center">{{ $topic->title }}</h3>

                <div>
                    {!! $topic->body !!}
                </div>
            </div>
        </div>
    </div>
@stop
