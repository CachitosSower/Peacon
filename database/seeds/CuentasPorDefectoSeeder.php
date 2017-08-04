<?php

use Illuminate\Database\Seeder;

class CuentasPorDefectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = new DateTime();
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@ymir.cl',
            'password' => bcrypt('admin'),
            'created_at' => $fecha,
            'updated_at' => $fecha,
        ]);
    }
}
