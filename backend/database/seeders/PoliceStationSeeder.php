<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliceStationSeeder extends Seeder
{
    public function run()
    {
        /**
         * Helper function to insert stations safely
         */
        function insertStations($unitName, $stations)
        {
            $unitId = DB::table('police_units')
                ->where('name', $unitName)
                ->value('id');

            if (!$unitId) {
                echo "{$unitName} not found in police_units table\n";
                return;
            }

            foreach ($stations as $station) {
                DB::table('police_stations')->updateOrInsert(
                    [
                        'police_unit_id' => $unitId,
                        'station_name' => $station,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            echo "{$unitName} stations inserted successfully\n";
        }

        /* ================= COMMISSIONERATES ================= */

        // Chandannagar Police Commissionerate
        insertStations(
            'Chandannagar Police Commissionerate',
            [
                'Bhadreswar PS',
                'Chandernagore PS',
                'Chinsura Women PS',
                'Chinsurah PS',
                'Cyber Crime PS',
                'Dankuni PS',
                'Rishra PS',
                'Serampore PS',
                'Serampore Women PS',
                'Uttarpara PS',
            ]
        );

        // Asansol-Durgapur Police Commissionerate
        insertStations(
            'Asansol-Durgapur Police Commissionerate',
            [
                'ADPC Cyber Crime',
                'Andal PS',
                'Asansol North PS',
                'Asansol South PS',
                'Asansol Women PS',
                'Barabani PS',
                'Budbud PS',
                'Chittaranjan PS',
                'Coke Oven PS',
                'Durgapur PS',
                'Durgapur Women PS',
                'Faridpur PS',
                'Hirapur PS',
                'Jamuria PS',
                'Kanksa PS',
                'Kulti PS',
                'Lauda (Faridpur) PS',
                'New Town Ship PS',
                'Pandabeswar PS',
                'Raniganj PS',
                'Salanpur PS',
            ]
        );

        // Barrackpore Police Commissionerate
        insertStations(
            'Barrackpore Police Commissionerate',
            [
                'Baranagar PS',
                'Barrackpore Cyber PS',
                'Barrackpore PS',
                'Barrackpore Women PS',
                'Basudebpur PS',
                'Belghoria PS',
                'Bhatpara PS',
                'Bizpore PS',
                'Dakshinewar PS',
                'Dumdum PS',
                'Ghola PS',
                'Halisahar PS',
                'Jagaddal PS',
                'Jetia PS',
                'Kamarhati PS',
                'Khardah PS',
                'Mohanpur PS',
                'Nagerbazar PS',
                'Naihati PS',
                'New Barrackpore PS',
                'Nimta PS',
                'Noapara PS',
                'Rahara PS',
                'Shibdaspur PS',
                'Titagarh PS',
            ]
        );

        // Bidhannagar Police Commissionerate
        insertStations(
            'Bidhannagar Police Commissionerate',
            [
                'Airport PS',
                'Baguiati PS',
                'Bidhannagar Women PS',
                'Bidhannagar East PS',
                'Bidhannagar North PS',
                'Bidhannagar South PS',
                'Cyber Crime',
                'Eco Park PS',
                'Electronic Complex PS',
                'Lake Town PS',
                'Narayanpur PS',
                'New Town PS',
                'NSCBI Airport PS',
                'Rajarhat PS',
                'Technocity PS',
            ]
        );

        // Howrah Police Commissionerate
        insertStations(
            'Howrah Police Commissionerate',
            [
                'A.J.C. Bose Botanic Garden PS',
                'Bally PS',
                'Bantra PS',
                'Belur PS',
                'Chatterjeehat PS',
                'Dasnagar PS',
                'Domjur PS',
                'Golabari PS',
                'Howrah PS',
                'Jagacha PS',
                'Liluah PS',
                'Mallipanchghora PS',
                'Nischinda PS',
                'Sankrail PS',
                'Santragachi PS',
                'Shibpur PS',
            ]
        );

        // Siliguri Police Commissionerate
        insertStations(
            'Siliguri Police Commissionerate',
            [
                'Bagdogra PS',
                'Bhaktinagar PS',
                'Matigara PS',
                'New Jalpaiguri PS',
                'Pradhannagar PS',
                'Siliguri Cyber Crime',
                'Siliguri PS',
                'Siliguri Women PS',
            ]
        );

        /* ================= DISTRICTS ================= */

// Alipurduar District Police
insertStations(
    'Alipurduar District Police',
    [
        'Alipurduar PS',
        'Alipurduar Women PS',
        'Birpara PS',
        'Falakata PS',
        'Jaigaon PS',
        'Kalchini PS',
        'Kumargam PS',
        'Madarihat PS',
        'Samuktala PS',
        'Cyber Crime',
    ]
);

//  Bangaon Police District
insertStations(
    'Bangaon Police District',
    [
        'Bagdah PS',
        'Bongaon PS',
        'Bongaon Women PS',
        'Gaighata PS',
        'Gopalnagar PS',
        'Petrapole PS',
        'Cyber Crime PS',
    ]
);

// Bankura District Police
insertStations(
    'Bankura District Police',
    [
        'Bankura PS',
        'Bankura Women PS',
        'Barikul PS',
        'Barjora PS',
        'Beliatore PS',
        'Bishnupur PS',
        'Chhatna PS',
        'Gangajalghati PS',
        'Hirbandh PS',
        'Indpur PS',
        'Indus PS',
        'Joypur PS',
        'Khatra PS',
        'Kotulpur PS',
        'Mejia PS',
        'Onda PS',
        'Patrasayer PS',
        'Raipur PS',
        'Ranibandh PS',
        'Saltora PS',
        'Saranga PS',
        'Simlapal PS',
        'Sonamukhi PS',
        'Taldangra PS',
        'Cyber PS',
    ]
);

// Barasat Police District
insertStations(
    'Barasat Police District',
    [
        'Amdanga PS',
        'Ashokenagar PS',
        'Barasat PS',
        'Barasat Women PS',
        'Deganga PS',
        'Duttapukur PS',
        'Gobardanga PS',
        'Habra PS',
        'Madhyamgram PS',
        'Shasan PS',
        'Cyber Crime PS',
    ]
);

// Baruipur Police District
insertStations(
    'Baruipur Police District',
    [
        'Bakultala PS',
        'Baruipur PS',
        'Baruipur Women PS',
        'Basanti PS',
        'Bhangore PS',
        'Canning PS',
        'Canning Women PS',
        'Gosaba PS',
        'Jharkhali Coastal PS',
        'Jibantala PS',
        'Joynagar PS',
        'Kashipur PS',
        'Kultali PS',
        'Maipith Coastal PS',
        'Narendrapur PS',
        'Sonarpur PS',
        'Cyber Crime PS',
    ]
);

// Basirhat Police District
insertStations(
    'Basirhat Police District',
    [
        'Baduria PS',
        'Basirhat PS',
        'Haroa PS',
        'Hasnabad PS',
        'Hemnagar Coastal PS',
        'Hingalganj PS',
        'Matia PS',
        'Minakhan PS',
        'Nazat PS',
        'Sandeshkhali PS',
        'Swarupnagar PS',
        'Cyber Crime PS',
    ]
);

// Birbhum District Police
insertStations(
    'Birbhum District Police',
    [
        'Bolpur PS',
        'Bolpur Women PS',
        'Dubrajpur PS',
        'Illambazar PS',
        'Kankartala PS',
        'Khayrasole PS',
        'Kirnahar PS',
        'Labpur PS',
        'Mallarpur PS',
        'Mayureswar PS',
        'Murarai PS',
        'Nalhati PS',
        'Nanoor PS',
        'Rampurhat PS',
        'Sainthia PS',
        'Shantiniketan PS',
        'Suri PS',
        'Suri Women PS',
        'Tarapith PS',
        'Cyber Crime PS',
    ]
);

// Coochbehar District Police
insertStations(
    'Coochbehar District Police',
    [
        'Cooch Behar Kotwali PS',
        'Cooch Behar Women PS',
        'Dinhata PS',
        'Dinhata Women PS',
        'Ghogshadanga PS',
        'Haldibari PS',
        'Kuchlibari PS',
        'Mathabhanga PS',
        'Mekhliganj PS',
        'Pundibari PS',
        'Sahebganj PS',
        'Sitai PS',
        'Sitalkuchi PS',
        'Tufanganj PS',
        'Cyber Crime',
    ]
);
insertStations(
    'Dakshin Dinajpur District Police',
    [
        'Balurghat PS',
        'Balurghat Women PS',
        'Bansihari PS',
        'Gangarampur PS',
        'Harirampur PS',
        'Hili PS',
        'Kumarganj PS',
        'Kushmandi PS',
        'Patiram PS',
        'Tapan PS',
    ]
);
insertStations(
    'Diamond Harbour Police District',
    [
        'Diamond Harbour PS',
        'Diamond Harbour Women PS',
        'Budge Budge PS',
        'Falta PS',
        'Magrahat PS',
        'Maheshtala PS',
        'Nodakhali PS',
        'Pujali PS',
        'Rabindranagar PS',
        'Ramnagar PS',
        'Usthi PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Hooghly Rural District Police',
    [
        'Arambagh PS',
        'Arambagh Women PS',
        'Balagarh PS',
        'Chanditala PS',
        'Dadpur PS',
        'Dhaniakhali PS',
        'Goghat PS',
        'Gurap PS',
        'Haripal PS',
        'Jangipara PS',
        'Khanakul PS',
        'Mogra PS',
        'Pandua PS',
        'Polba PS',
        'Pursurah PS',
        'Singur PS',
        'Tarakeswar PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Howrah Rural District Police',
    [
        'Amta PS',
        'Bagnan PS',
        'Bauria PS',
        'Jagatballavpur PS',
        'Joypur PS',
        'Panchla PS',
        'Rajapur PS',
        'Shyampur PS',
        'Udayanarayanpur PS',
        'Uluberia PS',
        'Uluberia Women PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Islampur Police District',
    [
        'Islampur PS',
        'Chakulia PS',
        'Chopra PS',
        'Dalkhola PS',
        'Goalpokhar PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Jalpaiguri District Police',
    [
        'Jalpaiguri Kotwali PS',
        'Jalpaiguri Women PS',
        'Banarhat PS',
        'Dhupguri PS',
        'Malbazar PS',
        'Mateli PS',
        'Maynaguri PS',
        'Nagrakata PS',
        'Rajganj PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Jangipur Police District',
    [
        'Farakka PS',
        'Raghunathganj PS',
        'Sagardighi PS',
        'Samsherganj PS',
        'Suti PS',
        'Women PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Jhargram District Police',
    [
        'Jhargram PS',
        'Jhargram Women PS',
        'Beliabera PS',
        'Belpahari PS',
        'Binpur PS',
        'Gopiballavpur PS',
        'Jamboni PS',
        'Lalgarh PS',
        'Nayagram PS',
        'Sankrail PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Kalimpong District Police',
    [
        'Kalimpong PS',
        'Kalimpong Women PS',
        'Gorubathan PS',
        'Jaldhaka PS',
        'Lava PS',
        'Pedong PS',
        'Reang PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Krishnanagar Police District',
    [
        'Krishnanagar PS',
        'Krishnanagar Women PS',
        'Bhimpur PS',
        'Chapra PS',
        'Dhubulia PS',
        'Kaliganj PS',
        'Karimpur PS',
        'Kotwali PS',
        'Nabadwip PS',
        'Palashipara PS',
        'Tehatta PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Malda District Police',
    [
        'English Bazar PS',
        'English Bazar Women PS',
        'Baishnabnagar PS',
        'Bamongola PS',
        'Chanchal PS',
        'Gazol PS',
        'Habibpur PS',
        'Harishchandrapur PS',
        'Kaliachak PS',
        'Manikchak PS',
        'Ratua PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Murshidabad Police District',
    [
        'Berhampore PS',
        'Berhampore Women PS',
        'Beldanga PS',
        'Domkal PS',
        'Hariharpara PS',
        'Islampur PS',
        'Jiaganj PS',
        'Kandi PS',
        'Lalgola PS',
        'Nabagram PS',
        'Raninagar PS',
        'Salar PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Paschim Medinipur District Police',
    [
        'Medinipur PS',
        'Medinipur Women PS',
        'Belda PS',
        'Chandrakona PS',
        'Dantan PS',
        'Ghatal PS',
        'Garhbeta PS',
        'Kharagpur Town PS',
        'Kharagpur Women PS',
        'Narayangarh PS',
        'Sabang PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Purba Burdwan District Police',
    [
        'Burdwan PS',
        'Women Burdwan PS',
        'Aushgram PS',
        'Bhatar PS',
        'Galsi PS',
        'Kalna PS',
        'Katwa PS',
        'Memari PS',
        'Raina PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Purba Medinipur District Police',
    [
        'Tamluk PS',
        'Tamluk Women PS',
        'Contai PS',
        'Contai Women PS',
        'Digha PS',
        'Egra PS',
        'Haldia PS',
        'Kolaghat PS',
        'Mahishadal PS',
        'Nandakumar PS',
        'Panskura PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Purulia District Police',
    [
        'Purulia Town PS',
        'Purulia Women PS',
        'Adra PS',
        'Arsha PS',
        'Baghmundi PS',
        'Balarampur PS',
        'Hura PS',
        'Jhalda PS',
        'Manbazar PS',
        'Raghunathpur PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Raiganj Police District',
    [
        'Raiganj PS',
        'Raiganj Women PS',
        'Hemtabad PS',
        'Itahar PS',
        'Kaliyaganj PS',
        'Karandighi PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Ranaghat Police District',
    [
        'Ranaghat PS',
        'Ranaghat Women PS',
        'Chakdah PS',
        'Gangnapur PS',
        'Hanskhali PS',
        'Haringhata PS',
        'Santipur PS',
        'Taherpur PS',
        'Cyber Crime PS',
    ]
);
insertStations(
    'Sundarban Police District',
    [
        'Kakdwip PS',
        'Pathar Pratima PS',
        'Raidighi PS',
        'Namkhana PS',
        'Sagar PS',
        'Frezerganj Coastal PS',
        'Gangasagar Coastal PS',
        'Gobardhanpur Coastal PS',
        'Cyber Crime PS',
    ]
);
    }
}