<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'fecha_entrega', 'observacion', 'delivery_id', 'route_id'];

    public static function getGuides($column, $request, $limit, $rowOffset, $requestType)
    {
        if (empty($requestType)) {
            $data = Guide::leftJoin('deliveries', 'guides.delivery_id', '=', 'deliveries.id')
            ->leftJoin('routes', 'guides.route_id', '=', 'routes.id')
            ->select('guides.*', 'deliveries.nombre as nombreDelivery', 'routes.name as nombreRuta')
            ->orderBy($column, $request)->take($limit)->skip($rowOffset)->get();
        } else {
            $data = Guide::leftJoin('deliveries', 'guides.delivery_id', '=', 'deliveries.id')
            ->leftJoin('routes', 'guides.route_id', '=', 'routes.id')
            ->select('guides.*', 'deliveries.nombre as nombreDelivery', 'routes.name as nombreRuta')
            ->orderBy($column, $request)->get();
        }
        $count = Guide::count();
        return ["data" => $data, 'count' => $count];
    }

    /*public static function usedGuide($id)
    {
        return PuntoEntrega::where('municipio_id', $id)->count();
    }*/
}
