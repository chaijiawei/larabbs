@extends('layouts.app')

@section('title', '话题列表')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        话题列表
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($topics as $topic)
                                <li class="media my-3">
                                    <img src="" class="mr-3" alt="">
                                    <div class="media-body">
                                        <p>{{ $topic->title }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $topics->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
@stop
