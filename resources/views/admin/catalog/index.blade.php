@extends('new.layouts.app')

@section('content')
    <catalog :initial-country-list="{{ $countryList  }}" ref="catalog"></catalog>
@endsection


@section('js')
    <script>

    </script>
@endsection