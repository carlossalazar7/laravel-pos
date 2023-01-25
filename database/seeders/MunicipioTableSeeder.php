<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipio::query()->truncate();

        //Ahuachapan
        DB::table('municipios')->insert([
            ['name' => 'Ahuachapán', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apaneca', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Atiquizaya', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Concepción de Ataco', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Refugio', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guaymango', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jujutla', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco Menéndez', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Lorenzo', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Pedro Puxtla', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tacuba', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Turín', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Cabañas
        DB::table('municipios')->insert([
            ['name' => 'Sensuntepeque', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cinquera', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dolores', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guacotecti', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ilobasco', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jutiapa', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Isidro', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tejutepeque', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Victoria', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Chalatenango
        DB::table('municipios')->insert([
            ['name' => 'Chalatenango', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Agua Caliente', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arcatao', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Azacualpa', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cancasque', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Citalá', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comalapa', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Concepción Quezaltepeque', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dulce Nombre de María', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Carrizal', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Paraíso', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Laguna', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Palma', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Reina', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Flores', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Vueltas', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nombre de Jesús', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Concepción', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Trinidad', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ojos de Agua', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Potonico', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio de la Cruz', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio Los Ranchos', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Fernando', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco Lempa', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco Morazán', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Ignacio', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Isidro Labrador', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Luis del Carmen', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Miguel de Mercedes', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Rafael', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Rita', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tejutla', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Cuscatlan
        DB::table('municipios')->insert([
            ['name' => 'Cojutepeque', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Candelaria', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Carmen', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Rosario', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Monte San Juan', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oratorio de Concepción', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Bartolomé Perulapía', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Cristóbal', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San José Guayabal', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Pedro Perulapán', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Rafael Cedros', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Ramón', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Cruz Analquito', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Cruz Michapa', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suchitoto', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tenancingo', 'department_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //La libertad
        DB::table('municipios')->insert([
            ['name' => 'Santa Tecla', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antiguo Cuscatlán', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chiltiupán', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ciudad Arce', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Colón', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comasagua', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Huizúcar', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jayaque', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jicalapa', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Libertad', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nuevo Cuscatlán', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quezaltepeque', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Juan Opico', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sacacoyo', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San José Villanueva', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Matías', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Pablo Tacachico', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Talnique', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamanique', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teotepeque', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tepecoyo', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Zaragoza', 'department_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //La Paz
        DB::table('municipios')->insert([
            ['name' => 'Zacatecoluca', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuyultitán', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Rosario', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jerusalén', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mercedes La Ceiba', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olocuilta', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paraíso de Osorio', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio Masahuat', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Emigdio', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco Chinameca', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Pedro Masahuat', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Juan Nonualco', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Juan Talpa', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Juan Tepezontes', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Luis La Herradura', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Luis Talpa', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Miguel Tepezontes', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Pedro Nonualco', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Rafael Obrajuelo', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa María Ostuma', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santiago Nonualco', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tapalhuaca', 'department_id' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //La Union
        DB::table('municipios')->insert([
            ['name' => 'La Unión', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anamorós', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bolívar', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Concepción de Oriente', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conchagua', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Carmen', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Sauce', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Intipucá', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lislique', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meanguera del Golfo', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Esparta', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pasaquina', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Polorós', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Alejo', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San José', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Rosa de Lima', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yayantique', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yucuaiquín', 'department_id' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Morazan
        DB::table('municipios')->insert([
            ['name' => 'San Francisco Gotera', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arambala', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cacaopera', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chilanga', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corinto', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delicias de Concepción', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Divisadero', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Rosario', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gualococti', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guatajiagua', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Joateca', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jocoaitique', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jocoro', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lolotiquillo', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meanguera', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Osicala', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Perquín', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Carlos', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Fernando', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Isidro', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Simón', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sensembra', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sociedad', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Torola', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yamabal', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yoloaiquín', 'department_id' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //San Miguel
        DB::table('municipios')->insert([
            ['name' => 'San Miguel', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carolina', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chapeltique', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chinameca', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chirilagua', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ciudad Barrios', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comacarán', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Tránsito', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lolotique', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Moncagua', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Guadalupe', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nuevo Edén de San Juan', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quelepa', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Gerardo', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Jorge', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Luis de la Reina', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Rafael Oriente', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sesori', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Uluazapa', 'department_id' => 9, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //San Salvador
        DB::table('municipios')->insert([
            ['name' => 'San Salvador', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aguilares', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apopa', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayutuxtepeque', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ciudad Delgado', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuscatancingo', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Paisnal', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guazapa', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ilopango', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mejicanos', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nejapa', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Panchimalco', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rosario de Mora', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Marcos', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Martín', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santiago Texacuangos', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santo Tomás', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soyapango', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tonacatepeque', 'department_id' => 10, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //San Vicente
        DB::table('municipios')->insert([
            ['name' => 'San Vicente', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apastepeque', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guadalupe', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Cayetano Istepeque', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Esteban Catarina', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Ildefonso', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Lorenzo', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Sebastián', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Clara', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santo Domingo', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tecoluca', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tepetitán', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Verapaz', 'department_id' => 11, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Santa Ana
        DB::table('municipios')->insert([
            ['name' => 'Santa Ana', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Candelaria de la Frontera', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chalchuapa', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coatepeque', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Congo', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Porvenir', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Masahuat', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Metapán', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio Pajonal', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Sebastián Salitrillo', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Rosa Guachipilín', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santiago de la Frontera', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Texistepeque', 'department_id' => 12, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Sonsonate
        DB::table('municipios')->insert([
            ['name' => 'Sonsonate', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acajutla', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Armenia', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caluco', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuisnahuat', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Izalco', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Juayúa', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nahuizalco', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nahulingo', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Salcoatitán', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio del Monte', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Julián', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Catarina Masahuat', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Isabel Ishuatán', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santo Domingo de Guzmán', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sonzacate', 'department_id' => 13, 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Usulutan
        DB::table('municipios')->insert([
            ['name' => 'Usulután', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alegría', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Berlín', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'California', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Concepción Batres', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Triunfo', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ereguayquín', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Estanzuelas', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jiquilisco', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jucuapa', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jucuarán', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mercedes Umaña', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Granada', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ozatlán', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Puerto El Triunfo', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Agustín', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Buenaventura', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Dionisio', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco Javier', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Elena', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa María', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santiago de María', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tecapán', 'department_id' => 14, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
