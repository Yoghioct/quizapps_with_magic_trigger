<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gala Dinner Otsuka</title>

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
                                            <video width="100%" height="100%" autoplay loop muted playsinline   >
                                                <source src="{{ asset('assets/video/galadinner.mp4')  }}" type="video/mp4">
                                            </video>
                                        </div>

                                         <!-- Opening Sentence -->
                                         <div class="mb-6 mt-6">
                                            <h1 class="text-2xl font-bold mb-4">Hi! {{ $participant['full_name'] }}</h1>
                                            <p><span class="font-semibold">Welcome to the Gala Dinner PT Otsuka Indonesia!</span> Enjoy the night and create unforgettable memories.</p>
                                        </div>

                                        <!-- Participant Details -->
                                        {{-- <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                                            <h2 class="text-2xl font-bold mb-4">Participant Details</h2>
                                            <p><strong>Name:</strong> {{ $participant['full_name'] }}</p>
                                            <p><strong>Team:</strong> {{ $participant['team']['name'] }}</p>
                                            <p><strong>Table:</strong> {{ $participant['dinner_table']['nama_table'] }} (No. {{ $participant['dinner_table']['nomor_table'] }})</p>
                                        </div> --}}

                                        <!-- No Team & No Table -->
                                        <div class="mt-8 text-center">
                                            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-gray-200">
                                                Your table is:
                                            </h1>
                                            <h2 class="text-2xl text-blue-600 mt-4">
                                                ZONE {{ $participant['dinner_table']['zona_table'] }}
                                            </h2>
                                            <h2 class="text-4xl font-bold text-blue-600 mb-12">
                                                TABLE {{ $participant['dinner_table']['nomor_table'] }}
                                            </h2>
                                        </div>

                                        <!-- Agenda List -->
                                        <div class="mt-10 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md p-6">
                                            <h2 class="text-2xl font-bold mb-6 text-center">Agenda</h2>
                                            <ul class="list-disc pl-6 space-y-6">
                                                <li><strong>6:30 PM - 7:00 PM:</strong>
                                                    <ul class="list-circle pl-4 ml-4 space-y-1">
                                                        <li>● Welcome to Gala Dinner 50th Anniversary PT Otsuka Indonesia</li>
                                                    </ul>
                                                </li>
                                                <li><strong>7:00 PM - 8:20 PM:</strong>
                                                    <ul class="list-circle pl-4 ml-4 space-y-1">
                                                        <li>● Awa Odori - HO Dance</li>
                                                        <li>● Speech by President Director - Mr. Tetsuya Yamamoto</li>
                                                        <li>● Toast with all participants, BOD, and VIP</li>
                                                        <li>● Dinner</li>
                                                    </ul>
                                                </li>
                                                <li><strong>8:25 PM - 9:40 PM:</strong>
                                                    <ul class="list-circle pl-4 ml-4 space-y-1">
                                                        <li>● Awarding</li>
                                                        <li>● Testimony by Ketua SPSI Mr. Eben Pambudi</li>
                                                        <li>● Best Costume</li>
                                                        <li>● Otsuka Indonesia Factory Performance</li>
                                                        <li>● Otsuka Indonesia HO Performance</li>
                                                    </ul>
                                                </li>
                                                <li><strong>9:40 PM - 11:15 PM:</strong>
                                                    <ul class="list-circle pl-4 ml-4 space-y-1">
                                                        <li>● Otsuka Indonesia Special Performance</li>
                                                        <li>● Guest Star Performance</li>
                                                    </ul>
                                                </li>
                                                <li><strong>11:15 PM:</strong>
                                                    <ul class="list-circle pl-4 ml-4 space-y-1">
                                                        <li>● Closing - All participants, committee, BOD, and President Director go to the stage together</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>


                                        <!-- Closing Sentence -->
                                        <div class="mt-6">
                                            <p class="text-lg font-medium">
                                                Thank you for joining us tonight! Let’s celebrate 50 years of excellence together!
                                            </p>
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
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
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
