<?php

use App\Pack;
use App\Song;
use App\Artist;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealPackSeeder extends Seeder
{
    public function run()
    {
        $csvFile = file(public_path('csv/packs-seed-data.csv'));

        DB::transaction(function () use ($csvFile) {
            foreach ($csvFile as $line) {
                $parsedLine = str_getcsv($line);
                $parsed = [
                    'title' => str_replace('"', '', str_replace('"', '', $parsedLine[0])),
                    'artist' => ucwords(str_replace(' and ', ' & ', $parsedLine[1])),
                    'year' => $parsedLine[2],
                    'tuning' => $parsedLine[3],
                    'us_pack_name' => $parsedLine[4],
                    'eu_pack_name' => $parsedLine[5],
                    'us_pack_date' => $parsedLine[6],
                    'eu_pack_date' => $parsedLine[7],
                ];

                $artist = Artist::where('name', 'ilike', $parsed['artist'])->first();
                $song = Song::where('title', 'ilike', $parsed['title'])->where('artist_id', $artist->id)->first();

                if ($parsed['us_pack_name'] && $parsed['us_pack_name'] !== 'N/A') {
                    $usPack = Pack::firstOrCreate([
                        'slug' => Str::slug('US' . ' ' . $parsed['us_pack_name']),
                        'name' => ucwords($parsed['us_pack_name']),
                        'steam_url' => null,
                        'region' => 'US',
                    ]);

                    DB::table('pack_song')->insert([
                        'song_id' => $song->id,
                        'pack_id' => $usPack->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                if ($parsed['eu_pack_name'] && $parsed['eu_pack_name'] !== $parsed['us_pack_name'] && $parsed['eu_pack_name'] !== 'N/A') {
                    $euPack = Pack::firstOrCreate([
                        'slug' => Str::slug('EU' . ' ' . $parsed['eu_pack_name']),
                        'name' => ucwords($parsed['eu_pack_name']),
                        'steam_url' => null,
                        'region' => 'EU',
                    ]);

                    DB::table('pack_song')->insert([
                        'song_id' => $song->id,
                        'pack_id' => $euPack->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
        });
    }
}
