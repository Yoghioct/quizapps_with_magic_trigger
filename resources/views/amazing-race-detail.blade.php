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
            <div class="relative w-full max-w-2xl lg:max-w-7xl">
                <main class="mt-6">
                    <div class="grid" style="margin-bottom: 100px">
                        <div class="py-12" style="margin: 15px">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <!-- Flash Message -->
                                        @if (session('success'))
                                            <div
                                                class="mb-4 text-green-600 bg-green-100 border border-green-500 rounded-md p-4">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="mb-4 text-red-600 dark:bg-red-800 border border-red-500 rounded-md p-4"
                                                style="background-color:rgb(254 226 226)">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <div class="video-container">
                                            <video width="100%" height="100%" autoplay loop muted playsinline>
                                                <source src="{{ asset('assets/video/amazingrace.mp4') }}"
                                                    type="video/mp4">
                                            </video>
                                        </div>

                                        <!-- Opening Sentence -->
                                        <div class="mb-6 mt-6">
                                            <h1 class="text-2xl font-bold mb-4">Hi! {{ $participant['full_name'] }}</h1>
                                            <p class="text-lg"><span class="font-semibold">Welcome to the Amazing Race PT Otsuka
                                                    Indonesia!</span> You and your team are now registered. Get ready to
                                                face 6 exciting challenges!</p>
                                        </div>

                                        <!-- No Team & No Table -->
                                        <div class="mt-8 text-center">
                                            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-gray-200">
                                                Your team is:
                                            </h1>
                                            <h2 class="font-bold text-blue-600 mt-4" style="font-size: 3rem">
                                                {{ $participant['team']['name'] }}
                                            </h2>
                                            @if ($participant['team']['zona_team'] == 'GREEN')
                                                <div class="zone-green">
                                                    <h2>
                                                        ZONE {{ $participant['team']['zona_team'] }}
                                                    </h2>
                                                </div>
                                            @elseif ($participant['team']['zona_team'] == 'YELLOW')
                                                <div class="zone-yellow">
                                                    <h2>
                                                        ZONE {{ $participant['team']['zona_team'] }}
                                                    </h2>
                                                </div>
                                            @elseif ($participant['team']['zona_team'] == 'RED')
                                                <div class="zone-red">
                                                    <h2>
                                                        ZONE {{ $participant['team']['zona_team'] }}
                                                    </h2>
                                                </div>
                                            @else
                                                <div class="zone-default">
                                                    <h2>
                                                        ZONE {{ $participant['team']['zona_team'] }}
                                                    </h2>
                                                </div>
                                            @endif
                                            <p class="mt-4">Good luck, and let the best team win!</p>
                                            <div style="margin: 50px 0"></div>
                                        </div>
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
        <footer
            class="py-4 text-blue-500 text-center text-sm text-black dark:text-white/70 shadow-md fixed bottom-0 w-full bg-white dark:bg-gray-900">
            <a href="https://instagram.com/yoghioctopus" target="_blank">by @yoghioctopus</a>
        </footer>
    </div>

    <script>
        function submitData() {
            console.log('aaa');
        }
    </script>

    <style>
        .zone-green {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #047857;
            /* Green text */
            background-color: #d1fae5;
            /* Light green background */
            border-radius: 5px;
            /* Rounded badge */
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .zone-yellow {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #854d0e;
            /* Yellow text */
            background-color: #fef3c7;
            /* Light yellow background */
            border-radius: 9999px;
            /* Rounded badge */
            margin-top: 1rem;
            margin-bottom: 10px;
        }

        .zone-red {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #b91c1c;
            /* Red text */
            background-color: #fee2e2;
            /* Light red background */
            border-radius: 9999px;
            /* Rounded badge */
            margin-top: 1rem;
            margin-bottom: 10px;
        }

        .zone-default {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            /* Gray text */
            background-color: #f3f4f6;
            /* Light gray background */
            border-radius: 9999px;
            /* Rounded badge */
            margin-top: 1rem;
            margin-bottom: 10px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 */
            height: 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</body>

</html>
