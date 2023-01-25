@extends('layouts.app')

@section('title', "Guias")

@section('content')
@inject('permission', 'App\Http\Controllers\API\PermissionController')
<guides-index
    tab_name={{$tab_name}}
    route_name={{$route_name}}
    >
</guides-index>
@endsection
