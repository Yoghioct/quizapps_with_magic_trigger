@section('title', 'Data Participant - 50th Anniversary PT Otsuka Indonesia')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Participant') }}
        </h2>
    </x-slot>

    <div class="py-12" style="margin: 15px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="sortableTable()">
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

                    <a href="{{ route('participant.store_participant') }}">
                        <div class="mb-4" style="float: right">
                            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">
                                Add Data
                        </div>
                    </a>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input type="text" x-model="searchQuery" placeholder="Search participants..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                            <thead>
                                <tr
                                    class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">No</th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('code')">
                                        Code <span x-show="sortColumn === 'code' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'code' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('full_name')">
                                        Name <span x-show="sortColumn === 'full_name' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'full_name' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('team')">
                                        Team <span x-show="sortColumn === 'team' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'team' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-center">Zone Team</th>
                                    <th class="py-3 px-6 text-center">Gel. Museum</th>
                                    <th class="py-3 px-6 text-center">Schedule</th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('nomor_table')">
                                        Table <span x-show="sortColumn === 'nomor_table' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'nomor_table' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('zona_table')">
                                        Zone Table <span x-show="sortColumn === 'zona_table' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'zona_table' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                                <template x-for="(participant, index) in filteredParticipants" :key="participant.id">
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="py-3 px-6 text-center" x-text="(currentPage - 1) * pageSize + index + 1"></td>
                                        <td class="py-3 px-6" x-text="participant.code"></td>
                                        <td class="py-3 px-6" x-text="participant.full_name"></td>
                                        <td class="py-3 px-6" x-text="participant.team?.name ?? 'Unknown'"></td>
                                        <td class="py-3 px-6" x-text="participant.team?.zona_team ?? 'Unknown'"></td>
                                        <td class="py-3 px-6" x-text="participant.open_museum?.name ?? 'Unknown'"></td>
                                        <td class="py-3 px-6" x-text="participant.open_museum?.schedule ?? 'Unknown'"></td>
                                        <td class="py-3 px-6" x-text="participant.dinner_table?.nomor_table ?? 'Unknown'"></td>
                                        <td class="py-3 px-6" x-text="participant.dinner_table?.zona_table ?? 'Unknown'"></td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex flex-col gap-2 sm:flex-row sm:justify-center">
                                                <!-- Edit Button -->
                                                <a :href="`/participant/edit/${participant.id}`" class="w-full sm:w-auto">
                                                    <button
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                                        Edit
                                                    </button>
                                                </a>

                                                <!-- Delete Button -->
                                                <form :action="`/participant/${participant.id}`" method="POST"
                                                    class="w-full sm:w-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
                                                        onclick="return confirm('Are you sure you want to delete this participant?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls -->
                    <div class="mt-4 flex justify-between items-center">
                        <button class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded"
                            @click="prevPage" :disabled="currentPage === 1">Previous</button>
                        <span x-text="`Page ${currentPage} of ${totalPages}`"
                            class="text-gray-500 dark:text-gray-400"></span>
                        <button class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded"
                            @click="nextPage" :disabled="currentPage === totalPages">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function sortableTable() {
            return {
                participants: @json($data['participants']),
                searchQuery: '',
                sortColumn: null,
                sortDirection: 'asc',
                currentPage: 1,
                pageSize: 10, // Number of rows per page
                sort(column) {
                    if (this.sortColumn === column) {
                        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortColumn = column;
                        this.sortDirection = 'asc';
                    }
                },
                get filteredParticipants() {
                    let filtered = this.participants.filter(p => {
                        return (
                            p.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            p.code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            (p.team?.name || '').toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            (p.dinner_table?.zona_table || '').toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    });

                    if (this.sortColumn) {
                        filtered.sort((a, b) => {
                            let valueA = a[this.sortColumn];
                            let valueB = b[this.sortColumn];

                            if (this.sortColumn === 'team') {
                                valueA = a.team?.name ?? '';
                                valueB = b.team?.name ?? '';
                            } else if (this.sortColumn === 'zona_table') {
                                valueA = a.dinner_table?.zona_table ?? '';
                                valueB = b.dinner_table?.zona_table ?? '';
                            } else if (this.sortColumn === 'nomor_table') {
                                valueA = a.dinner_table?.nomor_table ?? '';
                                valueB = b.dinner_table?.nomor_table ?? '';
                            }

                            if (this.sortDirection === 'asc') {
                                return valueA > valueB ? 1 : -1;
                            } else {
                                return valueA < valueB ? 1 : -1;
                            }
                        });
                    }

                    return filtered.slice((this.currentPage - 1) * this.pageSize, this.currentPage * this.pageSize);
                },
                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },
                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },
                get totalPages() {
                    return Math.ceil(this.participants.filter(p => {
                        return (
                            p.full_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            p.code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            (p.team?.name || '').toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            (p.dinner_table?.table_name || '').toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }).length / this.pageSize);
                },
            };
        }
    </script>

</x-app-layout>
