<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class MunicipioController extends Controller
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
        return view('municipios.MunicipiosIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getMunicipios()
    {
        $municipios = Municipio::all();
        return ['municipios' => $municipios];
    }

    public function getAllMunicipios(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $municipios = Municipio::getMunicipios($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $municipios['data'], 'count' => $municipios['count']];
    }

    public function getMunicipiosByDepId($id)
    {
        $municipios = DB::select("SELECT * FROM municipios WHERE department_id = ? ORDER BY name ASC", [$id]);
        return ['municipios' => $municipios];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'departamento' => 'required',
        ]);

        $municipioData = [
            'name' => $request->name,
            'department_id' => $request->departamento,
        ];

        if ($municipio = Municipio::store($municipioData)) {
            $response = [
                'data' => $municipio,
                'message' => Lang::get('lang.municipio') . ' ' . Lang::get('lang.successfully_saved')
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
        return Municipio::getOne($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'departamento' => 'required',
        ]);

        $municipio = Municipio::getOne($id);

        if ($municipio) {
            $municipio->name = $request->input('name');
            $municipio->department_id = $request->input('departamento');
            $municipio->save();
            $response = [
                'message' => Lang::get('lang.municipio') . ' ' . Lang::get('lang.successfully_updated')
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
        $used = Municipio::usedMunicipio($id);

        if ($used == 0) {
            Municipio::deleteData($id);
            $response = [
                'message' => Lang::get('lang.municipio') . ' ' . Lang::get('lang.successfully_deleted')
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                'message' => Lang::get('lang.municipio') . ' ' . Lang::get('lang.in_use') . ', ' . Lang::get('lang.you_can_not_delete_the') . ' ' . strtolower(Lang::get('lang.municipio'))
            ];

            return response()->json($response, 200);
        }
    }
}
