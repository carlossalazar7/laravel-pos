<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItems;
use App\Models\ShippingInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function PedidosEnPreparacionIndex()
    {
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('pedidos.PedidosEnPreparacion', ['tab_name' => $tabName, 'route_name' => $routeName]);
    
    }

    public function getPedidosEnPreparacion(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        //$ordenes = Order::all($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);
        $ordenes = Order::ordenesEnPreparacion();

        return ['datarows' => $ordenes];
    }

    public function getPedidosEnPreparacionSinGuia()
    {
        $ordenes = Order::ordenesEnPreparacionSinGuia();

        return ['pedidos' => $ordenes];
    }

    public function getPedidosGuia($id)
    {
        $ordenes = Order::ordenesGuia($id);

        return ['pedidosGuia' => $ordenes];
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $orden = Order::find($id);
        $cliente = Customer::join('orders', 'orders.customer_id', '=', 'customers.id')->where('orders.id', '=', $id)->first();
        $envio = ShippingInformation::select('shipping_address', 'shipping_information.price as price', 'area', 'municipios.name as municipio', 'departamentos.name as departamento')
                ->join('shipping_areas', 'shipping_areas.id', '=','shipping_information.shipping_area_id')
                ->join('departamentos', 'departamentos.id', '=', 'shipping_information.departamento')
                ->join('municipios', 'municipios.id', '=', 'shipping_information.municipio')
                ->where('order_id', '=', $id)->first();
        $detalle_orden = OrderItems::join('product_variants', 'product_variants.id', '=', 'order_items.variant_id')
                        ->join('products', 'products.id', '=', 'product_variants.product_id')
                        ->where('order_items.order_id', '=', $id)->get();
        return ['orden' => $orden, 'cliente' => $cliente, 'envio' => $envio, 'detalle_orden' => $detalle_orden];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
