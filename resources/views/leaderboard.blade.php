<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Amazing Race Otsuka</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.aio.co.id/assets/favicon/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <header class="fixed top-0 w-full z-50 bg-white dark:bg-black shadow-md">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl mx-auto flex items-center justify-between py-4">
                    <div class="flex lg:justify-center">
                        <img style="width: 200px"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Otsuka_Holdings_logo.svg/500px-Otsuka_Holdings_logo.svg.png">
                    </div>
                    @if (Route::has('login'))
                        <nav class="flex space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl mx-auto" style="margin-top: 100px;">

                <main class="mt-6">
                    <div class="grid" style="margin-bottom: 100px">

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
                                        <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name">
                                        </h2>
                                        <h5 class="text-l font-regular text-black dark:text-*">Score: <span
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

                {{-- <footer class="py-16 text-center text-sm text-black dark:text-white/70 fixed bottom-0 w-full bg-white dark:bg-gray-900"> --}}
                {{-- @yoghioctopus --}}
                {{-- </footer> --}}

            </div>
        </div>
        <footer
            class="py-4 text-blue-500 text-center text-sm text-black dark:text-white/70 shadow-md fixed bottom-0 w-full bg-white dark:bg-gray-900">
            <a href="https://instagram.com/yoghioctopus" target="_blank">@yoghioctopus</a>
        </footer>
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
</body>

</html>
