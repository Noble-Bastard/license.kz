@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <accountant-service-journal-list
                :p-service-journal-list="{{$serviceJournalList}}"
                :p-service-statuses="{{$serviceStatuses}}">
        </accountant-service-journal-list>
    </div>
@endsection