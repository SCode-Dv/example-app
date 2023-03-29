<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            'codigo' => '12454655',
            'precio' => 10.00,
            'existencia' => 50,
            'categoria_id' => 1,
            'activo' => 1,
        ]);
    }
}
