@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.layouts.personal_services')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-11">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                @include('Client._serviceTypeSwitch', ['route' => route('Client.service.list')])
                            </div>
                            <div class="col-12 col-md-6  mb-3 text-center text-md-right">
                                @include('components.messageManagerClientBtn', ['messageCnt' => $messageCnt])
                            </div>
                        </div>
                        <div class="row d-none d-sm-flex">
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.all.name')</div>
                            </div>
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.all.manager')</div>
                            </div>
                            <div class="col-2">
                                <div class="descriptionPanel-label">@lang('messages.all.status')</div>
                            </div>
                            <div class="col-6"></div>
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
                                                    <div class="col-12 col-md-2 myService-group_title align-self-center text-center text-md-left">
                                                        <div class="myService-group_label d-block d-sm-none">@lang('messages.all.name')</div>
                                                        <span class="align-text-top">{{$serviceJournal->service_no}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-2 align-self-center text-center text-md-left">
                                                        <div class="myService-group_label d-block d-sm-none">@lang('messages.all.manager')</div>
                                                        <span class="align-text-top">{{$serviceJournal->manager_full_name ?? trans('messages.pages.services.not_assigned')}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-2 align-self-center text-center text-md-left">
                                                        <div class="myService-group_label d-block d-sm-none">@lang('messages.all.status')</div>
                                                        <span class="align-text-top">{{$serviceJournal->service_status_name}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 myService-group_description align-self-center text-center text-md-left">
                                                        @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation)
                                                            <span class="text-success align-text-top">@lang('messages.client.waiting_for_approve')</span>
                                                        @elseif(($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Payment
                                                                    || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Prepayment
                                                                    || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::SendBill
                                                                        && $serviceJournal->is_client_check_paid === 0
                                                                   ))
                                                            <span class="text-danger align-text-top text-center text-md-left">@lang('messages.client.payment_required')</span>
                                                        @elseif(($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::ClientCheck))
                                                            <span class="text-success align-text-top">@lang('messages.client.check_manager')</span>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::DataCollection)
                                                            <div class="row">
                                                                <div class="col-12 col-md-8 text-center text-md-left">
                                                                    <span class="text-danger align-text-top">@lang('messages.client.data_collection')</span>
                                                                </div>
                                                                <div class="col-12 col-md-4 text-center text-md-right ">
                                                                    <button class="btn btn-success btn-sm"
                                                                            data-toggle="collapse"
                                                                            data-target="#myService-group-{{$serviceJournal->id}}"
                                                                            aria-expanded="false"
                                                                            aria-controls="myService-group-{{$serviceJournal->id}}"
                                                                            data-text="@lang('messages.all.collapse')"
                                                                    >@lang('messages.all.attach')</button>
                                                                </div>
                                                            </div>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check)
                                                            <span class="text-success">@lang('messages.client.check_manager')</span>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Rejected)
                                                            <div class="row">
                                                                <div class="col-12 col-md-8 text-center text-md-left">
                                                                    <span class="text-danger align-text-top">@lang('messages.client.service_reject')</span>
                                                                </div>
                                                                <div class="col-12 col-md-4 text-center text-md-right ">
                                                                    <button class="btn btn-success btn-sm float-right"
                                                                            data-toggle="collapse"
                                                                            data-target="#myService-group-{{$serviceJournal->id}}"
                                                                            aria-expanded="false"
                                                                            aria-controls="myService-group-{{$serviceJournal->id}}"
                                                                            data-text="@lang('messages.all.collapse')"
                                                                    >@lang('messages.all.details')</button>
                                                                </div>
                                                            </div>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Execution)
                                                            <div class="row no-gutters">
                                                                <div class="col-12 col-md-3 mb-3 mb-md-0 align-self-center text-success text-center text-md-left">
                                                                 <span class="align-text-top">{{$serviceJournal->serviceStepList->where('is_completed', 1)->count()}}
                                                                     {{ \App\Data\Helper\Assistant::num2word($serviceJournal->serviceStepList->where('is_completed', 1)->count(),  trans('messages.pages.services.one_step'),  trans('messages.pages.services.two_work_step'),  trans('messages.pages.services.work_step') )}} из {{$serviceJournal->serviceStepList->count()}}</span>
                                                                </div>
                                                                <div class="col-12 col-md-6 mb-3 mb-md-0 align-self-center">
                                                                    @php
                                                                        $prevIsComplite = 1;
                                                                    @endphp
                                                                    @foreach($serviceJournal->serviceStepList->chunk(6) as $serviceStepChunk)
                                                                        <div class="row no-gutters">
                                                                            @foreach($serviceStepChunk as $serviceStep)
                                                                                <div class="col myService-group_description--stepgraphic">
                                                                                    @if($serviceStep->is_completed === 1)
                                                                                        <img class="img-fluid"
                                                                                             src="{{asset('images/complete_step.svg')}}"/>
                                                                                    @elseif($prevIsComplite === 1)
                                                                                        <img class="img-fluid"
                                                                                             src="{{asset('images/in_work_step.svg')}}"/>
                                                                                    @else
                                                                                        <img class="img-fluid"
                                                                                             src="{{asset('images/uncomplete_step.svg')}}"/>
                                                                                    @endif
                                                                                </div>
                                                                                @php
                                                                                    $prevIsComplite = $serviceStep->is_completed;
                                                                                @endphp
                                                                            @endforeach

                                                                            @if($loop->last && $loop->count > 1)
                                                                                @if($serviceStepChunk->count() < 6)
                                                                                    @for($i=0; $i < 6 - $serviceStepChunk->count(); $i++)
                                                                                        <div class="col"></div>
                                                                                    @endfor
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <div class="col-12 col-md-3 text-center text-md-right">
                                                                    <button class="btn btn-success btn-sm"
                                                                            data-toggle="collapse"
                                                                            data-target="#myService-group-{{$serviceJournal->id}}"
                                                                            aria-expanded="false"
                                                                            aria-controls="myService-group-{{$serviceJournal->id}}"
                                                                            data-text="@lang('messages.all.collapse')"
                                                                    >@lang('messages.all.details')</button>
                                                                </div>
                                                            </div>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Complete)
                                                            <span class="text-success align-text-top">@lang('messages.client.service_complete')</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::DataCollection
                                            || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Rejected
                                            || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Execution)
                                            <div id="myService-group-{{$serviceJournal->id}}"
                                                 class="myService-group_body collapse pt-3 pb-3 ps-3 pe-3"
                                                 aria-labelledby="myService-group-heading-{{$serviceJournal->id}}"
                                                 data-parent="#accordion-myService-{{$serviceJournal->id}}"
                                            >
                                                <div class="col-12">
                                                    <div class="row serviceJournal_{{$serviceJournal->id}}">
                                                        @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Rejected)
                                                            <div class="col-12">
                                                                {{$serviceJournal->reject_reason}}
                                                            </div>
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::DataCollection)
                                                            @include('Client._serviceJournalClientDocument')
                                                        @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Execution)
                                                            @include('Client._executionStepInfo')
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadfiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.client.download_document')</h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body modal-doc-content">
                    <form class="form-horizontal" method="post" action="{{route('Client.StepDocument.add')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" id="serviceStepId" name="serviceStepId" value=""/>
                        <input type="hidden" id="serviceJournalId" name="serviceJournalId" value=""/>
                        <input type="hidden" id="documentId" name="documentId" value=""/>
                        <input type="hidden" id="documentName" name="docName" value=""/>
                        <div class="form-row pb-3" id="docName">
                        </div>
                        <div class="form-row">
                            <label for="doc"
                                   class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.client.path')</label>
                            <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3">
                                <input type="file" name="doc"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-sm-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    @lang('messages.client.upload')
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.accordion').on('show.bs.collapse', function () {
                let btn = $('.myService-group_description button', this)
                    .removeClass('btn-success')
                    .addClass('btn-default');
                let text = btn.data('text');
                btn.data('text', btn.html()).html(text);

                return true;
            });
            $('.accordion').on('hidden.bs.collapse', function () {
                let btn = $('.myService-group_description button', this)
                    .removeClass('btn-default')
                    .addClass('btn-success')
                let text = btn.data('text');
                btn.data('text', btn.html()).html(text);

                return true;
            });

            $(document).on('click', '.uploadFilesModalOpen', function (e) {
                let modal = $('#uploadfiles');

                $('#serviceStepId', modal).val($(this).data('step_id'));
                $('#serviceJournalId', modal).val($(this).data('journal_id'));
                $('#documentId', modal).val($(this).data('document_id'));
                $('#documentName', modal).val($(this).data('document_name'));

                $('#docName', modal).html($(this).data('document_name'));

                modal.modal('show');
            });

            $('#uploadfiles form').submit(function () {
                let journalId = $('#serviceJournalId', this).val()

                $(this).ajaxSubmit({
                    success: function (data) {
                        $('.serviceJournal_' + journalId).html(data);
                        $('#uploadfiles form')[0].reset();
                        $('#uploadfiles').modal('hide');
                    }
                });

                return false;
            });
            $(document).on('click', '.detachClientDocument', function (e) {
                let journalId = $(this).data('journal_id')

                $.ajax({
                    type: 'GET',
                    url: $(this).data('href'),
                    success: function (data) {
                        $('.serviceJournal_' + journalId).html(data);
                    }
                });
            });
        })
    </script>
@endsection
