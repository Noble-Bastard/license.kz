@extends('new.layouts.app')

@section('content')
    <client-accountant-service-journal-list
            :p-service-journal-list="{{$serviceJournalList}}"
            :p-service-statuses="{{$serviceStatuses}}">
    </client-accountant-service-journal-list>
@endsection

@section('js')

     <script>
        //activeTab('accounting');
    </script>
@endsection