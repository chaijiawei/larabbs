@extends('layouts.app')

@section('title', $topic->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">作者：{{ $topic->user->name }}</h5>
                        <hr>
                        <img class="img-fluid" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->name }}">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h3>
                                {{ $topic->title }}
                            </h3>
                            <span class="text-secondary d-block">{{ $topic->updated_at->diffForHumans() }}</span>
                        </div>

                        <div class="my-4" id="topic-body">
                            {!! $topic->body !!}
                        </div>

                        <hr>
                        <a href="{{ route('topics.edit', $topic) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-trash"></i>
                            删除
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@push('style')
    <style>
        #topic-body img {
            max-width: 100%;
        }
    </style>
@endpush
