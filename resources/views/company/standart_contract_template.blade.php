@extends('new.layouts.app')

@section('content')
    <standart-contract-template-list
            :initial-standart-contract-template-type-list="{{$standartContractTemplateTypeList}}"
            :initial-country-list="{{$countryList}}">
    </standart-contract-template-list>

@endsection

@section('js')
    <script>
        //activeTab('standart-contract-template');
    </script>
@endsection