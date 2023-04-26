<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des tâches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Ajouter une tâche
                        </a>
                    </div>
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <div>
                        <div>
                            <a href="{{ route('tasks.index', ['sort' => 'titre', 'order' => 'asc']) }}"
                               class="font-medium text-gray-600 hover:text-gray-800 {{ request('sort') == 'titre' && request('order') == 'asc' ? 'underline' : '' }}">
                                Titre A-Z
                            </a>
                            <span class="mx-2 text-gray-400">|</span>
                            <a href="{{ route('tasks.index', ['sort' => 'titre', 'order' => 'desc']) }}"
                               class="font-medium text-gray-600 hover:text-gray-800 {{ request('sort') == 'titre' && request('order') == 'desc' ? 'underline' : '' }}">
                                Titre Z-A
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('tasks.index', ['sort' => 'date_echeance', 'order' => 'asc']) }}"
                               class="font-medium text-gray-600 hover:text-gray-800 {{ request('sort') == 'date_echeance' && request('order') == 'asc' ? 'underline' : '' }}">
                                Date d'échéance ascendante
                            </a>
                            <span class="mx-2 text-gray-400">|</span>
                            <a href="{{ route('tasks.index', ['sort' => 'date_echeance', 'order' => 'desc']) }}"
                               class="font-medium text-gray-600 hover:text-gray-800 {{ request('sort') == 'date_echeance' && request('order') == 'desc' ? 'underline' : '' }}">
                                Date d'échéance descendante
                            </a>
                        </div>
                    </div>
                    {{-- <div>
                        <a href="{{ route('tasks.index', ['sort' => 'titre']) }}" class="text-blue-500 hover:underline">Trier par titre</a>
                        <span class="text-gray-500 mx-1">|</span>
                        <a href="{{ route('tasks.index', ['sort' => 'date_echeance']) }}" class="text-blue-500 hover:underline">Trier par date d'échéance</a>
                    </div> --}}
                    <div class="mt-3 mb-3">
                        <form action="{{ route('tasks.index') }}" method="GET">
                            <div class="flex items-center mt-4">
                                <label class="mr-2" for="statut">Statut:</label>
                                <select name="statut" id="statut" class="border border-gray-400 rounded px-2 py-1 mr-2">
                                    <option value="">Tous</option>
                                    <option value="en cours" @if(request('statut') == 'en cours') selected @endif>En cours</option>
                                    <option value="terminée" @if(request('statut') == 'terminée') selected @endif>Terminée</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    Filtrer
                                </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form action="{{ route('tasks.index') }}" method="GET">
                            <div class="flex items-center mb-4">
                                <label for="search" class="mr-2">Rechercher:</label>
                                <input type="text" name="search" id="search" value="{{ request()->input('search') }}" class="border p-1">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'échéance</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $task->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $task->titre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($task->date_echeance)->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->statut }}
                                        @if ($task->statut !== "terminée")
                                        <form method="POST" action="{{ route('tasks.complete', $task->id) }}">
                                            @csrf
                                            @method('POST')
                            
                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                Terminé
                                            </button>
                                        </form>
                                    @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <a href="{{ route('tasks.delete', $task->id) }}" class="text-red-600 hover:text-red-900">Supprimer</a>
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-teal-600 hover:text-teal-900">Afficher</a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
