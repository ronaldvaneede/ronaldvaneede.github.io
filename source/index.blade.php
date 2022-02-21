@extends('_layouts.main')

@section('body')

    @foreach ($posts->where('featured', true)->where('published', true) as $post)
        @include('_components.post-preview-inline')
    @endforeach

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
        @foreach ($posts->where('featured', false)->where('published', true) as $post)
            @include('_components.post-preview-inline')
        @endforeach
    </div>
@stop
