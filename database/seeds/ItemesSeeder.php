<?php

use Illuminate\Database\Seeder;

class ItemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,500) as $index) {
            $fecha = $faker->dateTimeBetween('past Monday -15 days', 'past Monday -9 days');
            DB::table('itemes')->insert([
                'nombre' => $faker->realText(25),
                'id_costo' => rand(1, 10),
                'cantidad' => $faker->numberBetween(1, 10),
                'precio' => $faker->numberBetween(1000, 100000),
                'es_proveedor' => rand(0, 1),
                'descuento_porcentual' => $faker->numberBetween(0, 20),
                'descuento_bruto' => 0,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]);
        }
    }
}
