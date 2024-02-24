@extends('new.layouts.app')

@section('content')
@include('services._serviceCategoryPart')
@include('news._shortNewsPart')
@endsection


@section('js')
    <script>
        //activeTab('services');
    </script>
@endsection