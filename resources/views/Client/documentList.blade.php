@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.layouts.personal_documents')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                @include('Client._serviceTypeSwitch', ['route' => route('profile.documentList')])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    {{dd($documentList)}}--}}
    @foreach($serviceJournalList as $serviceJournal)
        <div class="serviceDocument-group {{!$loop->last ? 'border-bottom pb-3' : ''}} {{ $loop->last ? 'mb-5': ''}}">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10">
                        <div class="h6 mt-3">@lang('messages.all.service_documents')
                            <strong>{{$serviceJournal->service_no}}</strong>
                        </div>
                        <div class="row">
                            @foreach($serviceJournal->clientDocumentList()->split(4) as $clientDocumentListChunk)
                                <div class="col-12 col-md-6 col-lg-3">
                                    @foreach($clientDocumentListChunk as $clientAttachedDocument)
                                        <a href="/storage_/{{$clientAttachedDocument->document->path}}" target="_blank" class="card serviceDocument-group-item mb-3">
                                            <div class="card-body">
                                                <div class="card-text">{{$clientAttachedDocument->description}}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection