@extends('layouts.app')

@section('title', '消息通知')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="far fa-bell"></i>
                        消息通知
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($notifications as $notification)
                                @includeIf('notification/types/_' .
                                    \Illuminate\Support\Str::snake(
                                        \Illuminate\Support\Str::afterLast($notification->type, '\\')
                                     ))
                            @endforeach
                        </ul>

                        <div class="my-4">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
