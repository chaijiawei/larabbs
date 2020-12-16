@extends('layouts.app')

@section('title', '个人中心')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img class="img-fluid" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        <h4 class="mt-4">个人简介</h4>
                        <p>{{ $user->intro }}</p>
                        <hr>
                        <h4>注册于</h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            {{ $user->name }}
                            <small class="text-secondary">{{ $user->email }}</small>
                        </h3>
                    </div>
                </div>
                <hr>

                <div class="card mt-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="{{ request()->url() }}?type=topics" class="nav-link
                                @if(!request()->has('type') || request()->query('type') === 'topics')
                                    active
                                @endif
                                ">
                                    ta 的话题
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ request()->url() }}?type=replies" class="nav-link
                                @if(request()->query('type') === 'replies')
                                    active
                                @endif
                                ">
                                    ta 的回复
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if(request()->query('type') === 'topics' || !request()->query('type'))
                                @include('users._topics')
                            @elseif(request()->query('type') === 'replies')
                                @include('users._replies')
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
