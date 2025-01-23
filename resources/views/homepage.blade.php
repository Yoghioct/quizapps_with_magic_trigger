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
                    <a href="/">
                        <div class="flex lg:justify-center">
                            {{-- Light mode logo --}}
                            <img class="block dark:hidden" style="width: 100px" src="https://sfe.otsuka.co.id/assets/images/50th.png" alt="Logo Light Mode">
                            {{-- Dark mode logo --}}
                            <img class="hidden dark:block" style="width: 100px; -webkit-filter: invert(100%);" src="https://sfe.otsuka.co.id/assets/images/50th.png" alt="Logo Dark Mode">
                        </div>
                    </a>
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
                                {{-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif --}}
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl mx-auto" style="margin-top: 100px;">

                <main class="mt-6">
                    <div class="grid" style="margin-bottom: 100px">

                        <a href="/amazing-race/leaderboard" target="_blank" class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out" style="margin-top: 15px">
                            <div>
                                <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                <h5 class="text-l font-regular text-black dark:text-*">Leaderboard Amazing Race</h5>
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
                        </a>

                        <a href="/factory-visit" target="_blank" class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out" style="margin-top: 15px">
                            <div>
                                <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                <h5 class="text-l font-regular text-black dark:text-*">View Factory Visit Schedule</h5>
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
                        </a>

                        <a href="/amazing-race" target="_blank" class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out" style="margin-top: 15px">
                            <div>
                                <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                <h5 class="text-l font-regular text-black dark:text-*">View Amazing Race Team</h5>
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
                        </a>

                        <a href="/open-museum" target="_blank" class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out" style="margin-top: 15px">
                            <div>
                                <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                <h5 class="text-l font-regular text-black dark:text-*">View Open Museum Schedule</h5>
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
                        </a>

                        <a href="/gala-dinner" target="_blank" class="item-card col-span-12 flex items-center gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/10 transition-all duration-500 ease-in-out" style="margin-top: 15px">
                            <div>
                                <h2 class="text-xl font-semibold text-black dark:text-*" x-text="team.name"></h2>
                                <h5 class="text-l font-regular text-black dark:text-*">View Gala Dinner Table</h5>
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
                        </a>



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
            <a href="https://instagram.com/yoghioctopus" target="_blank">by @yoghioctopus</a>
        </footer>
    </div>

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

        .item-card:hover {
            transform: scale(1.02);
        }

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
</body>

</html>
