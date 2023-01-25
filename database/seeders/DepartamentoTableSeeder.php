<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::query()->truncate();

        DB::table('departamentos')->insert([
            ['name' => 'Ahuachapán', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Cabañas', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Chalatenango', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Cuscatlán', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'La Libertad', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'La Paz', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'La Unión', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Morazán', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'San Miguel', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'San Salvador', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'San Vicente', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Santa Ana', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Sonsonate', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
            ['name' => 'Usulután', 'country' => 'El Salvador','created_at' =>now(), 'updated_at' =>now()],
        ]);


    }
}
