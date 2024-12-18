<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" style="margin: 15px">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-1 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Total Scores Recorded") }}
                </div>
                <div class="p-4 font-black text-4xl dark:text-white" style="float: right">
                    <h1>{{ $totalScore }}</h1>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Team Registered") }}
                </div>
                <div class="p-4 font-black text-4xl dark:text-white" style="float: right">
                    <h1>{{ $teams }}</h1>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Committees Registered") }}
                </div>
                <div class="p-4 font-black text-4xl dark:text-white" style="float: right">
                    <h1>{{ $users }}</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
