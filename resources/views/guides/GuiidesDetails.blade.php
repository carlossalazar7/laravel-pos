@extends('layouts.app')

@section('title', trans("lang.guides_details"))

@section('content')
<guides-details :guide="{{ $guideDetails }}"
                tab_name="{{$tab_name}}"
                route_name="{{$route_name}}">
</guides-details>
@endsection
