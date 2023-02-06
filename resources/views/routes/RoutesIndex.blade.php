@extends('layouts.app')
@section('title', trans("lang.routes"))
@section('content')
<route-index
        tab_name={{$tab_name}}
        route_name={{$route_name}}
>
</route-index>
@endsection
