<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PuntoEntrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class PuntoEntregaController extends Controller
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
        return view('punto_entrega.PuntoEntregaIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getPuntosEntrega()
    {
        $puntosEntrega = PuntoEntrega::all();
        return ['puntos_entrega' => $puntosEntrega];
    }

    public function getAllPuntosEntrega(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $puntosEntrega = PuntoEntrega::getPuntosEntrega($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $puntosEntrega['data'], 'count' => $puntosEntrega['count']];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'municipio' => 'required',
        ]);

        $puntoEntregaData = [
            'name' => $request->name,
            'municipio_id' => $request->municipio,
        ];

        if ($punto_entrega = PuntoEntrega::store($puntoEntregaData)) {
            $response = [
                'data' => $punto_entrega,
                'message' => Lang::get('lang.punto_entrega') . ' ' . Lang::get('lang.successfully_saved')
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
        return PuntoEntrega::getOne($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'municipio' => 'required',
        ]);

        $punto_entrega = PuntoEntrega::getOne($id);

        if ($punto_entrega) {
            $punto_entrega->name = $request->input('name');
            $punto_entrega->municipio_id = $request->input('municipio');
            $punto_entrega->save();
            $response = [
                'message' => Lang::get('lang.punto_entrega') . ' ' . Lang::get('lang.successfully_updated')
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
        //TODO: Agregar validacion de no eliminar si esta en uso
        PuntoEntrega::deleteData($id);
        $response = [
            'message' => Lang::get('lang.punto_entrega') . ' ' . Lang::get('lang.successfully_deleted')
        ];
        return response()->json($response, 201);
    }
}
