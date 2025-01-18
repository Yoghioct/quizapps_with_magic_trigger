@section('title', 'Data Score - 50th Anniversary PT Otsuka Indonesia')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Score') }}
        </h2>
    </x-slot>

    <div class="py-12" style="margin: 15px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="sortableTable()">
                    <div class="overflow-x-auto"> <!-- Make table scrollable on small screens -->
                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                            <thead>
                                <tr
                                    class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                                    {{-- <th class="py-3 px-6 text-left cursor-pointer" @click="sort('id')">
                                        # <span x-show="sortColumn === 'id' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'id' && sortDirection === 'desc'">↓</span>
                                    </th>
--}}                                <th class="py-3 px-6 text-center">No</th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('team')">
                                        Team <span x-show="sortColumn === 'team' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'team' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('game')">
                                        Game <span x-show="sortColumn === 'game' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'game' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('score')">
                                        Score <span x-show="sortColumn === 'score' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'score' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left">Admin</th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('updated_at')">
                                        Last Update <span
                                            x-show="sortColumn === 'updated_at' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'updated_at' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-left cursor-pointer" @click="sort('created_at')">
                                        Timestamp <span
                                            x-show="sortColumn === 'updated_at' && sortDirection === 'asc'">↑</span>
                                        <span x-show="sortColumn === 'updated_at' && sortDirection === 'desc'">↓</span>
                                    </th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                                <template x-for="(score, index) in sortedScores" :key="score.id">
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="py-3 px-6" x-text="(currentPage - 1) * pageSize + index + 1"></td>
                                        <td class="py-3 px-6" x-text="score.team.name"></td>
                                        <td class="py-3 px-6" x-text="score.game.name"></td>
                                        <td class="py-3 px-6" x-text="score.score"></td>
                                        <td class="py-3 px-6" x-text="score.user.name ?? 'Unknown'"></td>
                                        <td class="py-3 px-6"
                                            x-text="formatDate(score.updated_at ? score.updated_at : score.created_at)">
                                        </td>
                                        <td class="py-3 px-6"
                                            x-text="formatDate(score.created_at)">
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex flex-col gap-2 sm:flex-row sm:justify-center">
                                                <!-- Edit Button -->
                                                <a :href="`/data-score/edit/${score.id}`" class="w-full sm:w-auto">
                                                    <button
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                                        Edit
                                                    </button>
                                                </a>

                                                <!-- Delete Button -->
                                                <form :action="`/data-score/${score.id}`" method="POST"
                                                    class="w-full sm:w-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
                                                        onclick="return confirm('Are you sure you want to delete this score?')">
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
                scores: @json($scores), // Inject scores from Laravel
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
                get sortedScores() {
                    if (!this.sortColumn) {
                        return this.paginatedScores;
                    }
                    return [...this.scores].sort((a, b) => {
                        let valueA = a[this.sortColumn];
                        let valueB = b[this.sortColumn];

                        if (this.sortColumn === 'team') {
                            valueA = a.team?.name ?? '';
                            valueB = b.team?.name ?? '';
                        } else if (this.sortColumn === 'game') {
                            valueA = a.game?.name ?? '';
                            valueB = b.game?.name ?? '';
                        }

                        if (this.sortDirection === 'asc') {
                            return valueA > valueB ? 1 : -1;
                        } else {
                            return valueA < valueB ? 1 : -1;
                        }
                    }).slice((this.currentPage - 1) * this.pageSize, this.currentPage * this.pageSize);
                },
                get paginatedScores() {
                    return this.scores.slice((this.currentPage - 1) * this.pageSize, this.currentPage * this.pageSize);
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
                    return Math.ceil(this.scores.length / this.pageSize);
                },
                formatDate(date) {
                    if (!date) return ''; // Handle null or undefined dates
                    const options = {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    return new Date(date).toLocaleDateString('en-US', options);
                },
            };
        }
    </script>

</x-app-layout>
