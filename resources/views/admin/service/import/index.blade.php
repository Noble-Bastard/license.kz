@extends('new.layouts.app')

@section('content')
    <service-import :initial-country-list="{{ $countryList  }}" :initial-country-id="{{ $countryList->first()->id }}"></service-import>
@endsection


@section('js')
    <script>
    </script>
@endsection