<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Municipio extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'department_id'];

    public static function getMunicipios($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Municipio::join('departamentos', 'municipios.department_id', '=', 'departamentos.id')
                ->select('municipios.*', 'departamentos.name as nombreDepartamento')
                ->orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = Municipio::join('departamentos', 'municipios.department_id', '=', 'departamentos.id')
                ->select('municipios.*', 'departamentos.name as nombreDepartamento')
                ->orderBy($column, $request)->get();
        }
        $count = Municipio::count();
        return ["data" => $data, 'count' => $count];
    }

    public static function usedMunicipio($id)
    {
        return PuntoEntrega::where('municipio_id', $id)->count();
    }
}
