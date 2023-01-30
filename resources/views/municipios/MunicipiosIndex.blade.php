@inject('permission', 'App\Http\Controllers\API\PermissionController')

@extends('layouts.app')
@section('title', "Municipios")
@section('content')
<municipios-index
        tab_name={{$tab_name}}
        route_name={{$route_name}}
>
</municipios-index>
@endsection
