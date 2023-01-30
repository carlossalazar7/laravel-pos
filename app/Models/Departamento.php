<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'country'];

    public static function getDepartamento($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Departamento::orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = Departamento::orderBy($column, $request)->get();
        }
        $count = Departamento::count();
        return ["data" => $data, 'count' => $count];
    }

    public static function usedDepartamento($id)
    {
        return Municipio::where('department_id', $id)->count();
    }
}
