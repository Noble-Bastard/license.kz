@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <service-card
                :initial-entity-id="{{$entityId}}"
                :initial-service-category-id="{{$serviceCategoryId}}"
                :initial-service-thematic-group-id="{{$serviceThematicGroupId}}"
                :initial-registration-form-template-list="{{$registrationFormTemplateList}}"
                serviceCategory
        ></service-card>
    </div>
@endsection