@extends('layouts.app')

@section('title', '个人编辑页')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        个人编辑页
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('users.update', $user) }}">
                            @include('shared._errors')
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="name">姓名</label>
                                <input value="{{ old('name', $user->name) }}" id="name" name="name" class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label for="intro">个人简介</label>
                                <textarea class="form-control" name="intro" id="intro" rows="5">{{ old('intro', $user->intro) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="avatar">个人头像</label>
                                <input name="avatar" id="avatar" type="file" class="form-control-file">
                                @if($user->avatar)
                                    <img class="my-4" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">更改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
