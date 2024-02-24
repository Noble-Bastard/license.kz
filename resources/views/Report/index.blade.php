@extends('new.layouts.app')

@section('content')

    <head-dash-board :initial-country-list="{{$countryList}} " :initial-country-id="{{$countryId}} "  :initial-start-date="'{{$startDate}}'" :initial-end-date="'{{$endDate}}'"></head-dash-board>
@endsection


@section('js')
    <script>
        //activeTab('report-index');

    </script>
@endsection