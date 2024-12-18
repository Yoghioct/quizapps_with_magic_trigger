<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Score') }}
        </h2>
    </x-slot>

    <div class="py-12" style="margin: 15px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <!-- Flash Message -->
                    @if (session('success'))
                        <div class="mb-4 text-green-600 bg-green-100 border border-green-500 rounded-md p-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-red-600 dark:bg-red-800 border border-red-500 rounded-md p-4" style="background-color:rgb(254 226 226)">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Form for Inputting Score -->
                    <form action="{{ route('score.store') }}" method="POST">
                        @csrf

                        <!-- Game ID -->
                        <div class="mb-4">
                            <label for="game_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Game</label>
                            <select id="game_id" name="game_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select Game</option>
                                <!-- Replace with dynamic data -->
                                <@foreach($games as $game)
                                    <option value="{{ $game->id }}">{{ $game->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Team ID -->
                        <div class="mb-4">
                            <label for="team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Team</label>
                            <select id="team_id" name="team_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select Team</option>
                                <!-- Replace with dynamic data -->
                                <@foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Score -->
                        <div class="mb-4">
                            <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Score</label>
                            <input type="number" id="score" name="score" min="1" max="100" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
