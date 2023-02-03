@extends('layouts.app')
@section('title', trans("lang.deliveries"))
@section('content')
<delivery-index
    tab_name={{$tab_name}}
    route_name={{$route_name}}
>
</delivery-index>
@endsection
