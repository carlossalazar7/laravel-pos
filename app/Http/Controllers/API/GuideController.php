<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Order;
use App\Models\DetalleGuia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('guides.GuidesIndex', ['tab_name' => $tabName, 'route_name' =>$routeName]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|numeric',
            'fecha_entrega' => 'required',
        ]);

        $guideData = [
            'name' => $request->name,
            'fecha_entrega' => $request->fecha_entrega,
            'observacion' => $request->observacion,
            'delivery_id' => $request->delivery_id,
            'route_id' => $request->route_id,
            'created_by' => Auth::user()->id
        ];
        $id_temp = 0;

        if ($guide = Guide::store($guideData)) {

            $pedidosGuia = $request->pedidosGuia;
            
            foreach ($pedidosGuia as $pedido){
                
                $pedidosData = [
                    'guide_id' => $guide->id,
                    'order_id' => $pedido["orderID"],
                ];
                DetalleGuia::store($pedidosData);
            }

            $response = [
                'data' => 2,
                'message' => Lang::get('lang.guide_name') . ' ' . Lang::get('lang.successfully_saved')
            ];

            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //return $guia;
    }

    public static function ordenesGuia()
    {
        return ;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|numeric',
            'fecha_entrega' => 'required',
        ]);

        $guide = Guide::getOne($id);

        if ($guide) {
            $guide->name = $request->input('name');
            $guide->fecha_entrega = $request->input('fecha_entrega');
            $guide->observacion = $request->input('observacion');
            $guide->delivery_id = $request->input('delivery_id');
            $guide->route_id = $request->input('route_id');
            $guide->save();

            // agregar pedidos a guia
            $pedidosGuia = $request->input('pedidosGuia');
            $pedidos = [];
            foreach ($pedidosGuia as $pedido){
                
                $pedidosGuiaActual = DetalleGuia::where('guide_id', '=', $id)->where('order_id', '=', $pedido["orderID"])->first();
                
                if($pedidosGuiaActual == null){
                    $pedidosData = [
                        'guide_id' => $guide->id,
                        'order_id' => $pedido["orderID"],
                    ];
                    DetalleGuia::store($pedidosData);
                }
                array_push($pedidos, $pedido["orderID"]);
            }
            DetalleGuia::where('guide_id', '=', $id)->whereNotIn('order_id', $pedidos)->delete();

            $response = [
                'message' => Lang::get('lang.guide_name') . ' ' . Lang::get('lang.successfully_updated')
            ];

            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guide::deleteData($id);
        DetalleGuia::where('guide_id', '=', $id)->delete();
        $response = [
            'message' => Lang::get('lang.guide_name') . ' ' . Lang::get('lang.successfully_deleted')
        ];

        return response()->json($response, 201);

        /*$used = Departamento::usedDepartamento($id);

        if ($used == 0) {
            Departamento::deleteData($id);
            $response = [
                'message' => Lang::get('lang.departamento') . ' ' . Lang::get('lang.successfully_deleted')
            ];

            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.departamento') . ' ' . Lang::get('lang.in_use') . ', ' . Lang::get('lang.you_can_not_delete_the') . ' ' . strtolower(Lang::get('lang.departamento'))
            ];

            return response()->json($response, 200);
        }*/
    }
    
}
