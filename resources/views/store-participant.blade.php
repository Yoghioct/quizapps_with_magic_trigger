<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Participant') }}
        </h2>
    </x-slot>

    <div class="py-12">
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

                    <form action="{{ route('participant.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-4">
                            <label for="nip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code (NIP)</label>
                            <input type="text" id="nip" name="nip" min="1" max="100" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="full_name" name="full_name" min="1" max="100" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <!-- Team ID -->
                        <div class="mb-4">
                            <label for="id_team" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Team</label>
                            <select id="id_team" name="id_team" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select Team</option>
                                <!-- Replace with dynamic data -->
                                <@foreach($data['teams'] as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Open Museum ID -->
                        <div class="mb-4">
                            <label for="id_open_museum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Open Museum</label>
                            <select id="id_open_museum" name="id_open_museum" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select Gelombang Open Museum</option>
                                <!-- Replace with dynamic data -->
                                <@foreach($data['openMuseum'] as $openmuseum)
                                    <option value="{{ $openmuseum->id }}">{{ $openmuseum->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dinner Table ID -->
                        <div class="mb-4">
                            <label for="id_dinner_table" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dinner Table</label>
                            <select id="id_dinner_table" name="id_dinner_table" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select Dinner Table</option>
                                <!-- Replace with dynamic data -->
                                <@foreach($data['dinnerTable'] as $dinnertable)
                                    <option value="{{ $dinnertable->id }}">{{ $dinnertable->nomor_table }}</option>
                                @endforeach
                            </select>
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
