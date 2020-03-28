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

        $curr = 0;
        $max = 400;

        DB::transaction(function () use ($csvFile, $curr, $max) {
            foreach ($csvFile as $line) {
                if ($curr > $max) {
                    break;
                } else {
                    $curr++;
                }


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

                $usSlug = Str::slug('US' . ' ' . $parsed['us_pack_name']);
                $euSlug = Str::slug('EU' . ' ' . $parsed['eu_pack_name']);
                $usPackExists = Pack::where('slug', $usSlug)->first();
                $euPackExists = Pack::where('slug', $euSlug)->first();

                $artist = Artist::where('name', 'ilike', $parsed['artist'])->first();

                if ($artist) {
                    $song = Song::where('title', 'ilike', $parsed['title'])->where('artist_id', $artist->id)->first();
                } else {
                    dump('NO ARTIST: ' . $parsed['artist'], $parsed);
                }

                if ($song) {
                    // dump('SONG FOUND: ' . $song->title . ' --- ' . $song->artist->name);
                } else {
                    dump('NO SONG! ' . $parsed['title'] . ' --- ' . $parsed['artist'], $parsed);
                }

                if ($usPackExists === null) {
                    // $pack = Pack::create([
                    //     'slug' => $usSlug,
                    //     'name' => ucwords($parsed['us_pack_name']),
                    //     'steam_url' => null,
                    //     'date' => Carbon::parse($parsed['us_pack_date']),
                    //     'region' => 'US',
                    // ]);
                }


                if ($euPackExists === null) {
                    // $pack = Pack::create([
                    //     'slug' => $euSlug,
                    //     'name' => ucwords($parsed['eu_pack_name']),
                    //     'steam_url' => null,
                    //     'date' => Carbon::parse($parsed['eu_pack_date']),
                    //     'region' => 'EU',
                    // ]);
                }
            }

            // ================================== //
            // ======= NOW ADD THE SONGS ======== //
            // ================================== //

        });
    }
}
