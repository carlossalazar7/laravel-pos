<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'shipping_area_id'];

    public static function getRoute($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Route::join('shipping_areas', 'shipping_areas.id', '=', 'routes.shipping_area_id')
            ->select('routes.id as id', 'name', 'area', 'price')
            ->orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = Route::join('shipping_areas', 'shipping_areas.id', '=', 'routes.shipping_area_id')
            ->select('routes.id as id', 'name', 'area', 'price')
            ->orderBy($column, $request)->get();
        }
        $count = Route::count();
        return ["data" => $data, 'count' => $count];
    }
}
