<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use DB;


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

    public static function getGuideData($id){
        $guia = Guide::join('deliveries', 'deliveries.id', '=', 'guides.delivery_id')
        ->join('routes', 'routes.id', '=', 'guides.route_id')
        ->select('guides.*', 'routes.name as route', 'deliveries.nombre as delivery')->find($id);
        $pedidosGuia = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('shipping_information', 'shipping_information.order_id', '=', 'orders.id')
        ->join('shipping_areas', 'shipping_areas.id', '=', 'shipping_information.shipping_area_id')
        ->join('detalle_guia','detalle_guia.order_id','=','orders.id')
        ->select('orders.invoice_id', 
        DB::raw("CONCAT(customers.first_name,' ',customers.last_name)  AS customer"),
        'orders.created_at as date', 
        'orders.total', 
        'orders.status', 
        'orders.id as orderID', 
        'shipping_areas.area')
        ->where('detalle_guia.guide_id', '=', $id)->get();

        return ["guia" => $guia, 'pedidosGuia' => $pedidosGuia];
    }

    /*public static function usedGuide($id)
    {
        return PuntoEntrega::where('municipio_id', $id)->count();
    }*/
}
