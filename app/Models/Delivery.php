<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends BaseModel
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono', 'correo', 'tipo'];

    public static function getDelivery($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Delivery::orderBy($column, $request)->take($limit)->skip($rowOffset)->where("status", "=", "active")->get();
        } else {
            $data = Delivery::orderBy($column, $request)->where("status", "=", "active")->get();
        }
        $count = Delivery::count();
        return ["data" => $data, 'count' => $count];
    }
}
