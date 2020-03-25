<div>
    <div class="my-8">
        <h2 class="mt-8 font-bold text-gray-800 text-2xl">Filter Songs</h2>
        <p class="mb-4">You can search by artist name, album title, pack name etc.</p>
        <input wire:model="query" type="text"
            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-2xl text-gray-700 leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-600">
    </div>

    <div class="mb-20">
        <div class="overflow-x-auto shadow-xl">
            <div
                class="align-middle inline-block min-w-full shadow overflow-scroll sm:rounded-lg border border-gray-200">
                <table class="min-w-full song-table">
                    <thead class="bg-gray-200 border-b-2 border-gray-300">
                        <tr>
                            <th
                                class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                                Title</th>
                            <th
                                class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                                Artist</th>
                            <th width="200"
                                class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                                Album</th>
                            <th
                                class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                                Pack</th>
                        </tr>
                    </thead>

                    <tbody class="bg-gray-100">
                        @foreach ($songs as $song)
                        <tr>
                            <td class="px-4 py-2 text-gray-800 text-sm whitespace-no-wrap border-b border-gray-200">
                                {{ $song->title }}</td>
                            <td class="px-4 py-2 text-gray-800 text-sm whitespace-no-wrap border-b border-gray-200">
                                {{ $song->artist->name }}</td>
                            <td class="px-4 py-2 text-gray-800 text-sm whitespace-no-wrap border-b border-gray-200">
                                {{ $song->album->name }}</td>
                            <td class="px-4 py-2 text-gray-800 text-sm whitespace-no-wrap border-b border-gray-200">
                                {{ $song->pack->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
