@inject('permission', 'App\Http\Controllers\API\PermissionController')

@extends('layouts.app')
@section('title', trans("lang.pedidoEP"))
@section('content')
<pedidos-index
        tab_name={{$tab_name}}
        route_name={{$route_name}}
>
</pedidos-index>
@endsection
