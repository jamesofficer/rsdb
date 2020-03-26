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
        $csvFile = file(public_path('rs-song-list.csv'));

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

                // Some albums have the same name, make the slug unique
                $albumSlug = Str::slug($parsed['album']);
                $album = Album::where('name', $parsed['album'])->first();

                if ($album && $album->artist->name !== $parsed['artist']) {
                    $albumSlug = Str::slug($parsed['artist'] . ' ' . $parsed['album']);
                    dump('ALBUM: ' . $album->name . ' slug is now ' . $albumSlug);
                }

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
                    dump('SONG: ' . $song->title . ' slug is now ' . $songSlug);
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
                    'name' => $this->getArrangementName($parsed['arrangement'])
                ]);

                SongArrangement::firstOrCreate([
                    'song_id' => $song->id,
                    'arrangement_id' => $arrangement->id,
                    'tuning_id' => $tuning->id,
                    'capo_required' => intval($parsed['capo']) > 0,
                    'difficulty' => $parsed['difficulty'],
                ]);
            }
        });
    }

    private function getArrangementName(string $arrangement)
    {
        $convertArrangement = [
            'Lead' => 'Lead',
            'Lead1' => 'Alt. Lead',
            'Lead2' => 'Alt. Lead',
            'Lead3' => 'Alt. Lead',
            'Combo' => 'Combo (Lead & Rhythm)',
            'Combo1' => 'Combo (Lead & Rhythm)',
            'Combo2' => 'Combo (Lead & Rhythm)',
            'Combo3' => 'Combo (Lead & Rhythm)',
            'Combo4' => 'Combo (Lead & Rhythm)',
            'Rhythm' => 'Rhythm',
            'Rhythm1' => 'Alt. Rhythm',
            'Rhythm2' => 'Alt. Rhythm',
            'Rhythm3' => 'Alt. Rhythm',
            'Bass' => 'Bass',
            'Bass2' => 'Alt. Bass',
        ];

        return $convertArrangement[$arrangement];
    }
}
