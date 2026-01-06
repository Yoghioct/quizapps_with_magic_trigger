<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gala Dinner Leaders Strategic Meeting</title>

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
                                            <source src="{{ asset('assets/video/execution.mp4')  }}" type="video/mp4">
                                            </video>
                                        </div>

                                         <!-- Opening Sentence -->
                                         <div class="mb-6 mt-6">
                                            <h1 class="text-2xl font-bold mb-4">Hi! <span class="text-red-600">{{ $participant['full_name'] }}</span></h1>
                                            <p class="text-lg"><span class="font-semibold">Welcome to the <span class="text-red-600">Gala Dinner</span> Leaders Strategic Meeting!</span> Enjoy the night and create unforgettable memories.</p>
                                        </div>

                                        <!-- Participant Details -->
                                        {{-- <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                                            <h2 class="text-2xl font-bold mb-4">Participant Details</h2>
                                            <p><strong>Name:</strong> {{ $participant['full_name'] }}</p>
                                            <p><strong>Team:</strong> {{ $participant['team']['name'] }}</p>
                                            <p><strong>Table:</strong> {{ $participant['dinner_table']['nama_table'] }} (No. {{ $participant['dinner_table']['nomor_table'] }})</p>
                                        </div> --}}

                                        <!-- No Team & No Table -->
                                        <div class="mt-8 text-center" style="margin-bottom: 30px">
                                            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-gray-200">
                                                Your table is:
                                            </h1>
                                            <h2 class="font-bold text-red-600 mt-4" style="font-size: 3rem">
                                                TABLE {{ $participant['dinner_table']['nomor_table'] }}
                                            </h2>
                                            <!-- <div class="zone-green">
                                                <h2>
                                                    ZONE {{ $participant['dinner_table']['zona_table'] }}
                                                </h2>
                                            </div> -->
                                        </div>

                                        <!-- Agenda Accordion -->
                                        <div class="mt-10 mb-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm p-6 border-red-600" x-data="{ openDay: 'wed' }">
                                            <h2 class="text-2xl font-bold mb-6 text-center">Schedule Leaders Strategic Meeting <span class="text-red-600">2026</span></h2>
                                            <p class="text-center mb-6 text-sm">Company Tagline 2026: <strong class="text-red-600">EXECUTION</strong></p>

                                            <!-- Wednesday, Jan 7th 2026 -->
                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'wed' ? '' : 'wed'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Wednesday, Jan 7th 2026</span>
                                                    <svg :class="openDay === 'wed' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'wed'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <table class="w-full text-sm">
                                                            <thead>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <th class="text-left py-2 px-2">Time</th>
                                                                    <th class="text-left py-2 px-2">Activity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">08:00 - 10:00</td>
                                                                    <td class="py-2 px-2">Participants Arrival (160 participants include committee)</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">15:00 - 18:30</td>
                                                                    <td class="py-2 px-2">Check In</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">17:00 - 18:00</td>
                                                                    <td class="py-2 px-2">Committee Preparation</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2 px-2">19:00 - 21:00</td>
                                                                    <td class="py-2 px-2">Welcome Dinner - pool side | (19.00-21.00 Welcome Dinner - Pool Side (Dress Code : kemeja formal - Blue Jeans))</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Thursday, Jan 8th 2026 -->
                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'thu' ? '' : 'thu'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Thursday, Jan 8th 2026</span>
                                                    <svg :class="openDay === 'thu' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'thu'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <table class="w-full text-sm">
                                                            <thead>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <th class="text-left py-2 px-2">Time</th>
                                                                    <th class="text-left py-2 px-2">Activity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">06:00 - 06:15</td>
                                                                    <td class="py-2 px-2">Photo Session Preparation</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">06:30 - 07:30</td>
                                                                    <td class="py-2 px-2">Photo Session: All, Per Business Unit, Committee</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2" colspan="2"><strong>Dept. Head Presentation</strong></td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">08:15 - 08:45</td>
                                                                    <td class="py-2 px-2">Mr Tetsuya Yamamoto – President Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">08:45 - 09:00</td>
                                                                    <td class="py-2 px-2">Mr Suhari Mukti – Vice President Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">09:00 - 09:15</td>
                                                                    <td class="py-2 px-2">Mrs. Tatik Istiqamah - Factory Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">09:15 - 09:25</td>
                                                                    <td class="py-2 px-2">Mr Endra Wijaya – FA Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">09:25 - 09:35</td>
                                                                    <td class="py-2 px-2">Mr Kwarta- Finance Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">09:35 - 09:45</td>
                                                                    <td class="py-2 px-2">Mr Setiadji - IT Sr. Manager</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">09:45 - 10:05</td>
                                                                    <td class="py-2 px-2">Mr Hiroshi Tanaka - CIBG BUD</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">10:05 - 10:25</td>
                                                                    <td class="py-2 px-2">Mrs Evi Armilasari - TMBG BUD</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">10:25 - 10:40</td>
                                                                    <td class="py-2 px-2">Mrs Dini Arini - Medical Affairs Asst.Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">10:40 - 10:45</td>
                                                                    <td class="py-2 px-2">Mr Sudarmadi Widodo - HCCA Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">10:45 - 11:00</td>
                                                                    <td class="py-2 px-2">Mr Denanda Dewanto - HCD Deputy Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">11:00 - 11:15</td>
                                                                    <td class="py-2 px-2">Mrs Putry Januanty – Corp.Affairs GM</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">11:15 - 11:30</td>
                                                                    <td class="py-2 px-2">Mr Zuldekra – Buz.Strategy & Innovation Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">11:30 - 11:45</td>
                                                                    <td class="py-2 px-2">Mr Ferro Pitrajaya – BOM GM</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">11:45 - 12:00</td>
                                                                    <td class="py-2 px-2">Mrs Desti W. – Regulatory Affair Asst.Director</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">12:00 - 12:15</td>
                                                                    <td class="py-2 px-2">Mr Aropah Heri – Internal Audit GM</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">12:15 - 12:25</td>
                                                                    <td class="py-2 px-2">Mr Roy A. Sparringa – President Commissioner</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">12:25 - 13:05</td>
                                                                    <td class="py-2 px-2">Lunch</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">13:05 - 16:00</td>
                                                                    <td class="py-2 px-2">Separate meetings between CIBG and TMBG</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">17:00 - 18:00</td>
                                                                    <td class="py-2 px-2">ISHOMA</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">18:30 - 21:50</td>
                                                                    <td class="py-2 px-2">Gathering Dinner - Round Table<br>Theme: EXECUTION</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Friday, Jan 9th 2026 -->
                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'fri' ? '' : 'fri'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Friday, Jan 9th 2026</span>
                                                    <svg :class="openDay === 'fri' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'fri'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <table class="w-full text-sm">
                                                            <thead>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <th class="text-left py-2 px-2">Time</th>
                                                                    <th class="text-left py-2 px-2">Activity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">06:00 - 06:30</td>
                                                                    <td class="py-2 px-2">Sport Activity</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">06:30 - 07:30</td>
                                                                    <td class="py-2 px-2">Breakfast</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">07:30 - 07:40</td>
                                                                    <td class="py-2 px-2">Preparation for Meeting</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">08:00 - 21:00</td>
                                                                    <td class="py-2 px-2">CIBG Meeting</td>
                                                                </tr>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">08:00 - 21:00</td>
                                                                    <td class="py-2 px-2">TMBG Meeting</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2 px-2">08:00 - 12:00</td>
                                                                    <td class="py-2 px-2">Check Out for Invited Guest & Non Sales Marketing Participants</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Saturday, Jan 10th 2026 -->
                                            <div>
                                                <button @click="openDay = openDay === 'sat' ? '' : 'sat'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Saturday, Jan 10th 2026</span>
                                                    <svg :class="openDay === 'sat' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'sat'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <table class="w-full text-sm">
                                                            <thead>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <th class="text-left py-2 px-2">Time</th>
                                                                    <th class="text-left py-2 px-2">Activity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="border-b dark:border-gray-600">
                                                                    <td class="py-2 px-2">06:00 - 07:00</td>
                                                                    <td class="py-2 px-2">Breakfast</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="py-2 px-2">06:00 - 12:00</td>
                                                                    <td class="py-2 px-2">Check Out for All Participants</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-10 mb-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm p-6 border-red-600" x-data="{ openDay: 'wed' }">
                                            <h2 class="text-2xl font-bold mb-6 text-center">Here is the <span class="text-red-600">song lyric lineup</span> for the event</h2>

                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'wed' ? '' : 'wed'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Laskar Pelangi - Nidji</span>
                                                    
                                                    <svg :class="openDay === 'wed' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'wed'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <a href="https://www.youtube.com/watch?v=QAOMYGG7QC0&list=RDQAOMYGG7QC0"
                                                       target="_blank"
                                                       class="inline-flex items-center gap-2 px-4 py-2 mb-4 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                        </svg>
                                                        YouTube
                                                    </a>

                                                    <div class="text-sm  mb-4 leading-relaxed">
                                                        Mimpi adalah kunci<br>
                                                        Untuk kita menaklukkan dunia<br>
                                                        Berlarilah tanpa lelah<br>
                                                        Sampai engkau meraihnya<br>
                                                        <br>
                                                        Laskar pelangi<br>
                                                        Takkan terikat waktu<br>
                                                        Bebaskan mimpimu di angkasa<br>
                                                        Warnai bintang di jiwa<br>
                                                        <br>
                                                        Menarilah dan terus tertawa<br>
                                                        Walau dunia tak seindah surga<br>
                                                        Bersyukurlah pada Yang Kuasa<br>
                                                        Cinta kita di dunia<br>
                                                        Selamanya<br>
                                                        <br>
                                                        Cinta kepada hidup<br>
                                                        Memberikan senyuman abadi<br>
                                                        Walau hidup kadang tak adil<br>
                                                        Tapi cinta lengkapi kita<br>
                                                        <br>
                                                        Ho-oh<br>
                                                        Oh-oh-oh, oh-oh, ho-oh<br>
                                                        <br>
                                                        Laskar pelangi<br>
                                                        Takkan terikat waktu<br>
                                                        Jangan berhenti mewarnai<br>
                                                        Jutaan mimpi di bumi, oh<br>
                                                        <br>
                                                        Menarilah dan terus tertawa<br>
                                                        Walau dunia tak seindah surga<br>
                                                        Bersyukurlah pada Yang Kuasa<br>
                                                        Cinta kita di dunia, oh-oh<br>
                                                        <br>
                                                        Menarilah dan terus tertawa<br>
                                                        Walau dunia tak seindah surga<br>
                                                        Bersyukurlah pada Yang Kuasa<br>
                                                        Cinta kita di dunia<br>
                                                        Selamanya<br>
                                                        Selamanya<br>
                                                        <br>
                                                        Laskar pelangi<br>
                                                        Takkan terikat waktu, oh
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Thursday, Jan 8th 2026 -->
                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'thu' ? '' : 'thu'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Cintaku - Chrisye</span>
                                                    <svg :class="openDay === 'thu' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="openDay === 'thu'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <a href="https://www.youtube.com/watch?v=yVyVPszJxGE&list=RDyVyVPszJxGE"
                                                       target="_blank"
                                                       class="inline-flex items-center gap-2 px-4 py-2 mb-4 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                        </svg>
                                                        YouTube
                                                    </a>

                                                    <div class="text-sm mb-4 leading-relaxed">
                                                        Kan ku jalin lagu<br>
                                                        Bingkisan kalbuku<br>
                                                        Bagi insan dunia<br>
                                                        Yang mengagungkan cinta<br>
                                                        <br>
                                                        Betapa nikmatnya<br>
                                                        Di cumbu asmara<br>
                                                        Bagai embun pagi<br>
                                                        Yang menyentuh rerumputan<br>
                                                        <br>
                                                        Cinta, akan ku berikan<br>
                                                        Bagi hatimu yang damai<br>
                                                        Cintaku, gelora asamara<br>
                                                        Seindah lembayung senja<br>
                                                        <br>
                                                        Tiada ada yang kuasa<br>
                                                        Melebihi indahnya<br>
                                                        Nikmat bercinta
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Friday, Jan 9th 2026 -->
                                            <div class="border-b border-gray-300 dark:border-gray-600">
                                                <button @click="openDay = openDay === 'fri' ? '' : 'fri'"
                                                        class="w-full text-left py-4 px-2 font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex justify-between items-center">
                                                    <span>Tabola Bale - Silet Open Up</span>
                                                    <svg :class="openDay === 'fri' ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                
                                                <div x-show="openDay === 'fri'" x-collapse class="pb-4 px-2">
                                                    <div class="overflow-x-auto">
                                                        <a href="https://www.youtube.com/watch?v=BQYhqSffHSA&list=RDBQYhqSffHSA"
                                                       target="_blank"
                                                       class="inline-flex items-center gap-2 px-4 py-2 mb-4 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                        </svg>
                                                        YouTube
                                                    </a>

                                                    <div class="text-sm  mb-4  leading-relaxed">
                                                        Lia ade nona makin gaga, bikin kaka jadi suka<br>
                                                        Dulu ade rambu kepang dua, skarang rambut merah-merah<br>
                                                        Kaka lia ade tambah manis, pulang rantau dari mana?<br>
                                                        Aduh ade nona, jang talalu pasang gaya depan kaka<br>
                                                        Kaka jadi jatoh e<br>
                                                        <br>
                                                        Kaka tabola-bale lia ade nona e<br>
                                                        Su makin menyala e, kaka hati susah e<br>
                                                        Ade bikin kaka mete, tidur malam bola-bale<br>
                                                        Sejak kaka lia ade, aduh Tuhan ampun e<br>
                                                        <br>
                                                        Ade lewat lorong depan rumah<br>
                                                        Kaka jadi salting, sampe mood berubah<br>
                                                        Semangat tiba-tiba gara-gara ade nona<br>
                                                        Ini bidadari timur siapa yang punya?<br>
                                                        <br>
                                                        Kaka lacak ko pu nama<br>
                                                        Barang itu tra pake lama<br>
                                                        Langsung tanya di ko pu mama<br>
                                                        Ternyata ade nona, ko pu nama Maimuna<br>
                                                        <br>
                                                        Eh Maimuna, ehh lucunya<br>
                                                        Kaka harap bisa satu rumah<br>
                                                        Kalau terima sa pu cinta<br>
                                                        Kaka janji kita langsung nikah<br>
                                                        <br>
                                                        Ondeh uda, jan baitu bana<br>
                                                        Denai ko indaklah nan sarupo itu<br>
                                                        Dek hanyo takuik mancaliak uda<br>
                                                        Acok mabuak-mabuakan<br>
                                                        <br>
                                                        Dulu denai lah suko mancaliak uda bakawan<br>
                                                        Raso-raso ko ado, tapi denai diamkan<br>
                                                        <br>
                                                        A wadaw wadaw, ini anak gagah law<br>
                                                        Su bale Jawa, tambah bening aja la<br>
                                                        Gaya semakin beda, bibir merah-merah<br>
                                                        Aduh mama-mama, ini siapa punya anak?<br>
                                                        <br>
                                                        Dulu masih kici-kici-kici, "nona"<br>
                                                        Sekarang bale Jawa makin cantik nona<br>
                                                        Ko perfect sekali, asli bidadari<br>
                                                        Jatuh dari langit<br>
                                                        <br>
                                                        Kalau jadi dengan ade kaka stop bamabo<br>
                                                        To, su pasti kaka ni ade pu jodoh<br>
                                                        Sumpah ni jauh sudah, iwa mbodho
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Closing Sentence -->
                                        <div class="">
                                            <p class="text-lg font-medium">
                                                We look forward to your participation in ensuring that the strategies we set can be <span class="text-red-600 font-semibold">flawlessly executed</span>, guiding the organization toward greater success.
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
            margin-bottom: 3em;
        }
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

        .audio-container {
            position: relative;
            width: 100%;
            height: 80px;
            overflow: hidden;
        }

        .audio-container iframe {
            position: absolute;
            top: -270px;
            left: 0;
            width: 100%;
            height: 360px;
        }
    </style>
</body>

</html>
