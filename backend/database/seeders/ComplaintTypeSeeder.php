<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('complaint_types')->insert([
            ['name' => 'Theft'],
            ['name' => 'Harassment'],
            ['name' => 'Assault'],
            ['name' => 'Cyber Crime'],
            ['name' => 'Domestic Violence'],
            ['name' => 'Fraud'],
            // Crimes Against Property & Public Safety
    ['name' => 'Robbery'],
    ['name' => 'Burglary / House Breaking'],
    ['name' => 'Arson'],
    ['name' => 'Extortion / Blackmail'],
    ['name' => 'Vandalism / Damage to Public Property'],
    ['name' => 'Burglary'],
    ['name' => 'Vandalism'],

    // Crimes Against Persons
    ['name' => 'Kidnapping / Abduction'],
    ['name' => 'Murder / Homicide'],
    ['name' => 'Stalking'],
    ['name' => 'Voyeurism'],
    ['name' => 'Human Trafficking'],
    ['name' => 'Sexual Offense'],
    ['name' => 'Kidnapping'],
    ['name' => 'Attempt to Commit Offense'],

    // Socio-Economic & Statutory Crimes
    ['name' => 'Drug Trafficking / Narcotics (NDPS)'],
    ['name' => 'Illegal Possession of Weapons / Arms Act'],
    ['name' => 'Money Laundering'],
    ['name' => 'Bribery / Corruption'],
    ['name' => 'Food / Medicine Adulteration'],
    ['name' => 'Drug Trafficking / Narcotics'],
    ['name' => 'Illegal Possession of Weapons'],

    // Public Order & Miscellaneous
    ['name' => 'Missing Person'],
    ['name' => 'Public Nuisance / Disturbance of Peace'],
    ['name' => 'Unlawful Assembly / Rioting'],
    ['name' => 'Gambling / Betting'],
    ['name' => 'Proclaimed Offender Search'],
    ['name' => 'Public Nuisance'],
        ]);
    }
}