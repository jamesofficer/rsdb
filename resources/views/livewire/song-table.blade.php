<div>
    {{-- Filter Search Box --}}
    <div class="my-8">
        <h2 class="mt-8 font-bold text-blue-700 text-2xl">Filter Songs</h2>
        <p class="mb-4">You can search by artist name, album title, pack name etc.</p>
        <input wire:model="query" type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-2xl text-gray-700 leading-tight focus:outline-none focus:bg-gray-100 focus:border-blue-600">
    </div>

    {{-- Song Table --}}
    <div class="mb-20">
        <div class="overflow-hidden shadow-xl">
            <div class="align-middle inline-block min-w-full shadow overflow-x-scroll sm:rounded-lg border border-gray-200">
                <table class="min-w-full song-table">
                    <thead class="bg-blue-700 border-b-2 border-gray-300">
                        <tr>
                            <th wire:click="sortBy('title')" class="songsmith-th hover:underline">
                                Title
                            </th>

                            <th wire:click="sortBy('artist_name')" class="songsmith-th hover:underline">
                                Artist
                            </th>

                            <th wire:click="sortBy('album_name')" class="songsmith-th hover:underline">
                                Album
                            </th>

                            <th wire:click="sortBy('average_difficulty')" class="songsmith-th hover:underline">
                                Avg. Difficulty
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-gray-100">
                        @foreach ($songs as $song)
                        <tr>
                            <td class="songsmith-td font-bold">
                                <span wire:click="selectSong('{{ $song->id }}')" class="cursor-pointer hover:underline">
                                    {{ $song->title }}
                                </span>
                            </td>

                            <td class="songsmith-td">
                                {{ $song->artist->name }}
                            </td>

                            <td class="songsmith-td">
                                {{ $song->album->name }}
                            </td>

                            <td class="songsmith-td">
                                {{ $song->average_difficulty }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (count($songs) === 0)
                <p>No songs found.</p>
                @endif
            </div>
        </div>
    </div>
</div>