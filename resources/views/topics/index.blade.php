@extends('layouts.app')

@section('title', $category->name ?? '话题列表')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if(isset($category))
                    <div class="alert alert-info">
                        {{ $category->name }} : {{ $category->descr }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link
                                @if(request()->query('order') === 'recentReply' ||
                                    ! request()->query('order'))
                                    active
                                @endif"
                                href="{{ request()->url() }}?order=recentReply">最后回复</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link
                                @if(request()->query('order') === 'recentCreate') active @endif"
                                href="{{ request()->url() }}?order=recentCreate">最新发表</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($topics as $topic)
                                <li class="media my-3">
                                    <a href="{{ route('users.show', $topic->user) }}">
                                        <img width="32" src="{{ $topic->user->avatar }}" class="mr-3" alt="{{ $topic->user->name }}">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ $topic->link() }}">{{ $topic->title }}</a>
                                        <small class="d-block">
                                            <a class="text-secondary" href="{{ route('categories.show', $topic->category) }}">
                                                <i class="far fa-folder"></i>
                                                {{ $topic->category->name }}
                                            </a>
                                            &bull;
                                            <a class="text-secondary" href="{{ route('users.show', $topic->user) }}">
                                                <i class="far fa-user"></i>
                                                {{ $topic->user->name }}
                                            </a>
                                            &bull;
                                            <span class="text-secondary" title="{{ $topic->updated_at }}">
                                                <i class="far fa-clock"></i>
                                                {{ $topic->updated_at->diffForHumans() }}
                                            </span>
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $topics->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block">
                            <i class="fa fa-pencil"></i>
                            新建话题
                        </a>
                    </div>
                </div>

                @if($activeUsers = (new App\Models\User)->getActiveUserByCache())
                    <div class="card my-4">
                        <div class="card-header">
                            活跃用户
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($activeUsers as $activeUser)
                                    <li class="list-group-item">
                                        <img width="32" class="mr-2" src="{{ $activeUser->avatar }}" alt="{{ $activeUser->name }}">
                                        <a href="{{ route('users.show', $activeUser) }}">{{ $activeUser->name }}</a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
