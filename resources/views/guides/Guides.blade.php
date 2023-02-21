@inject('permission', 'App\Http\Controllers\API\PermissionController')

@extends('layouts.app')

@section('title', trans("lang.guides"))

@section('content')
<guides
        guides={{$permission->guidesManagePermission()}}
    departamentos={{$permission->departamentosManagePermission()}}
    municipios={{$permission->municipiosManagePermission()}}
    deliveries={{$permission->deliveriesManagePermission()}}
    puntos_entrega={{$permission->puntosEntregaManagePermission()}}
    routes={{$permission->routesManagePermission()}}
    tab_name={{$tab_name}}
    route_name={{$route_name}}
    >
</guides>
@endsection
