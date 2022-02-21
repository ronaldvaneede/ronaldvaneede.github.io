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
            <p class="text-gray-800 text-3xl font-medium mb-0">
                {{ $post->title }}
            </p>
            <p class="text-gray-600 text-sm mb-2">
                {{ $post->getDate()->format('F j, Y') }} - {{ $post->estimate_reading_time }}
            </p>
            <p class="text-gray-600 font-light text-md">
                {!! $post->getExcerpt(200) !!}
            </p>
        </div>
    </a>
</div>
