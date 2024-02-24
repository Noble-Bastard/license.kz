@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.client.bookkeeping')
                </h1>
                <div class="row mb-5 justify-content-center align-items-center">
                    <div class="col-12 col-md-11">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                @include('Client._serviceTypeSwitch', ['route' => route('profile.bookkeeping')])
                            </div>
                        </div>
                        <div class="row d-none d-sm-flex">
                            <div class="col-5">
                                <div class="descriptionPanel-label">@lang('messages.all.name')</div>
                            </div>
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.all.cost')</div>
                            </div>
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.admin.service.service_step.tax')</div>
                            </div>
{{--                            <div class="col-2">--}}
{{--                                <div class="descriptionPanel-label">@lang('messages.accountant.is_client_check_paid')</div>--}}
{{--                            </div>--}}
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.accountant.is_final_paid')</div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($serviceJournalList as $serviceJournal)
                                <div class="col-12">
                                    <div class="accordion myService-group mb-3"
                                     id="accordion-myService-{{$serviceJournal->id}}">

                                    <div class="myService-group_header pt-2 pb-2"
                                         id="myService-group-heading-{{$serviceJournal->id}}">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-5 myService-group_title align-self-center text-center text-md-left">
                                                    <div class="myService-group_label d-block d-sm-none">@lang('messages.all.name')</div>
                                                    <span class="align-text-top">{{$serviceJournal->service_no}}</span>
                                                </div>
                                                <div class="col-12 col-md-2 align-self-center text-center text-md-left">
                                                    <div class="myService-group_label d-block d-sm-none">@lang('messages.all.cost')</div>
                                                    <span class="align-text-top">{{number_format($serviceJournal->amount, 2, ',', ' ')}} {{$serviceJournal->payment->currency->name}}</span>
                                                </div>
                                                <div class="col-12 col-md-2 align-self-center text-center text-md-left">
                                                    <div class="myService-group_label d-block d-sm-none">@lang('messages.admin.service.service_step.tax')</div>
                                                    <span class="align-text-top">{{number_format($serviceJournal->tax, 2, ',', ' ')}} {{$serviceJournal->payment->currency->name}}</span>
                                                </div>

{{--                                                <div class="col-12 col-md-2 align-self-center text-center text-md-left">--}}
{{--                                                    <div class="myService-group_label d-block d-sm-none">@lang('messages.accountant.is_client_check_paid')</div>--}}
{{--                                                    <span class="align-text-top">{{$serviceJournal->client_check_amount}}</span>--}}
{{--                                                </div>--}}
                                                <div class="col-12 col-md-2 align-self-center text-center text-md-left">
                                                    <div class="myService-group_label d-block d-sm-none">@lang('messages.accountant.is_final_paid')</div>
                                                    <span class="align-text-top">{{number_format($serviceJournal->amount + $serviceJournal->tax /*+ $serviceJournal->client_check_amount*/, 2, ',', ' ')}} {{$serviceJournal->payment->currency->name}}</span>
                                                </div>
                                                <div class="col-12 col-md-1 text-center text-md-right">
                                                    <button class="btn btn-success btn-sm"
                                                            data-toggle="collapse"
                                                            data-target="#myService-group-{{$serviceJournal->id}}"
                                                            aria-expanded="false"
                                                            aria-controls="myService-group-{{$serviceJournal->id}}"
                                                    >
                                                        <i class="fal fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="myService-group-{{$serviceJournal->id}}"
                                         class="myService-group_body collapse pt-3 pb-3"
                                         aria-labelledby="myService-group-heading-{{$serviceJournal->id}}"
                                         data-parent="#accordion-myService-{{$serviceJournal->id}}"
                                    >
                                        <div class="col-12">
                                            @foreach($serviceJournal->documentList() as $key => $itemList)
                                                <div class="row {{!$loop->last ? 'mb-3' : ''}}">
                                                    <div class="col-12">
                                                        <h5>{{$key}}</h5>
                                                    </div>
                                                    @foreach($itemList as $item)
                                                        <div class="col-12">
                                                            <div class="row {{!$loop->last ? 'mb-3' : ''}}">
                                                                <div class="col col-md-2">
                                                                    <span>{{$item->doc_no}}</span>
                                                                </div>
                                                                <div class="col col-md-10">
                                                                    @foreach($item->documents as $documents)
                                                                        <div class="row">
                                                                            <div class="col col-md-4">
                                                                                <span>{{$documents->documentType}}</span>
                                                                            </div>
                                                                            <div class="col col-md-4">
                                                                                <a href="/storage_/{{$documents->path}}"
                                                                                   target="_blank"
                                                                                   class="btn btn-success btn-sm">
                                                                                    @lang('messages.all.downloadFile')
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection