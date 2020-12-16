@foreach($topics as $topic)
    <li class="list-group-item">
        <a href="{{ $topic->link() }}">{{ $topic->title }}</a>
        <span class="float-right text-secondary">
            <i class="far fa-clock"></i>
            {{ $topic->created_at->diffForHumans() }}
        </span>
    </li>
@endforeach
<div class="my-4">
    {{ $topics->appends(request()->all())->links() }}
</div>
