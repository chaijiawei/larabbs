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

                        @can('update', $topic)
                            <hr>
                            <a href="{{ route('topics.edit', $topic) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endcan

                        @can('destroy', $topic)
                            <form onsubmit="return confirm('确认删除？')" class="d-inline" action="{{ route('topics.destroy', $topic) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa fa-trash"></i>
                                    删除
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header bg-transparent">
                        话题回复
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($replies as $reply)
                                <li class="media my-4">
                                    <a href="{{ route('users.show', $reply->user) }}">
                                        <img width="64" class="mr-3" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ route('users.show', $reply->user) }}">{{ $reply->user->name }}</a>
                                        <p>
                                            {!! $reply->content !!}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="my-4">
                            {{ $replies->appends(request()->all())->links() }}
                        </div>
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
