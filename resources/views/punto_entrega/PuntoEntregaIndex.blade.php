@extends('layouts.app')
@section('title', trans("lang.puntos_entrega"))
@section('content')
<punto-entrega-index
        tab_name={{$tab_name}}
        route_name={{$route_name}}
>
</punto-entrega-index>
@endsection
