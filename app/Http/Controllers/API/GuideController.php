<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Order;
use App\Models\DetalleGuia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use PDF;
use Config;
use Milon\Barcode\DNS1D;
use DB;
use \DateTime;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('guides.GuidesIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function guide()
    {
        $guides = Guide::all();
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('guides.Guides', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getAllGuides(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $guides = Guide::getGuides($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $guides['data'], 'count' => $guides['count']];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|numeric',
            'fecha_entrega' => 'required',
            'delivery_id'=> 'required',
            'route_id'=> 'required',
        ]);

        $guideData = [
            'name' => $request->name,
            'fecha_entrega' => $request->fecha_entrega,
            'observacion' => $request->observacion,
            'delivery_id' => $request->delivery_id,
            'route_id' => $request->route_id,
            'created_by' => Auth::user()->id
        ];

        $fecha_actual = date_create("now");
        $fecha_entrada =  date_create($request->input('fecha_entrega'));

        $days_last = $fecha_actual->diff($fecha_entrada);

        if(intval($days_last->format('%r%a')) < 0){
            $response = [
                'message' => Lang::get('lang.validacion_fecha')
            ];

            return response()->json($response, 404);
        }

        $pedidosGuia = $request->pedidosGuia;

        if(empty($pedidosGuia)){
            $response = [
                'message' => Lang::get('lang.seleccionar_al_menos_un_pedido')
            ];

            return response()->json($response, 404);
        }

        if ($guide = Guide::store($guideData)) {

            foreach ($pedidosGuia as $pedido){
                
                $pedidosData = [
                    'guide_id' => $guide->id,
                    'order_id' => $pedido["orderID"],
                ];
                DetalleGuia::store($pedidosData);

                $orden = Order::find($pedido["orderID"]);
                $orden->status = 'despachado';
                $orden->save();
            }

            $response = [
                'data' => 2,
                'message' => Lang::get('lang.guide') . ' ' . Lang::get('lang.successfully_saved')
            ];

            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        } 
    }

    public function generatePDF($id)
    {
        $orders = DB::query()
        ->fromSub(function ($query) use ($id){
            $query->select(
                'orders.id',
                'orders.invoice_id',
                'orders.sub_total',
                'orders.total',
                'orders.status',
                'branches.name as branch_name',
                DB::raw("CONCAT(customers.first_name,' ',customers.last_name)  AS customerName"),
                DB::raw("CONCAT(users.first_name,' ',users.last_name)  AS created_by_name"),
                'customers.phone_number',
                'shipping_information.shipping_address',
                DB::raw("CONCAT(TRUNCATE((order_items.quantity*-1),0), '-', GROUP_CONCAT(products.title))  AS 'productos'"))
                ->from('orders')
                ->join('users', 'users.id', '=', 'orders.created_by')
                ->join('branches', 'branches.id', '=', 'orders.branch_id')
                ->join('detalle_guia', 'detalle_guia.order_id', '=', 'orders.id')
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                ->join('shipping_information', 'shipping_information.order_id', '=', 'orders.id')
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'order_items.variant_id', '=', 'products.id')
                ->where("detalle_guia.guide_id", '=',$id)
                ->groupBy('order_items.id');
        }, 'resultados')
        ->select('id', 'invoice_id', 'sub_total', 'total', 'status', 'branch_name', 'customerName', 'created_by_name', 'phone_number', 'shipping_address',
        DB::raw("GROUP_CONCAT(productos SEPARATOR ' + ') as 'tipo_productos'"))
        ->groupBy('id')
        ->get();

        $total = 0;
        foreach($orders as $item){
            $total += $item->total;
        }

        $guide = Guide::select('guides.*', 'deliveries.nombre as deliveryName', 'routes.name as routeName', DB::raw("SUM(orders.total) as total"))
        ->leftJoin('detalle_guia', 'detalle_guia.guide_id', '=', 'guides.id')
        ->leftJoin('orders', 'orders.id', '=', 'detalle_guia.order_id')
        ->leftJoin('deliveries', 'deliveries.id', '=', 'guides.delivery_id')
        ->leftJoin('routes', 'routes.id', '=', 'guides.route_id')
        ->where('guides.id', '=',$id)
        ->groupBy('guides.id')->first();

        $invoiceLogo = Config::get('invoiceLogo');
        $fileNameToStore = 'IMPADI-' . $guide['name'] . '.pdf';
        $appName = Config::get('app_name');

        $pdf = PDF::loadView('guides.guideDetail',
            [ 
                "guide" => $guide,
                "orders" => $orders,
                "total" => $total,
                "appName" => $appName,
                "invoiceLogo" => $invoiceLogo
            ]
            );
        $pdf->render();
        return $pdf->stream($fileNameToStore);
    }
    

    public function show($id)
    {
        $guia = Guide::find($id);
        $pedidosGuia = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('shipping_information', 'shipping_information.order_id', '=', 'orders.id')
        ->join('shipping_areas', 'shipping_areas.id', '=', 'shipping_information.shipping_area_id')
        ->join('detalle_guia','detalle_guia.order_id','=','orders.id')
        ->select('orders.invoice_id', 
        'customers.first_name',
        'customers.last_name', 
        'orders.created_at as date', 
        'orders.total', 
        'orders.status', 
        'orders.id as orderID', 
        'shipping_areas.area')
        ->where('detalle_guia.guide_id', '=', $id)->get();

        return ['guia' => $guia, 'pedidosGuia' => $pedidosGuia];
    }

    public static function ordenesGuia()
    {
        return ;
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|numeric',
            'fecha_entrega' => 'required',
            'delivery_id'=> 'required',
            'route_id'=> 'required',
        ]);

        $guide = Guide::getOne($id);

        $fecha_actual = date_create("now");
        $fecha_entrada =  date_create($request->input('fecha_entrega'));

        $days_last = $fecha_actual->diff($fecha_entrada);

        if(intval($days_last->format('%r%a')) < 0){
            $response = [
                'message' => Lang::get('lang.validacion_fecha')
            ];

            return response()->json($response, 404);
        }

        if($guide->status == 'open'){

            $pedidosGuia = $request->input('pedidosGuia');

            if(empty($pedidosGuia)){
                $response = [
                    'message' => Lang::get('lang.seleccionar_al_menos_un_pedido')
                ];
    
                return response()->json($response, 404);
            }
            
            if ($guide) {
                $guide->name = $request->input('name');
                $guide->fecha_entrega = $request->input('fecha_entrega');
                $guide->observacion = $request->input('observacion');
                $guide->delivery_id = $request->input('delivery_id');
                $guide->route_id = $request->input('route_id');
                $guide->save();
    
                // agregar pedidos a guia
                $pedidos = [];
                foreach ($pedidosGuia as $pedido){
                    
                    $pedidosGuiaActual = DetalleGuia::where('guide_id', '=', $id)->where('order_id', '=', $pedido["orderID"])->first();
                    
                    if($pedidosGuiaActual == null){
                        $pedidosData = [
                            'guide_id' => $guide->id,
                            'order_id' => $pedido["orderID"],
                        ];
                        DetalleGuia::store($pedidosData);
    
                        $orden = Order::find($pedido["orderID"]);
                        $orden->status = 'despachado';
                        $orden->save();
                    }
                    array_push($pedidos, $pedido["orderID"]);
                }
    
                // Eliminar pedidos de la guia
                $pedidosExtraer = Order::select('orders.id as id')
                ->join('detalle_guia', 'detalle_guia.order_id', '=', 'orders.id')
                ->where('detalle_guia.guide_id', '=', $id)->whereNotIn('order_id', $pedidos)->get();
    
                foreach ($pedidosExtraer as $pedido){
                    $orden = Order::find($pedido["id"]);
                    $orden->status = 'en preparacion';
                    $orden->save();
                }
    
                DetalleGuia::where('guide_id', '=', $id)->whereNotIn('order_id', $pedidos)->delete();
    
                $response = [
                    'message' => Lang::get('lang.guide') . ' ' . Lang::get('lang.successfully_updated')
                ];
    
                return response()->json($response, 201);
            } else {
                $response = [
                    'message' => Lang::get('lang.getting_problems')
                ];
    
                return response()->json($response, 404);
            }          
        } else {
            $response = [
                'message' => Lang::get('lang.error_during_update')
            ];

            return response()->json($response, 400);
        }

    }

    public function destroy($id)
    {

        $pedidosExtraer = Order::select('orders.id as id')
            ->join('detalle_guia', 'detalle_guia.order_id', '=', 'orders.id')
            ->where('detalle_guia.guide_id', '=', $id)->get();

        foreach ($pedidosExtraer as $pedido){
            $orden = Order::find($pedido["id"]);
            $orden->status = 'en preparacion';
            $orden->save();
        }

        Guide::deleteData($id);
        DetalleGuia::where('guide_id', '=', $id)->delete();

        $response = [
            'message' => Lang::get('lang.guide') . ' ' . Lang::get('lang.successfully_deleted')
        ];

        return response()->json($response, 201);

    }
    
}
