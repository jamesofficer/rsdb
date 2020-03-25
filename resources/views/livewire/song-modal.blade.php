<div>
    @if ($visible)
    <button class="modal-close-btn text-white hover:text-blue-300" wire:click="closeModal">
        &times;
    </button>

    <div class="song-modal">
        <div class="modal-content bg-gray-100 rounded-lg p-8">
            <p class="text-gray-600 text-xs uppercase">Song</p>
            <h1 class="text-3xl font-bold text-blue-700">{{ $song->title }}</h1>
            <h2 class="mb-2 text-xl text-gray-700">{{ $song->artist->name }}</h2>
            <h2 class="mb-4 pb-4 text-gray-600 border-b-2 border-blue-700">{{ $song->album->name }}</h2>
        </div>
    </div>
    @endif
</div>
