<div>
    @if ($song)
    <span class="modal-close-btn text-white hover:text-blue-300 ml-12" wire:click="closeModal">
        &times;
    </span>

    <div class="song-modal">
        <div class="modal-content bg-gray-100 rounded-lg p-8">
            <p class="text-gray-600 text-xs uppercase">Song</p>
            <h1 class="text-3xl font-bold text-blue-700">{{ $song->title }}</h1>
            <h3 class="text-2xl text-gray-700">{{ $song->artist->name }}</h3>
            <h4 class="mb-4 pb-4 text-xl text-gray-600 border-b-2 border-blue-700">{{ $song->album->name }}</h4>

            <p class="mt-6 mb-4 text-gray-600 text-sm uppercase">Arrangements</p>
            <div class="flex flex-col lg:flex-row">
                @foreach ($song->songArrangements->reverse() as $songArrangement)
                <div class="mr-16">
                    <h3 class="font-bold text-xl text-blue-700">{{ $songArrangement->arrangement->name }}</h3>
                    <p class="text-lg">
                        <span class="font-bold text-gray-700">Tuning:</span>
                        {{ $songArrangement->tuning->name }}
                    </p>
                    <p class="mb-4 text-lg">
                        <span class="font-bold text-gray-700">Difficulty:</span>
                        {{ $songArrangement->formatted_difficulty }} / 100
                    </p>
                </div>
                @endforeach
            </div>

            <p class="mt-8 text-xs">Difficulty ratings are provided by Ubisoft and are not an entirely accurate representation of the actual songs difficulty.</p>
        </div>
    </div>
    @endif
</div>