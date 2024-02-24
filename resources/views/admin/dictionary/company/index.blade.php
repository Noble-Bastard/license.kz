@extends('new.layouts.app')

@section('content')
    <company-profile-address-list :initial-country-list="{{ $countryList  }}"></company-profile-address-list>
@endsection


@section('js')
    <script>

    </script>
@endsection