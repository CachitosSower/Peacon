<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            DB::table('pagos')->insert([
                'id_trabajo' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
                'monto' => $faker->numberBetween(0, 200000),
                'fecha' => $faker->dateTimeBetween('past Monday -15 days', 'past Monday -9 days'),
                'medio_pago' => $faker->randomElement([1, 2, 3, 4]),
            ]);
        }
    }
}
