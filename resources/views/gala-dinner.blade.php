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
                        {{-- Light mode logo --}}
                        <img class="block dark:hidden" style="width: 100px" src="https://sfe.otsuka.co.id/assets/images/50th.png" alt="Logo Light Mode">
                        {{-- Dark mode logo --}}
                        <img class="hidden dark:block" style="width: 100px; -webkit-filter: invert(100%);" src="https://sfe.otsuka.co.id/assets/images/50th.png" alt="Logo Dark Mode">
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
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    <main class="mt-6">
                        <div class="grid" style="margin-bottom: 100px">

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
                                            {{-- <form action="{{ route('score.store') }}" method="POST"> --}}
                                            <form action="{{ route('galadinner.register') }}" method="POST">
                                                @csrf

                                                <!-- NIP -->
                                                <div class="mb-4">
                                                    <label for="team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIP (Nomor Induk Pegawai)</label>
                                                    <input type="text" id="code" name="code" maxlength="6" required
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" placeholder="09999"/>
                                                </div>

                                                <!-- Nama Lengkap (Sesuai Pro-int) -->
                                                <div class="mb-4">
                                                    <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap (Sesuai Pro-int)</label>
                                                    <input type="text" id="full_name" name="full_name" required
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" placeholder="John Doe"/>
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

                        </div>
                        {{-- <div id="leaderboard-card"></div> --}}
                    </main>

                    {{-- <footer class="py-16 text-center text-sm text-black dark:text-white/70 fixed bottom-0 w-full bg-white dark:bg-gray-900"> --}}
                        {{-- @yoghioctopus --}}
                    {{-- </footer> --}}

                </div>
            </div>
            <footer class="py-4 text-blue-500 text-center text-sm text-black dark:text-white/70 shadow-md fixed bottom-0 w-full bg-white dark:bg-gray-900">
                <a href="https://instagram.com/yoghioctopus" target="_blank">by @yoghioctopus</a>
            </footer>
        </div>

        <script>
            function submitData() {
                console.log('aaa');
            }
        </script>
    </body>

    </html>
