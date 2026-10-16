<x-layout>
     <-slot:title>{ $post->title }} - Mini-CMS</x-slot:title>

    <article class="max-w-2xl">
        <a href="{{ route(posts.index') }}" class="text-sm text-indigo-600 hover:underline">Retour aux articles</a>

        <h1 class="text-3xl font-bold mt-4 mb-2">{{ $post->title }}</h1>
 
        <p class="text-sm text-gray-500 mb-6">
            @if ($post->published_at)
                Publié le {{ $post->publised_at->format('d/m/Y') }}
            @else
                Brouillon
            @endi
        </p>

         <div class="tex
    t
-gray-800 leading-relaxed whitespace-pre-line">{{ $post->body }}</div>
    </article>
    </x-layout>