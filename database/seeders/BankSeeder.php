<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run()
    {
        $districts = [
            'Bagerhat',
            'Bandarban',
            'Barguna',
            'Barisal',
            'Bhola',
            'Bogura',
            'Brahmanbaria',
            'Chandpur',
            'Chattogram',
            'Chuadanga',
            'Comilla',
            'Cox\'s Bazar',
            'Dhaka',
            'Dinajpur',
            'Faridpur',
            'Feni',
            'Gaibandha',
            'Gazipur',
            'Gopalganj',
            'Habiganj',
            'Jamalpur',
            'Jashore',
            'Jhalokathi',
            'Jhenaidah',
            'Joypurhat',
            'Khagrachari',
            'Khulna',
            'Kishoreganj',
            'Kurigram',
            'Kushtia',
            'Lakshmipur',
            'Lalmonirhat',
            'Madaripur',
            'Magura',
            'Manikganj',
            'Meherpur',
            'Moulvibazar',
            'Munshiganj',
            'Mymensingh',
            'Naogaon',
            'Narail',
            'Narayanganj',
            'Narsingdi',
            'Natore',
            'Netrokona',
            'Nilphamari',
            'Noakhali',
            'Pabna',
            'Panchagarh',
            'Patuakhali',
            'Pirojpur',
            'Rajbari',
            'Rajshahi',
            'Rangamati',
            'Rangpur',
            'Satkhira',
            'Shariatpur',
            'Sherpur',
            'Sirajganj',
            'Sunamganj',
            'Sylhet',
            'Tangail',
            'Thakurgaon'
        ];

        $branches = [];

        foreach ($districts as $district) {
            $branches[] = [
                'name' => 'City Bank PLC',
                'branch_name' => $district . ' Branch',
                'address' => $district . ' Sadar, ' . $district,
                'short_address' => $district . ' Sadar',
                'district' => $district,
                'manager_name' => self::generateRandomBangladeshiName(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('banks')->insert($branches);
    }

    private static function generateRandomBangladeshiName()
    {
        $firstNames = ['ABDUL', 'HASAN', 'JAMAL', 'NASIR', 'RASHID', 'KAMAL', 'FAISAL', 'MEHEDI', 'AKRAM', 'TARIQ', 'MOINUL', 'RUBEL', 'SHAHID', 'SAZZAD', 'MAMUN'];
        $lastNames = ['HOSSAIN', 'AHMED', 'KHAN', 'MIAH', 'CHOWDHURY', 'SIKDER', 'MOLLAH', 'BISWAS', 'TALUKDER', 'SARDER', 'BHUIYAN', 'SHEIKH', 'PATWARY', 'MONDAL'];

        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }
}
