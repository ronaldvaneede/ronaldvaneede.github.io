{{--
<div class="flex flex-col mb-4">
    @if ($tool->cover_image)
        <img src="{{ $tool->cover_image }}" alt="{{ $tool->title }} cover image" class="mb-6 rounded-md shadow-md">
    @endif
    
    <h2 class="text-3xl mt-0">
        {{ $tool->title }}
    </h2>

    <a
        href="{{ $tool->link }}"
        title="buy on amazon - {{ $tool->title }}"
        class="uppercase font-semibold tracking-wide mb-2"
    >Buy on amazon</a>
</div>
--}}

<div class="overflow-hidden shadow-lg rounded-lg bg-white mb-12 p-4">
    <img alt="{{ $tool->title }} cover image" src="{{ $tool->cover_image }}" class="max-h-60 w-full object-cover"/>
    <div class="dark:bg-gray-800 p-4">
        <p class="text-gray-800 dark:text-white text-2xl font-medium mb-0">
            {{ $tool->title }}
        </p>
    </div>
    <div class="mt-4">
        <a href="{{ $tool->link }}" type="button" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
            Buy on amazon
        </a>
    </div>
    {{-- <div class="mt-4">
        <a href="{{ $tool->link }}" type="button" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
            Buy on bol.com
        </a>
    </div> --}}
</div>
