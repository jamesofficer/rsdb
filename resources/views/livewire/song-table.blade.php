<div class="flex flex-col">
    <div class="overflow-x-auto shadow-xl">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border border-gray-200">
            <table class="min-w-full">
                <thead class="bg-gray-200 border-b border-gray-400">
                    <tr>
                        <th
                            class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                            Title</th>
                        <th
                            class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                            Artist</th>
                        <th
                            class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                            Pack</th>
                        <th
                            class="px-4 py-3 border-b border-gray-200 bg-gray-50 text-left text-sm leading-4 font-bold text-gray-500 uppercase tracking-wider">
                            Added</th>
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
                            {{ $song->pack->name }}</td>
                        <td class="px-4 py-2 text-gray-800 text-sm whitespace-no-wrap border-b border-gray-200">
                            {{ $song->pack->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
