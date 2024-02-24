@extends('new.layouts.app')

@section('content')
    <head-accountant-service-journal-list
            :p-service-journal-list="{{$serviceJournalList}}"
            :p-service-statuses="{{$serviceStatuses}}">
    </head-accountant-service-journal-list>

@endsection

@section('js')

    <script>
        //activeTab('head-services');
    </script>
@endsection