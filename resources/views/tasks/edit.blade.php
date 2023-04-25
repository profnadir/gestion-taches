<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="titre" class="block font-medium text-sm text-gray-700">{{ __('Titre') }}</label>

                            <input id="titre" type="text" class="form-input mt-1 block w-full" name="titre" value="{{ old('titre', $task->titre) }}" required autofocus />
                            @error('titre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>

                            <textarea id="description" name="description" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5" required>{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="date_echeance" class="block font-medium text-sm text-gray-700">{{ __('Date d\'échéance') }}</label>

                            <input id="date_echeance" type="date" class="form-input mt-1 block w-full" name="date_echeance" value="{{ old('date_echeance', \Carbon\Carbon::parse($task->date_echeance)->format('Y-m-d')) }}" required />
                            @error('date_echeance')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="statut" class="block font-medium text-sm text-gray-700">{{ __('Statut') }}</label>

                            <select id="statut" name="statut" class="form-select block w-full mt-1">
                                <option value="en cours" @if(old('statut', $task->statut) == 'en cours') selected @endif>En cours</option>
                                <option value="terminée" @if(old('statut', $task->statut) == 'terminée') selected @endif>Terminée</option>
                            </select>
                            @error('statut')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                                Modifier la tâche
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
