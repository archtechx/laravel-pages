<x-dynamic-component :component="config('pages.views.layout')">
    <div class="w-full flex justify-center my-16 px-4">
        <div class="prose prose-indigo">
            <h1>{{ $page->title }}</h1>

            {!! Str::markdown($page->content) !!}
        </div>
    </div>
</x-dynamic-component>
