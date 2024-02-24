@extends('new.layouts.app')

@section('content')
    <counter-list :initial-country-list="{{$countryList}}"></counter-list>
@endsection


@section('js')
    <script>

    </script>
@endsection