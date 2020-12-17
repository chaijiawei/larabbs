@extends('layouts.app')

@section('title', $topic->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">作者：
                            <a href="{{ route('users.show', $topic->user) }}">
                                {{ $topic->user->name }}
                            </a>
                        </h5>
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
                            <span class="text-secondary d-block">
                                {{ $topic->created_at->diffForHumans() }}
                                &bull;
                                <i class="far fa-comment"></i>
                                {{ $topic->reply_count }}
                            </span>
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
                        @auth
                            <div class="mb-4">
                                <form action="{{ route('replies.store') }}" method="post">
                                    @csrf
                                    @include('shared._errors')

                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="content" rows="5" placeholder="请发表您的见解..."></textarea>
                                    </div>

                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-reply"></i>
                                        提交
                                    </button>
                                </form>
                            </div>
                        @endauth
                        <ul class="list-unstyled">
                            @foreach($replies as $reply)
                                <li class="media my-4">
                                    <a href="{{ route('users.show', $reply->user) }}">
                                        <img width="64" class="mr-3" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
                                    </a>
                                    <div class="media-body">
                                        @can('destroy', $reply)
                                            <form onsubmit="return confirm('确定删除？')" class="float-right" action="{{ route('replies.destroy', $reply) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button title="删除回复" type="submit" class="btn text-secondary">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        <a href="{{ route('users.show', $reply->user) }}">
                                            {{ $reply->user->name }}
                                        </a>
                                        <small class="text-secondary">
                                            &bull;
                                            {{ $reply->created_at->diffForHumans() }}
                                        </small>
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
