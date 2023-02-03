<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class DepartamentoController extends Controller
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
        return view('departamentos.DepartamentosIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function getDepartamentos()
    {
        $departments = Departamento::all();
        return ['departments' => $departments];
    }

    public function getAllDepartamentos(Request $request)
    {
        if ($request->columnKey) $columnName = $request->columnKey;

        if ($request->rowLimit) $limit = $request->rowLimit;
        $requestType = $request->reqType;

        $department = Departamento::getDepartamento($columnName, $request->columnSortedBy, $limit, $request->rowOffset, $requestType);

        return ['datarows' => $department['data'], 'count' => $department['count']];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $departamentoData = [
            'name' => $request->name,
        ];

        if ($departamento = Departamento::store($departamentoData)) {
            $response = [
                'data' => $departamento,
                'message' => Lang::get('lang.departamento') . ' ' . Lang::get('lang.successfully_saved')
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
        return Departamento::getOne($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $departamento = Departamento::getOne($id);

        if ($departamento) {
            $departamento->name = $request->input('name');
            $departamento->save();
            $response = [
                'message' => Lang::get('lang.departamento') . ' ' . Lang::get('lang.successfully_updated')
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
        $used = Departamento::usedDepartamento($id);

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
        }
    }
}
