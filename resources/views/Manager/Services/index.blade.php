@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <manager-service-journal-list
                :p-service-journal-list="{{ $serviceJournalList }}"
                :p-project-statuses="{{ $statusList }}">
        </manager-service-journal-list>
    </div>
@endsection





