@extends('new.layouts.app')

@section('content')
    <city-list :initial-country-list="{{ $countryList  }}"></city-list>
@endsection


@section('js')
    <script>

    </script>
@endsection