@inject('permission', 'App\Http\Controllers\API\PermissionController')
@extends('layouts.app')
@section('title', "Register info")
@section('content')
<register-info-index
        done={{$permission->ordenesManagePermission()}}
    preparacion={{$permission->ordenesManagePermission()}}
    departamentos={{$permission->departamentosManagePermission()}}
    tab_name={{$tab_name}}
    route_name={{$route_name}}
    >
</register-info-index>
@endsection
