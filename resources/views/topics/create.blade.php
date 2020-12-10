@extends('layouts.app')

@section('title', '新建话题')

@push('script')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        新建话题
                    </div>
                    <div class="card-body">
                        <form action="{{ route('topics.store') }}" method="post">
                            @include('shared._errors')
                            @csrf

                            <div class="form-group">
                                <label for="title">标题</label>
                                <input value="{{ old('title') }}" class="form-control" type="text" name="title" id="title">
                            </div>

                            <div class="form-group">
                                <label for="category_id">话题分类</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="" disabled selected>请选择分类</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option @if(old('category_id') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="body">话题内容</label>
                                <textarea class="form-control" name="body" id="body" rows="5">{{ old('body') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">发表</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{--@push('script')--}}
{{--    <script>--}}
{{--        $(function() {--}}
{{--            tinymce.init({--}}
{{--                selector: '#body',--}}
{{--                height: 300,--}}
{{--                content_style: "img {max-width:100%;}",--}}
{{--                language:'zh_CN',--}}
{{--                plugins: 'image',--}}
{{--                images_upload_url: '{{ route('topics.upload') }}',--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
