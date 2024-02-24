@extends('new.layouts.app')

@section('content')
    <service-additional-requirements
        :p-license-type-list="{{$licenseTypeList}}"
        :p-service-additional-requirements-type-list="{{$serviceAdditionalRequirementsTypeList}}"
    ></service-additional-requirements>
@endsection


@section('js')
    <script>

    </script>
@endsection