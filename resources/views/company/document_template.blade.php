@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <document-template-list
                :initial-document-template-type-list="{{$documentTemplateTypeList}}"
                :initial-country-list="{{$countryList}}">
        </document-template-list>
    </div>
@endsection