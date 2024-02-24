@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <service-list :initial-country-list="{{ $countryList  }}" :initial-country-id="{{ $countryList->first()->id }}"></service-list>
    </div>
@endsection