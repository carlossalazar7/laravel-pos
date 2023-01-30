@inject('permission', 'App\Http\Controllers\API\PermissionController')

@extends('layouts.app')
@section('title', "Departamentos")
@section('content')
<departments-index
        tab_name={{$tab_name}}
        route_name={{$route_name}}
>
</departments-index>
@endsection
