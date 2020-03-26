<?php

use App\Album;
use App\Arrangement;
use App\Artist;
use App\Song;
use App\SongArrangement;
use App\Tuning;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RealSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = file(storage_path('app/rs-song-list.csv'));

        DB::transaction(function () use ($csvFile) {
            foreach ($csvFile as $line) {
                $parsedLine = str_getcsv($line);

                // REFERENCE:
                $parsed = [
                    'artist' => $parsedLine[0],
                    'song' => $parsedLine[1],
                    'album' => $parsedLine[2],
                    'arrangement' => $parsedLine[3],
                    'year' => $parsedLine[4],
                    'tuning' => $parsedLine[5],
                    'difficulty' => $parsedLine[6],
                    'length' => $parsedLine[7],
                    'capo' => $parsedLine[8],
                ];

                $artist = Artist::firstOrCreate([
                    'slug' => Str::slug($parsed['artist']),
                    'name' => $parsed['artist'],
                ]);

                // Albums with 'Greatest' or 'Greatest Hits' will conflict, so make them unique by adding the artist name.
                $albumSlug = strstr(strtolower($parsed['album']), 'greatest') ? Str::slug($parsed['artist'] . ' ' . $parsed['album']) : Str::slug($parsed['album']);

                $album = Album::firstOrCreate([
                    'slug' => $albumSlug,
                    'name' => $parsed['album'],
                    'date' => Carbon::create($parsed['year'], 1, 1, 0, 0, 0),
                    'artist_id' => $artist->id,
                ]);

                // Some songs have the same name, make the slug unique
                $songSlug = Str::slug($parsed['song']);
                $song = Song::where('title', $parsed['song'])->first();

                if ($song && $song->artist->name !== $parsed['artist']) {
                    $songSlug = Str::slug($parsed['artist'] . ' ' . $parsed['song']);
                }

                $song = Song::firstOrCreate([
                    'slug' => $songSlug,
                    'title' => $parsed['song'],
                    'steam_url' => null,
                    'length' => intval($parsed['length']),
                    'artist_id' => $artist->id,
                    'album_id' => $album->id,
                    'pack_id' => null,
                ]);

                $tuning = Tuning::firstOrCreate([
                    'name' => $parsed['tuning']
                ]);

                $arrangement = Arrangement::firstOrCreate([
                    'name' => $parsed['arrangement']
                ]);

                $songArrangement = SongArrangement::firstOrCreate([
                    'song_id' => $song->id,
                    'arrangement_id' => $arrangement->id,
                    'tuning_id' => $tuning->id,
                    'capo_required' => intval($parsed['capo']) > 0,
                    'difficulty' => $parsed['difficulty'],
                ]);
            }
        });
    }
}
