<x-layout>
    <x-slot:title>{{ $post['title'] }} - Mini-CMS</x-slot:title>

    <article>
        <h1 class="text-3xl font-bold">{{ $post['title'] }}</h1>
        <p class="mt-1 text-sm text-gray-500">
            Publié le {{ $post['date'] ?? $post['year'] }}
            @if (isset($post['author'])) par {{ $post['author'] }} @endif
        </p>

        @if (is_array($post['body']))
            <div class="mt-6 space-y-4 text-gray-700 leading-relaxed">
                @foreach ($post['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        @else
            <p class="mt-6 leading-relaxed text-gray-700">{{ $post['body'] }}</p>
        @endif
    </article>

    <p class="mt-8">
        <a href="{{ route('posts.index') }}" class="text-indigo-600 underline">Retour à la liste des articles</a>
    </p>
</x-layout>