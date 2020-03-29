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
        $csvFile = file(public_path('csv/rs-song-list.csv'));

        $max = 10000;
        $curr = 0;

        DB::transaction(function () use ($csvFile, $max, $curr) {
            foreach ($csvFile as $line) {
                if ($curr > $max) {
                    break;
                } else {
                    $curr++;
                }

                $parsedLine = str_getcsv($line);

                // REFERENCE:
                $parsed = [
                    'artist' => ucwords(str_replace(' and ', ' & ', $parsedLine[0])),
                    'song' => $parsedLine[1],
                    'album' => $parsedLine[2],
                    'arrangement' => $parsedLine[3],
                    'year' => $parsedLine[4],
                    'tuning' => $parsedLine[5],
                    'difficulty' => $parsedLine[6],
                    'length' => $parsedLine[7],
                    'capo' => $parsedLine[8] ?? 0,
                ];

                $artist = Artist::firstOrCreate([
                    'slug' => Str::slug($parsed['artist']),
                    'name' => $parsed['artist'],
                ]);

                $album = Album::firstOrCreate([
                    'slug' => $this->getAlbumSlug($parsed),
                    'name' => $parsed['album'],
                    'year' => $parsed['year'],
                ]);

                DB::table('album_artist')->insertOrIgnore([
                    'album_id' => $album->id,
                    'artist_id' => $artist->id,
                ]);

                $song = Song::firstOrCreate([
                    'slug' => $this->getSongSlug($parsed),
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

    private function getSongSlug(array $parsed): string
    {
        $songSlug = Str::slug($parsed['song']);
        $song = Song::where('slug', $songSlug)->first();

        if ($song && $song->artist->name !== $parsed['artist']) {
            $songSlug = Str::slug($parsed['artist'] . ' ' . $parsed['song']);
            dump('SONG: ' . $song->title . ' slug is now ' . $songSlug);
        }

        return $songSlug;
    }

    private function getAlbumSlug(array $parsed): string
    {
        $albumSlug = Str::slug($parsed['album']);
        $albumTitle = strtolower($parsed['album']);

        if (
            strstr($albumTitle, 'hits') ||
            strstr($albumTitle, 'indestructible') ||
            strstr($albumTitle, 'awake') ||
            strstr($albumTitle, 'bad reputation') ||
            strstr($albumTitle, 'blue')
        ) {
            $albumSlug = Str::slug($parsed['artist'] . ' ' . $parsed['album']);
            dump('ALBUM SLUG IS NOW ' . $albumSlug);
        }

        return $albumSlug;
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
