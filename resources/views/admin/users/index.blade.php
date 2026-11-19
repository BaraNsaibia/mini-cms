<x-layout>
    <x-slot:title>Gestion des utilisateurs - Mini-CMS</x-slot:title>

    <x-page-header title="Utilisateurs" subtitle="Gérer les rôles des utilisateurs." />

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                    <th class="py-3 px-4">Nom</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Rôle</th>
                    <th class="py-3 px-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @foreach ($users as $user)
                    <tr>
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->isAdmin() ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            @can('updateRole', $user)
                                <form method="POST" action="{{ route('admin.users.role', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                        {{ $user->isAdmin() ? 'Rétrograder en auteur' : 'Promouvoir en administrateur' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">Non modifiable</span>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
