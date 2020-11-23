@extends('layouts.app')

@section('title', '个人中心')

@section('content')
    <div class="container">
        <div class="text-center">

            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
            <img class="img-thumbnail" src="{{ $user->avatar }}" alt="{{ $user->name }}">
        </div>
    </div>
@stop
