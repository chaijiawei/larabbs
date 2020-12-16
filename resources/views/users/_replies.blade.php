@foreach($replies as $reply)
    <li class="list-group-item">
        <a href="{{ $reply->topic->link() }}">{{ $reply->topic->title }}</a>
        <p>
            {!! $reply->content !!}
        </p>
        <span class="text-secondary">
            <i class="far fa-clock"></i>回复于
            {{ $reply->created_at->diffForHumans() }}
        </span>
    </li>
@endforeach
<div class="my-4">
    {{ $replies->appends(request()->all())->links() }}
</div>
