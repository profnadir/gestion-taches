<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-bold">{{ $task->titre }}</h2>
                    <p>{{ $task->description }}</p>
                    <p>{{ $task->date_echeance }}</p>

                    <hr class="my-6">

                    <h4 class="font-bold mb-2">{{ __('Historique des modifications') }}</h4>

                    <div class="divide-y divide-gray-300">
                        @forelse ($task->histories as $history)
                            <div class="py-3">
                                <p class="text-gray-600 text-sm mb-2">{{ $history->user->name }} {{ __('a') }} {{ $history->action }} {{ __('la tâche le') }} {{ $history->created_at->format('d/m/Y H:i:s') }}</p>
                                <div class="flex">
                                    <div class="w-1/2 border rounded-lg p-4">
                                      <h4 class="mb-2 font-medium">Old values</h4>
                                      <ul class="list-disc list-inside">
                                        @foreach ($history->old_value as $attribute => $value)
                                          <li class="mb-1">{{ $attribute }} : {{ $value }} </li>
                                        @endforeach
                                      </ul>
                                    </div>
                                    <div class="w-1/2 border rounded-lg p-4">
                                      <h4 class="mb-2 font-medium">New values</h4>
                                      <ul class="list-disc list-inside">
                                        @foreach ($history->new_value as $attribute => $value)
                                          <li class="mb-1">{{ $attribute }} : {{ $value }} </li>
                                        @endforeach
                                      </ul>
                                    </div>
                                </div>
                                  
                                  
                            </div>
                        @empty
                            <p class="text-gray-400">{{ __('Aucune modification pour cette tâche.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
