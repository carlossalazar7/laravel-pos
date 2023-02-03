<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoEntrega extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'municipio_id'];

    public static function getPuntosEntrega($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = PuntoEntrega::join('municipios', 'punto_entregas.municipio_id', '=', 'municipios.id')
                ->select('punto_entregas.*', 'municipios.name as nombreMunicipio')
                ->orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = PuntoEntrega::join('municipios', 'punto_entregas.municipio_id', '=', 'municipios.id')
                ->select('punto_entregas.*', 'municipios.name as nombreMunicipio')
                ->orderBy($column, $request)->get();
        }
        $count = PuntoEntrega::count();
        return ["data" => $data, 'count' => $count];
    }
}
