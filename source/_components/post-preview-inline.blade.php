{{--
<div class="flex flex-col mb-4">
    <p class="text-gray-700 font-medium my-2">
        {{ $post->getDate()->format('F j, Y') }}
    </p>

    <h2 class="text-3xl mt-0">
        <a
            href="{{ $post->getUrl() }}"
            title="Read more - {{ $post->title }}"
            class="text-gray-900 font-extrabold"
        >{{ $post->title }}</a>
        <span class="read-estimate">
            {{ $post->estimate_reading_time }}
        </span>
    </h2>

    <p class="mb-4 mt-0">{!! $post->getExcerpt(200) !!}</p>

    <a
        href="{{ $post->getUrl() }}"
        title="Read more - {{ $post->title }}"
        class="uppercase font-semibold tracking-wide mb-2"
    >Read</a>
</div>
--}}

<div class="overflow-hidden shadow-lg rounded-lg cursor-pointer bg-white mb-12">
    <a href="{{ $post->getUrl() }}">
        <img alt="{{ $post->title }} cover image" src="{{ $post->cover_image }}" class="max-h-60 w-full object-cover"/>
        <div class="p-4">
            <h1 class="text-gray-800 mb-0">
                {{ $post->title }}
            </h1>
            <p class="text-gray-600 text-sm mb-2">
                {{ $post->getDate()->format('F j, Y') }} - {{ $post->estimate_reading_time }}
            </p>
            <p class="text-gray-600 font-medium text-md">
                {!! $post->getExcerpt(200) !!}
            </p>
            @if ($post->categories)
                @foreach ($post->categories as $i => $category)
                    <a
                        href="{{ '/blog/categories/' . $category }}"
                        title="View posts in {{ $category }}"
                        class="inline-block bg-gray-300 hover:bg-blue-200 leading-loose tracking-wide text-gray-800 uppercase text-xs font-semibold rounded mr-4 px-3 pt-px"
                    >{{ $category }}</a>
                @endforeach
            @endif
        </div>
    </a>
</div>
