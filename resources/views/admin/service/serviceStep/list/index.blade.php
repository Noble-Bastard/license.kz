@extends('new.layouts.app')

@section('content')
    <service-step-list :p-license-types="{{ $licenseTypes  }}"></service-step-list>
@endsection


@section('js')
    <script>
        $(function() {

        });
    </script>
@endsection