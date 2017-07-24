<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * $table->integer('estado');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_termino');
         */
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            $start = $faker->dateTimeBetween('past Monday -15 days', 'past Monday -9 days');
            $end = $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days');
            $start2 = $faker->dateTimeBetween('next Monday -15 days', 'next Monday -9 days');
            DB::table('works')->insert([
                'descripcion' => $faker->bs,
                'empresa' => $faker->company . ' ' . $faker->companySuffix,
                'rut' => $faker->numberBetween(65000000, 99000000),
                'estado' =>  $faker->randomElement([-1, 0, 1, 2]),
                'fecha_inicio' => $start,
                'fecha_termino' => $end,
                'created_at' => $start2,
            ]);
        }
    }
}
