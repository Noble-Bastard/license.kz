@extends('new.layouts.app')

@section('content')
    <service-category :initial-country-list="{{$countryList}}"></service-category>
@endsection


@section('js')
    <script>

    </script>
@endsection