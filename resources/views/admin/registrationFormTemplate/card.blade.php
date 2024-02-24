@extends('new.layouts.app')

@section('content')
    <registration-form-template-card
            :initial-registration-form-template="{{$registrationFormTemplate}}"
            :initial-optionset-type-list="{{$optionsetTypeList}}"
            :initial-parameter-type-list="{{$parameterTypeList}}">>
    </registration-form-template-card>
@endsection


@section('js')
    <script>
    </script>
@endsection