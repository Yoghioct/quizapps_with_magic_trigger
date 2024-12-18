<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Score') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('scores.update', $score->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Team Name (Read Only) -->
                        <div class="mb-4">
                            <label for="team" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Team</label>
                            <input type="text" id="team" name="team"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-200 dark:bg-gray-900 dark:border-gray-600"
                                   value="{{ $score->team->name }}" disabled />
                        </div>

                        <!-- Game Name (Read Only) -->
                        <div class="mb-4">
                            <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Game</label>
                            <input type="text" id="game" name="game"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-200 dark:bg-gray-900 dark:border-gray-600"
                                   value="{{ $score->game->name }}" disabled />
                        </div>

                        <!-- Score -->
                        <div class="mb-4">
                            <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Score</label>
                            <input type="number" id="score" name="score" min="1" max="100"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600"
                                   value="{{ $score->score }}" required />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('data-score') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
