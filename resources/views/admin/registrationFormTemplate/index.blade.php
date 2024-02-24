@extends('new.layouts.app')

@section('content')
    <registration-form-template-list :initial-counter-type-list="{{$counterTypeList}}"></registration-form-template-list>
@endsection


@section('js')
    <script>
    </script>
@endsection