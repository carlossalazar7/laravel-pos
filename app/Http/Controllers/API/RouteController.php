<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class RouteController extends Controller
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
        return view('routes.RoutesIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getRoutes()
    {
        $routes = Route::all();
        return ['routes' => $routes];
    }

    public function getAllRoutes(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $route = Route::getRoute($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $route['data'], 'count' => $route['count']];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombreRuta' => 'required',
        ]);

        $routeData = [
            'name' => $request->nombreRuta,
        ];

        if ($route = Route::store($routeData)) {
            $response = [
                'data' => $route,
                'message' => Lang::get('lang.route') . ' ' . Lang::get('lang.successfully_saved')
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
        return Route::getOne($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombreRuta' => 'required',
        ]);

        $route = Route::getOne($id);

        if ($route) {
            $route->name = $request->input('nombreRuta');
            $route->save();
            $response = [
                'message' => Lang::get('lang.route') . ' ' . Lang::get('lang.successfully_updated')
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
        // TODO: validar rutas en uso
        Route::deleteData($id);
        $response = [
            'message' => Lang::get('lang.route') . ' ' . Lang::get('lang.successfully_deleted')
        ];

        return response()->json($response, 201);
    }
}
