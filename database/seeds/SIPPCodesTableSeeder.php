<?php

use Illuminate\Database\Seeder;

class SIPPCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = [
            [
                'code_letter' => 'M',
                'description' => 'Mini',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'N',
                'description' => 'Mini Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'E',
                'description' => 'Economy',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'H',
                'description' => 'Economy Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'C',
                'description' => 'Compact',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'D',
                'description' => 'Compact Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'I',
                'description' => 'Intermediate',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'J',
                'description' => 'Intermediate Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'S',
                'description' => 'Standard',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'R',
                'description' => 'Standard Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'F',
                'description' => 'Fullsize',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'G',
                'description' => 'Fullsize Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'P',
                'description' => 'Premium',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'U',
                'description' => 'Premium Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'L',
                'description' => 'Luxury',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'W',
                'description' => 'Luxury Elite',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'O',
                'description' => 'Oversize',
                'code_type' => 'A',
            ],
            [
                'code_letter' => 'X',
                'description' => 'Special',
                'code_type' => 'A',
            ],

            [
                'code_letter' => 'B',
                'description' => '2/3 door',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'C',
                'description' => '2/4 door',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'D',
                'description' => '4/5 door',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'W',
                'description' => 'Wagon / Estate',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'V',
                'description' => 'Passenger Van',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'L',
                'description' => 'Limousine',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'S',
                'description' => 'Sport',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'T',
                'description' => 'Convertable',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'J',
                'description' => 'Open Air All Terrain',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'X',
                'description' => 'Special',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'P',
                'description' => 'Pickup Regular Cab',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'Q',
                'description' => 'Pickup Extended Cab',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'Z',
                'description' => 'Special Offer Car',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'E',
                'description' => 'Coupe',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'M',
                'description' => 'Monospace',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'R',
                'description' => 'Recreational',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'H',
                'description' => 'Motor Home',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'Y',
                'description' => '2 Wheel Vehicle',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'N',
                'description' => 'Roadster',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'G',
                'description' => 'Crossover',
                'code_type' => 'B',
            ],
            [
                'code_letter' => 'K',
                'description' => 'Commercial Van / Truck',
                'code_type' => 'B',
            ],

            [
                'code_letter' => 'M',
                'description' => 'Manual drive',
                'code_type' => 'C',
            ],
            [
                'code_letter' => 'N',
                'description' => 'Manual, 4WD',
                'code_type' => 'C',
            ],
            [
                'code_letter' => 'C',
                'description' => 'Manual, AWD',
                'code_type' => 'C',
            ],
            [
                'code_letter' => 'A',
                'description' => 'Auto drive',
                'code_type' => 'C',
            ],
            [
                'code_letter' => 'B',
                'description' => 'Auto, 4WD',
                'code_type' => 'C',
            ],
            [
                'code_letter' => 'D',
                'description' => 'Auto, AWD',
                'code_type' => 'C',
            ],


            [
                'code_letter' => 'N',
                'description' => 'Unspecified fuel, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'R',
                'description' => 'Unspecified fuel, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'D',
                'description' => 'Diesel, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'Q',
                'description' => 'Diesel, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'H',
                'description' => 'Hybrid, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'I',
                'description' => 'Hybrid, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'E',
                'description' => 'Electric, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'C',
                'description' => 'Electric, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'L',
                'description' => 'LPG/Gas, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'S',
                'description' => 'LPG/Gas, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'A',
                'description' => 'Hydrogen, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'B',
                'description' => 'Hydrogen, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'M',
                'description' => 'Multi fuel, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'F',
                'description' => 'Multi fuel, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'V',
                'description' => 'Petrol, A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'Z',
                'description' => 'Petrol, no A/C',
                'code_type' => 'D',
            ],
            [
                'code_letter' => 'X',
                'description' => 'Ethanol, no A/C',
                'code_type' => 'D',
            ],
        ];
        DB::table('sipp_codes')->insert($codes);
    }
}
