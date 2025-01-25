@section('title', 'Leaaderboard - 50th Anniversary PT Otsuka Indonesia')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- content --}}
                    <main>
                        <div class="grid" style="margin-bottom: 50px">

                            <div x-data="leaderboard()" x-init="fetchData()" class="grid">
                                <!-- Modal Container -->
                                <div x-show="modalVisible" class="fixed inset-0 flex items-center justify-center"">
                                    <div class="background-modal"></div>
                                    <div class="bg-white dark:bg-white p-6 rounded-lg shadow-lg z-10" style="max-width: 620px; width: 87% !important;  z-index: 1000;">
                                        <h2 class="text-xl font-semibold text-black dark:text-black" x-text="modalTeam.name"></h2>
                                        <div class="flex justify-between items-center border-b pb-4 mb-4 mt-4"></div>



                                        <div class="space-y-4">
                                            <div x-show="scoreDetails.length == 0" class="text-center p-4">
                                                <span>No scores available.</span>
                                            </div>

                                            <div x-show="scoreDetails.length > 0" class="text-center p-4">
                                                <template x-for="(score, index) in scoreDetails" :key="index">
                                                    <li class="flex justify-between" style="margin-bottom: 10px">
                                                        <span x-text="score.game_name"></span>
                                                        <span class="font-semibold" x-text="score.score"></span>
                                                    </li>
                                                </template>
                                            </div>


                                            <div class="flex justify-between items-center border-b pb-4 mb-4 mt-4"></div>

                                            <li class="flex justify-between">
                                                <span>Total Score:</span>
                                                <span class="font-extrabold" x-text="modalTeam.total_score"></span>
                                            </li>


                                            {{-- <ul class="space-y-2">
                                                <template x-for="(score, index) in scoreDetails" :key="score.game_id || index">
                                                    <li class="flex justify-between">
                                                        <span x-text="score.game_name"></span>
                                                        <span class="font-semibold" x-text="score.score"></span>
                                                    </li>
                                                </template>
                                            </ul> --}}
                                        </div>

                                        <div class="mt-6 text-center">
                                            <button @click="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 w-full">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Leaderboard Cards -->
                                <div x-show="loading" class="text-center text-gray-500">
                                    <svg class="animate-spin h-5 w-5 text-gray-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4zm2 5.291A7.963 7.963 0 014 12h4a4.001 4.001 0 002 3.291V20a7.962 7.962 0 01-4-2.709z">
                                        </path>
                                    </svg>
                                    <p>Loading...</p>
                                </div>

                                <template x-for="(team, index) in teams" :key="team.id || index">
                                    <div class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out"
                                        :class="team.movement" style="margin-top: 15px" @click="openModalScore(team, index, $event)">

                                        <!-- Rank Badge -->
                                        <div :class="`badge-ranking-${index + 1 > 3 ? 'default' : index + 1}`">
                                            Rank <span x-text="index + 1" style="margin-left: 5px"></span>
                                        </div>

                                        <!-- Team Details -->
                                        <div>
                                            <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                            <h5 class="text-l font-regular text-black dark:text-*">Score: <span x-text="team.total_score"></span></h5>
                                        </div>

                                        <div class="flex-1"></div>

                                        <!-- SVG Section -->
                                        <div>
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1F6FB8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
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
                teams: [],
                loading: true,
                modalVisible: false,
                modalTeam: {}, // Data of the selected team
                scoreDetails: [], // Detailed scores fetched for the selected team
                previousState: {},
                fetchData() {
                    setInterval(() => {
                        fetch('/api/leaderboard')
                            .then(res => res.json())
                            .then(data => {
                                this.teams = data.map((team, index) => {
                                    const movement = this.getMovement(team.id, index);
                                    this.previousState[team.id] = index;
                                    return {
                                        ...team,
                                        movement,
                                    };
                                });
                                this.loading = false;
                            });
                    }, 3000000);
                },
                getMovement(id, newIndex) {
                    const previousIndex = this.previousState[id];
                    if (previousIndex === undefined) return '';
                    if (previousIndex > newIndex) return 'animate-move-up';
                    if (previousIndex < newIndex) return 'animate-move-down';
                    return '';
                },
                openModalScore: debounce(function(team, index, event) {
                    this.modalVisible = true;
                    this.modalTeam = team;

                    fetch(`/leaderboard/${team.id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data.scores.length);
                if(data.scores.length == 0){
                    this.scoreDetails = [];
                } else if (Array.isArray(data.scores)) {
                    // Use directly if it's an array of objects with game_name and score
                    this.scoreDetails = data.scores.map((score, index) => ({
                        game_name: score.game_name, // Ensure `game_name` exists
                        score: score.score,       // Ensure `score` exists
                        id: score.id || index,    // Add a unique key if missing
                    }));
                } else {
                    // If data.scores is an object, convert it to an array
                    this.scoreDetails = Object.entries(data.scores).map(([key, value]) => ({
                        game_name: key,      // Use the object key as `game_name`
                        score: value,        // Use the object value as `score`
                    }));
                }
            })
            .catch(err => {
                console.error("Error fetching scores:", err);
                this.scoreDetails = []; // Handle errors gracefully
            });
                    }, 300),
                closeModal() {
                    this.modalVisible = false;
                    this.modalTeam = {};
                    this.scoreDetails = [];
                },
            };
        }

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        </script>
    <style>
        .background-modal {
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999;
        }

        .item-card {
            cursor: pointer;
        }

        /* .item-card:hover {
            transform: scale(1.02);
        } */

        .item-card:active {
            transform: scale(0.98);
        }

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
