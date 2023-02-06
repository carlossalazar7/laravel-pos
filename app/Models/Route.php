<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function getRoute($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Route::orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = Route::orderBy($column, $request)->get();
        }
        $count = Route::count();
        return ["data" => $data, 'count' => $count];
    }
}
