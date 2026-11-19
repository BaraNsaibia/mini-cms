<x-layout>
    <x-slot:title>Catégorie introuvable - Mini-CMS</x-slot:title>

    <x-page-header title="Catégorie introuvable" subtitle="Cette catégorie n'existe pas ou a été supprimée." />

    <x-alert type="info" title="Que faire ?" class="max-w-2xl">
        Vérifiez l'adresse, ou choisissez une catégorie existante ci-dessous.
    </x-alert>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Catégories disponibles :</h2>
        <ul class="flex flex-wrap gap-2">
            @forelse ($categories as $category)
                <li>
                    <a href="{{ route('posts.category', $category) }}" class="inline-block rounded-md bg-gray-100 px-3 py-1.5 text-sm font-medium text-indigo-600 hover:bg-gray-200">
                        {{ $category->name }}
                    </a>
                </li>
            @empty
                <li class="text-sm text-gray-500">Aucune catégorie disponible.</li>
            @endforelse
        </ul>
    </div>

    <p class="mt-6">
        <a href="{{ route('home') }}" class="font-medium text-indigo-600 hover:underline">Retour à l'accueil</a>
    </p>
</x-layout>
