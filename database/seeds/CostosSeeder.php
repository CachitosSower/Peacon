<?php

use Illuminate\Database\Seeder;

class CostosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1,100) as $index) {
            $fecha = $faker->dateTimeBetween('past Monday -15 days', 'past Monday -9 days');
            DB::table('costos')->insert([
                'descripcion' => $faker->realText(25),
                'id_trabajo' => rand(1, 50),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]);
        }
    }
}
