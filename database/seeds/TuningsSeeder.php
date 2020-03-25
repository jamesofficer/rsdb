<?php

use App\Tuning;
use Illuminate\Database\Seeder;

class TuningsSeeder extends Seeder
{
    public function run()
    {
        $tunings = [
            'A♭D♭A♭D♭E♭A♭',
            'B Standard',
            'B Drop A',
            'C Standard',
            'C# Standard',
            'C# Drop B',
            'Drop C',
            'CGCGGE',
            'D Standard',
            'D Standard: A443',
            'Drop D',
            'Drop D♭',
            'D Drop C',
            'DADFCd',
            'DADFAd',
            'DBDGBE',
            'E Standard',
            'E Standard: A425',
            'E Standard: A428',
            'E Standard: A431',
            'E Standard: A443',
            'E Standard: A444',
            'E Standard: A445',
            'E Standard: A446',
            'E Standard: A447',
            'E Standard: A449',
            'E Standard: A450',
            'E Standard: A454',
            'E Standard: A456',
            'E♭ Standard',
            'E♭ Standard: A431',
            'E♭ Standard: A437',
            'E♭ Standard: A447',
            'E♭ Drop D♭',
            'EADGAe',
            'E♭A♭D♭E♭A♭E♭',
            'EADBGD',
            'EABGBd♯',
            'EADGCf',
            'F Standard',
            'Open A',
            'Open D',
            'Open E',
            'Open G',
            'Other',
        ];

        foreach ($tunings as $tuning) {
            Tuning::create(['name' => $tuning]);
        }
    }
}
