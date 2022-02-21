@extends('_layouts.main')

@php
    $page->type = 'article';
@endphp

@section('body')
    <div class="overflow-hidden shadow-lg rounded-lg bg-white mb-12">
        @if ($page->cover_image)
            <img alt="{{ $page->title }} cover image" src="{{ $page->cover_image }}" class="max-h-60 w-full object-cover"/>
        @endif
        
        <div class="p-4">
            <h1 class="text-gray-800">
                {{ $page->title }}
            </h1>

            @yield('content')
        </div>
    </div>
    {{-- 
    @if ($page->cover_image)
        <img src="{{ $page->cover_image }}" alt="{{ $page->title }} cover image" class="mb-2 rounded-md shadow-md">
    @endif

    <h1 class="leading-none mb-2">{{ $page->title }}</h1>

    <p class="text-gray-700 text-xl md:mt-0">{{ $page->author }}  •  {{ date('F j, Y', $page->date) }}  •  {{ $page->estimate_reading_time }}</p>

    @if ($page->categories)
        @foreach ($page->categories as $i => $category)
            <a
                href="{{ '/blog/categories/' . $category }}"
                title="View posts in {{ $category }}"
                class="inline-block bg-gray-300 hover:bg-blue-200 leading-loose tracking-wide text-gray-800 uppercase text-xs font-semibold rounded mr-4 px-3 pt-px"
            >{{ $category }}</a>
        @endforeach
    @endif

    <div class="border-b border-blue-200 mb-10 pb-4" v-pre>
        @yield('content')
    </div>
    --}}

    <nav class="flex justify-between text-sm md:text-base">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->title }}">
                    &LeftArrow; {{ $next->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->title }}">
                    {{ $previous->title }} &RightArrow;
                </a>
            @endif
        </div>
    </nav> 
    
@endsection
