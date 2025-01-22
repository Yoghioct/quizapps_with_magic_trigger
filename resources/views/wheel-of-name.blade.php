<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wheel of Name</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.aio.co.id/assets/favicon/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .zone-green {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #047857 !important;
            /* Green text */
            background-color: #d1fae5;
            /* Light green background */
            border-radius: 5px;
            /* Rounded badge */
            margin-top: 10px;
            /* margin-bottom: 3em; */
        }

        /* .container { max-width: 600px; margin: 20px auto; padding: 20px; } */
        /* table { width: 100%; border-collapse: collapse; } */
        button { cursor: pointer; }
        /* .modal { display: none; position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
        .modal-content { background: white; padding: 20px; border-radius: 5px; }
        .hidden { display: none; } */

        /* Modal overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Dark transparent background */
            justify-content: center;
            align-items: center;
        }

        .background-modal {
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999;
        }

        /* Modal Content */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            max-width: 620px;
            width: 400px;
            height: auto;
            z-index: 1000;
        }

        .winner-image{
            width: 100%;
            height: 300px;
            border-radius: 10px;
        }

        .hidden {
            display: none !important;
        }

        #addParticipantForm {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        #addParticipantForm input,
        #addParticipantForm button {
            flex-grow: 1;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

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

                                        <div class="mb-6 zone-green">
                                            <h1 class="text-2xl font-bold">UNDIAN DOORPRIZE</h1>
                                            {{-- <p class="text-sm text-gray-600 dark:text-gray-200">Silahkan isi data diri Anda untuk melihat table Gala Dinner Anda</p> --}}
                                        </div>

                                        <div class="mt-8 text-center">
                                            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-gray-200">
                                                Pemenang:
                                            </h1>
                                            <h2 class="font-bold text-blue-600 mt-4 mb-4" style="font-size: 3rem">
                                                <div id="winner">.....</div>
                                            </h2>
                                            {{-- <div class="zone-green">
                                                <h2>
                                                    ZONE
                                                </h2>
                                            </div> --}}
                                            <button id="acakButton" class="px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Acak Sekarang</button>
                                            <button id="stopButton" class="px-5 py-2 bg-red-500 text-white rounded hover:bg-red-700 hidden">Stop</button>
                                        </div>

                                        {{-- <form id="addParticipantForm" class="mb-4">
                                            <input type="text" name="participantName" placeholder="Masukkan nama baru" class='border border-gray-400 px-2 py-1 rounded'>
                                            <button type="submit" class="ml-2 px-3 py-1 bg-teal-600 text-white rounded hover:bg-teal-700">Tambah Peserta</button>
                                        </form> --}}
                                        <div class="overflow-x-auto" style="margin-top: 80px">
                                            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                                                <thead>
                                                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                                                        <th class="py-3 px-6 text-center">#</th>
                                                        <th class="py-3 px-6 text-center">NIP</th>
                                                        <th class="py-3 px-6 text-center">Nama</th>
                                                        <th class="py-3 px-6 text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                                                    @php
                                                        $participants = $data;
                                                    @endphp
                                                   @foreach ($data as $index => $participant)
                                                   <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                       <td class="py-3 px-6">{{ $index + 1 }}</td>
                                                       <td class="py-3 px-6">{{ $participant['code'] }}</td> <!-- Displaying full_name -->
                                                       <td class="py-3 px-6">{{ $participant['full_name'] }}</td> <!-- Displaying full_name -->
                                                       <td class="py-3 px-6 text-center">
                                                           <button onclick="deleteParticipant('{{ $participant['full_name'] }}', this)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700">Delete</button>
                                                       </td>
                                                   </tr>
                                               @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Modal -->
                                        <div id="winnerModal" class="modal-overlay">
                                            <!-- Modal Content -->
                                            <div class="modal-content">
                                                <h2 class="text-xl font-semibold text-black dark:text-white" id="modalWinnerName" style="display: none"></h2>

                                                <!-- Modal Body (Winner Info) -->
                                                <div class="space-y-4 mt-4">
                                                    <div class="text-center p-4">
                                                        <span class="text-gray-600 dark:text-gray-300">The winner is:</span>
                                                    </div>

                                                    <div class="flex justify-center items-center mb-4">
                                                        <img id="winnerImage" alt="Winner Image" class="object-cover winner-image">
                                                    </div>


                                                    <div class="flex justify-between items-center mb-4">
                                                        <span class="font-bold">Full Name</span>
                                                        <span id="winnerFullName" class="text-lg text-blue-600 dark:text-blue-400">-</span>
                                                    </div>

                                                    <div class="flex justify-between items-center mb-4">
                                                        <span class="font-bold">Code</span>
                                                        <span id="winnerCode" class="text-lg text-blue-600 dark:text-blue-400">-</span>
                                                    </div>

                                                    <!-- Close Button -->
                                                    <div class="mt-6 text-center">
                                                        <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 w-full">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                {{-- <footer class="py-4 text-blue-500 text-center text-sm text-black dark:text-white/70 shadow-md fixed bottom-0 w-full bg-white dark:bg-gray-900">
                    <a href="https://instagram.com/yoghioctopus" target="_blank">by @yoghioctopus</a>
                </footer> --}}
            </div>
        </div>
    </div>

    <script>
        var participants = @json($data);
        console.log(participants);

        // Render participants in table
        function renderParticipants() {
            // console.log('aa');
            // var tbody = document.querySelector('#participantsTable');
            // tbody.innerHTML = ''; // Clear existing rows
            // participants.forEach((participant, index) => {
            //     var row = `
            //         <tr>
            //             <td>${index + 1}</td>
            //             <td>${participant.full_name}</td>
            //             <td>
            //                 <button onclick="deleteParticipant(${index})" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700">Delete</button>
            //             </td>
            //         </tr>
            //     `;
            //     tbody.innerHTML += row;
            // });
        }

        // Call renderParticipants function to populate the table initially
        renderParticipants();

        // document.getElementById('addParticipantForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     var participantName = this.elements['participantName'].value;
        //     var tbody = document.querySelector('table tbody');
        //     var newIndex = tbody.querySelectorAll('tr').length + 1;
        //     var row = `<tr><td>${newIndex}</td><td>${participantName}</td><td><button onclick="deleteParticipant('${participantName}', this)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700">Delete</button></td></tr>`;
        //     tbody.innerHTML += row;
        //     this.reset();
        // });

        let interval;
        document.getElementById('acakButton').addEventListener('click', function() {
            var participants = document.querySelectorAll('table tbody tr td:nth-child(3)'); // Get all participant names
            var codes = document.querySelectorAll('table tbody tr td:nth-child(2)'); // Get all participant codes
            var participantsArray = Array.from(participants);
            var codesArray = Array.from(codes);

            let i = 0;
            interval = setInterval(() => {
                let randomIndex = Math.floor(Math.random() * participantsArray.length);

                // Get name and code
                let name = participantsArray[randomIndex].textContent;
                let code = codesArray[randomIndex].textContent;

                // Combine name and code in "name (code)" format
                let winner = `${name} (${code})`;

                // Display the winner with the name and code
                document.getElementById('winner').textContent = winner; // Truncate to 25 characters if necessary
                i++;
            }, 50);

            this.classList.add('hidden');
            document.getElementById('stopButton').classList.remove('hidden');
        });

        document.getElementById('stopButton').addEventListener('click', function() {
            clearInterval(interval);

            let modal = document.getElementById('winnerModal');
            let winnerName = document.getElementById('winner').textContent;

            let name = winnerName.split('(')[0].trim(); // Extract the name (everything before the parentheses)
            let code = winnerName.split('(')[1].replace(')', '').trim(); // Extract the code (everything inside the parentheses)

            // Set the modal content with winner info
            document.getElementById('modalWinnerName').textContent = winnerName;
            document.getElementById('winnerFullName').textContent = name;
            document.getElementById('winnerCode').textContent = code;
            document.getElementById('winnerImage').src = `https://sfe.otsuka.co.id/assets/images/karyawan/${code}.jpg`;

            // Show the modal
            modal.style.display = 'flex'; // Ensure modal is displayed correctly
            modal.classList.remove('hidden'); // Ensure 'hidden' class is removed

            // Hide buttons accordingly
            document.getElementById('acakButton').classList.remove('hidden');
            this.classList.add('hidden');
        });


        function deleteParticipant(name, button) {
            var row = button.closest('tr');
            row.remove();
            // Update the session data via an AJAX request or form submission
            // Example using fetch API (assuming a route exists to handle this):
            fetch('/delete-participant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: name })
            });
        }

        function showWinnerModal(name, code) {
            // Set the winner's name and code
            document.getElementById('winnerFullName').textContent = name;
            document.getElementById('winnerCode').textContent = code;

            // Show the modal
            document.getElementById('winnerModal').classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            console.log('Closing modal...');
            let modal = document.getElementById('winnerModal');

            // Remove the 'hidden' class to hide the modal (making it invisible)
            modal.classList.add('hidden');

            // Optionally reset the modal content if needed
            document.getElementById('modalWinnerName').textContent = ''; // Clear the name
            document.getElementById('winnerFullName').textContent = '-'; // Clear the full name
            document.getElementById('winnerCode').textContent = '-'; // Clear the code
            document.getElementById('winnerImage').src = ''; // Clear the image

            // Reset the button visibility (optional)
            document.getElementById('acakButton').classList.remove('hidden');
            document.getElementById('stopButton').classList.add('hidden');
        }

    </script>
</body>

</html>
