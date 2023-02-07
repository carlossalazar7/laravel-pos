<?php
namespace Database\Seeders;

use App\Models\ShippingArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingArea::query()->truncate();

        DB::table("shipping_areas")->insert([
            [
                'area' => 'San Salvador',
                'price' => '0',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'area' => 'Occidente',
                'price' => '1.99',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'area' => 'Oriente',
                'price' => '1.99',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'area' => 'Otros',
                'price' => '1.99',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        ]);
    }
}
