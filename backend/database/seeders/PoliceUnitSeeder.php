<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliceUnitSeeder extends Seeder
{
    public function run()
    {
        $units = [

            // ================= Commissionerates =================
            ['type' => 'Commissionerate', 'name' => 'Asansol-Durgapur Police Commissionerate'],
            ['type' => 'Commissionerate', 'name' => 'Barrackpore Police Commissionerate'],
            ['type' => 'Commissionerate', 'name' => 'Bidhannagar Police Commissionerate'],
            ['type' => 'Commissionerate', 'name' => 'Chandannagar Police Commissionerate'],
            ['type' => 'Commissionerate', 'name' => 'Howrah Police Commissionerate'],
            ['type' => 'Commissionerate', 'name' => 'Siliguri Police Commissionerate'],

            // ================= Districts =================
            ['type' => 'District', 'name' => 'Alipurduar District Police'],
            ['type' => 'District', 'name' => 'Bangaon Police District'],
            ['type' => 'District', 'name' => 'Bankura District Police'],
            ['type' => 'District', 'name' => 'Barasat Police District'],
            ['type' => 'District', 'name' => 'Baruipur Police District'],
            ['type' => 'District', 'name' => 'Basirhat Police District'],
            ['type' => 'District', 'name' => 'Birbhum District Police'],
            ['type' => 'District', 'name' => 'Coochbehar District Police'],
            ['type' => 'District', 'name' => 'Dakshin Dinajpur District Police'],
            ['type' => 'District', 'name' => 'Darjeeling District Police'],
            ['type' => 'District', 'name' => 'Diamond Harbour Police District'],
            ['type' => 'District', 'name' => 'Hooghly Rural District Police'],
            ['type' => 'District', 'name' => 'Howrah Rural District Police'],
            ['type' => 'District', 'name' => 'Islampur Police District'],
            ['type' => 'District', 'name' => 'Jalpaiguri District Police'],
            ['type' => 'District', 'name' => 'Jangipur Police District'],
            ['type' => 'District', 'name' => 'Jhargram District Police'],
            ['type' => 'District', 'name' => 'Kalimpong District Police'],
            ['type' => 'District', 'name' => 'Krishnanagar Police District'],
            ['type' => 'District', 'name' => 'Malda District Police'],
            ['type' => 'District', 'name' => 'Murshidabad Police District'],
            ['type' => 'District', 'name' => 'Paschim Medinipur District Police'],
            ['type' => 'District', 'name' => 'Purba Burdwan District Police'],
            ['type' => 'District', 'name' => 'Purba Medinipur District Police'],
            ['type' => 'District', 'name' => 'Purulia District Police'],
            ['type' => 'District', 'name' => 'Raiganj Police District '],
            ['type' => 'District', 'name' => 'Ranaghat Police District '],
            ['type' => 'District', 'name' => 'Sundarban Police District'],

        ];

        foreach ($units as $unit) {
            DB::table('police_units')->updateOrInsert(
                ['name' => $unit['name']],
                [
                    'type' => $unit['type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}