<li class="media my-4">
    <img class="mr-2" width="64" src="{{ $notification->data['reply_user']['avatar'] }}" alt="{{ $notification->data['reply_user']['name'] }}">
    <div class="media-body">
        <a href="{{ route('users.show', $notification->data['reply_user']['id']) }}">{{ $notification->data['reply_user']['name'] }}</a>
        评论了
        <a href="{{ $notification->data['topic']['link'] }}">{{ $notification->data['topic']['title'] }}</a>
        <span class="text-secondary float-right">
            <i class="far fa-clock"></i>
            {{ $notification->created_at->diffForHumans() }}
        </span>
        <div>{!! $notification->data['reply']['content'] !!}</div>
    </div>
</li>
