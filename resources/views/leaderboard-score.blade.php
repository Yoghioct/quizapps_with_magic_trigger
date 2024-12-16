<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Score') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- content --}}
                    <main>
                        <div class="grid" style="margin-bottom: 50px">

                            <div x-data="leaderboard()" x-init="fetchData()" class="grid">
                                <div x-show="loading" class="text-center text-gray-500">
                                    <svg class="animate-spin h-5 w-5 text-gray-500 mx-auto"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4zm2 5.291A7.963 7.963 0 014 12h4a4.001 4.001 0 002 3.291V20a7.962 7.962 0 01-4-2.709z">
                                        </path>
                                    </svg>
                                    <p>Loading...</p>
                                </div>

                                <template x-for="(team, index) in teams" :key="team.id">
                                    <div class="col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out"
                                        :class="team.movement" style="margin-top: 15px">
                                        <!-- Rank Badge -->
                                        <div :class="`badge-ranking-${index + 1 > 3 ? 'default' : index + 1}`">
                                            Rank <span x-text="index + 1" style="margin-left: 5px"></span>
                                        </div>

                                        <!-- Team Details -->
                                        <div>
                                            <h2 class="text-xl font-semibold text-black dark:text-white"
                                                x-text="team.name"></h2>
                                            <h5 class="text-l font-regular text-black dark:text-white">Score: <span
                                                    x-text="team.total_score"></span></h5>
                                        </div>

                                        <div class="flex-1"></div>

                                        <!-- SVG Section -->
                                        <div>
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#1F6FB8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                            </svg>
                                        </div>
                                    </div>
                                </template>
                            </div>

                        </div>
                        {{-- <div id="leaderboard-card"></div> --}}
                    </main>
            </div>
        </div>
    </div>

    <script>
        function leaderboard() {
            return {
                teams: [], // Initialize the teams array
                loading: true,
                previousState: {}, // Track the previous state of ranks
                fetchData() {
                    // Fetch leaderboard data from the API every 3 seconds
                    setInterval(() => {
                        fetch('/api/leaderboard')
                            .then(res => res.json())
                            .then(data => {
                                this.teams = data.map((team, index) => {
                                    const movement = this.getMovement(team.id, index);
                                    this.previousState[team.id] = index; // Update previous state
                                    return {
                                        ...team,
                                        movement,
                                    };
                                });
                                this.loading = false;
                            });
                    }, 3000);
                },
                getMovement(id, newIndex) {
                    const previousIndex = this.previousState[id];
                    if (previousIndex === undefined) return ''; // No movement for the first load
                    if (previousIndex > newIndex) return 'animate-move-up'; // Rank improved
                    if (previousIndex < newIndex) return 'animate-move-down'; // Rank dropped
                    return ''; // No change
                },
            };
        }
    </script>
    <style>
        .animate-move-up {
            animation: moveUp 0.5s ease-in-out;
            background-color: #d4edda;
            /* Light green for movement up */
        }

        .animate-move-down {
            animation: moveDown 0.5s ease-in-out;
            background-color: #f8d7da;
            /* Light red for movement down */
        }

        @keyframes moveUp {
            from {
                transform: translateY(20px);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes moveDown {
            from {
                transform: translateY(-20px);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

</x-app-layout>
