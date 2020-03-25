<div>
    {{-- Filter Search Box --}}
    <div class="my-8">
        <h2 class="mt-8 font-bold text-blue-700 text-2xl">Filter Songs</h2>
        <p class="mb-4">You can search by artist name, album title, pack name etc.</p>
        <input wire:model="query" type="text"
            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-2xl text-gray-700 leading-tight focus:outline-none focus:bg-gray-100 focus:border-blue-600">
    </div>

    {{-- Song Table --}}
    <div class="mb-20">
        <div class="overflow-x-auto shadow-xl">
            <div
                class="align-middle inline-block min-w-full shadow overflow-scroll sm:rounded-lg border border-gray-200">
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

                            <th wire:click="sortBy('pack_name')" class="songsmith-th hover:underline">
                                Pack
                            </th>

                            <th wire:click="sortBy('difficulty')" class="songsmith-th hover:underline">
                                Difficulty
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-gray-100">
                        @foreach ($songs as $song)
                        <tr>
                            <td class="songsmith-td font-bold">
                                {{ $song->title }}
                            </td>

                            <td class="songsmith-td">
                                {{ $song->artist->name }}
                            </td>

                            <td class="songsmith-td">
                                {{ $song->album->name }}
                            </td>

                            <td class="songsmith-td">
                                {{ $song->pack->name }}
                            </td>

                            <td class="songsmith-td">-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
