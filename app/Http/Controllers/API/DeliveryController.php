<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class DeliveryController extends Controller
{

    public function index()
    {
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('deliveries.DeliveriesIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getAllDeliveries(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $delivery = Delivery::getDelivery($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $delivery['data'], 'count' => $delivery['count']];
    }

    public function getDeliveries()
    {
        $deliveries = Delivery::all();
        return ['deliveries' => $deliveries];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre_delivery' => 'required',
            'delivery_phone' => 'required',
            'delivery_type' => 'required',
        ]);

        $deliveryData = [
            'nombre' => $request->nombre_delivery,
            'tipo' => $request->delivery_type,
            'telefono' => $request->delivery_phone,
            'correo' => $request->delivery_mail,
        ];

        if ($delivery = Delivery::store($deliveryData)) {
            $response = [
                'data' => $delivery,
                'message' => Lang::get('lang.delivery') . ' ' . Lang::get('lang.successfully_saved')
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        }
    }

    public function show($id)
    {
        return Delivery::getOne($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre_delivery' => 'required',
            'delivery_phone' => 'required',
            'delivery_type' => 'required',
        ]);

        $delivery = Delivery::getOne($id);
        if ($delivery) {
            $delivery->nombre = $request->input('nombre_delivery');
            $delivery->tipo = $request->input('delivery_type');
            $delivery->telefono = $request->input('delivery_phone');
            $delivery->correo = $request->input('delivery_mail');
            $delivery->save();
            $response = [
                'message' => Lang::get('lang.delivery') . ' ' . Lang::get('lang.successfully_updated')
            ];

            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        }
    }

    public function destroy($id)
    {
        $delivery = Delivery::getOne($id);
        if($delivery){
            $delivery->status = "inactive";
            $delivery->save();
            $response = [
                'message' => Lang::get('lang.delivery') . ' ' . Lang::get('lang.successfully_deleted')
            ];

            return response()->json($response, 201);
        }else{
            $response = [
                'message' => Lang::get('lang.getting_problems')
            ];

            return response()->json($response, 404);
        }
    }
}
