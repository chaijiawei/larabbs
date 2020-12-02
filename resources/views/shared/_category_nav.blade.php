@foreach($categories as $category)
    <li class="nav-item
        @if(request()->category && request()->category->is($category))
            active
        @endif
    ">
        @php
        @endphp
        <a class="nav-link" href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
    </li>
@endforeach
