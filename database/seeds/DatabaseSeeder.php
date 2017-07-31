<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WorksTableSeeder::class);
        $this->call(PagosTableSeeder::class);
        $this->call(CostosSeeder::class);
        $this->call(ItemesSeeder::class);
    }
}
