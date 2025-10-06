@extends('layouts.client-app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="px-5 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Услуга УСЛ-{{ $serviceJournal->service_no }}</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $serviceJournal->service_name ?? 'Название услуги' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('Client.serviceList') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Назад к услугам
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="px-5 py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">


                        <div class="row profilServices">
                            <div class="col-md-2">
                                <div class="manager text-center">
                                    <a href="#" class="uploadphotomodalopen">
                                        @if($manager != null)
                                            @if($manager->photo_id != null)
                                                <img src="/storage_/{{$manager->photo_path}}" class="img-fluid"
                                                     alt="Responsive image">
                                            @else
                                                <img src="{{asset('images/nophoto.png')}}" class="img-fluid"
                                                     alt="Responsive image">
                                            @endif
                                            <div class="text-center">
                                                {{$manager->full_name}}
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col data-time">
                                        {{\App\Data\Helper\Assistant::formatDate($serviceJournal->create_date)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pb-3 servicesNumber">
                                        Услуга №{{$serviceJournal->service_no}} {{$serviceJournal->service_name}}
                                        <span class="padding-l-15 caret"><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row justify-content-center">
                                            <div class="col-12 services-hdr">
                                                <div class="btn-toolbar" role="toolbar">
                                                    <div class="btn-group mr-2" role="group">
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.creat')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::ClientCheck) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.services.statuses.client_check')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Prepayment) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.services.statuses.prepayment')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::DataCollection) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.data_collection')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.check')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Execution) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.service_stage')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Payment) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.payment')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Complete) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.all.complete')
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Rejected) ? 'btn-success' : 'btn-default'}}">
                                                            @lang('messages.services.statuses.rejected')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation)
                                                <div class="col-12 services-hdr">
                                                    <h5>@lang('messages.client.waiting_for_approve')</h5>
                                                </div>
                                            @elseif(($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Payment
                                                        || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Prepayment
                                                        || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::ClientCheck
                                                            && $serviceJournal->is_client_check_paid === 0
                                                       ))
                                                <div class="col-12 services-hdr">
                                                    <h5>@lang('messages.client.payment_required')</h5>
                                                </div>
{{--                                                <div class="col-12 services-body">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-12 btn-payment">--}}
{{--                                                            <form method="post" action="{{route('Client.serviceJournal.setPayment', ['servicesJournalId' => $serviceJournal->id])}}">--}}
{{--                                                                @csrf--}}
{{--                                                                <button type="submit" class="btn btn-default" >--}}
{{--                                                                    @lang('messages.all.pay')--}}
{{--                                                                </button>--}}
{{--                                                            </form>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            @elseif(($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::ClientCheck
                                                        && $serviceJournal->is_client_check_paid === 1))
                                                <div class="col-12 services-hdr">
                                                    <h5>@lang('messages.client.check_manager')</h5>
                                                </div>
                                            @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::DataCollection)
                                                @include('Client._serviceJournalClientDataShow')
                                                @include('Client._serviceJournalClientDocument')
                                            @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check)
                                                <div class="col-12 services-hdr">
                                                    <h5>@lang('messages.client.check_manager')</h5>
                                                </div>
                                                @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Manager)
                                                    || Auth::user()->isUserInRole(\App\Data\Helper\RoleList::SaleManager))
                                                    @include('Client._serviceJournalClientDataShow')
                                                    @include('Client._serviceJournalClientDocument')
                                                @endif
                                            @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Rejected)
                                                <div class="col-12 services-hdr">
                                                    <h5>{{$serviceJournal->reject_reason}}</h5>
                                                </div>
                                            @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Execution)
                                                <div class="col-12 services-hdr">
                                                    <h5>@lang('messages.client.stages_service')</h5>
                                                </div>

                                                <div class="col-12 services-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div id="chartdiv" style="height: 500px"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
          @include('news._shortNewsPart')
        @endif


    <div class="modal fade" id="managerInfoModal" tabindex="-1" role="dialog" aria-labelledby="managerInfoLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($manager != null)
                        <div class="row">
                            <div class="col-3">
                                @if($manager->photo_id !=null)
                                    <img src="/storage_/{{$manager->photo_path}}" class="img-fluid"
                                         alt="Responsive image">
                                @else
                                    <img src="{{asset('images/nophoto.png')}}" class="img-fluid"
                                         alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-9">
                                <h6>@lang('messages.client.lawyer')</h6>
                                <h5>{{$manager->full_name}}</h5>
                                <p class="text-justify">
                                    @lang('messages.client.help')
                                </p>
                                <div>@lang('messages.client.questions')</div>
                                <div>@lang('messages.all.phone') <a href="tel:+7 705 135 0000">+7 705 135 0000</a></div>
                                <div class="pt-3">@lang('messages.all.send') <a class="messageWindowLink"
                                                               href="{{route('Client.message.list', ['serviceJournalId' => $serviceJournal->id])}}"
                                                               target="_blank">@lang('messages.all.message')</a></div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 pt-3 text-justify">
                            <p>@lang('messages.client.dear_customer')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="messageModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>


    <div class="modal fade" id="uploadfiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.client.download_document')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-doc-content">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>



@endsection

@section('css')
    <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')}}"></script>

    <script src="{{asset('libs/amcharts/amcharts.js')}}"></script>
    <script src="{{asset('libs/amcharts/serial.js')}}"></script>
    <script src="{{asset('libs/amcharts/plugins/export/export.js')}}"></script>
    <script src="{{asset('libs/amcharts/gantt.js')}}"></script>
    <script src="{{asset('libs/amcharts/lang/ru.js')}}"></script>
    <script src="{{asset('libs/amcharts/themes/light.js')}}"></script>

    <script>
        //activeTab('profile');

        $(document).on('click', '.uploadFilesModalOpen', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: $(this).attr('href'),
                success: function (data) {
                    $('#uploadfiles .modal-doc-content').html(data);

                    // $("#uploadfiles .select2").select2({
                    //     minimumResultsForSearch: -1
                    // });

                    $('#uploadfiles').modal('show');
                }
            });
        });

        $(function () {



            $('.datepicker').datepicker({
                language: 'ru',
                format: 'dd.mm.yyyy',
                autoclose: true
            });

            $(document).on('click', '.manager', function () {
                $('#managerInfoModal').modal('show');
            });

            $(document).on('click', '.messageWindowLink', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: $(this).attr('href'),
                    success: function (data) {
                        $('#messageModal .modal-content').html(data);
                        $('#messageModal').modal('show');

                        var scrolToElm = $('.msg_container_base .message.unread').first();
                        if (scrolToElm.length === 0) {
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        $('.msg_container_base').scrollTo(scrolToElm);
                    }
                });
            });



            $(document).on('click', '#sendMessage', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('Client.service.message.create')}}',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'serviceJournalId': $(this).data('servicejournalid'),
                        'messageContent': $('#messageContent').val()
                    },
                    success: function (data) {
                        $('.msg_container_base')
                            .html(data)
                            .scrollTo($('.msg_container_base .message').last());

                        $('#messageContent')
                            .val('')
                            .focus();
                    }
                });
            });

            $(document).on('click', '.addAdditionalTableParam', function(e){
                var btn = $(this);

                var table = $('.' + btn.data("param"));
                $('thead .template-row', table).clone().removeClass().appendTo('tbody', table);
            })

            var chart = AmCharts.makeChart( "chartdiv", {
                "type": "gantt",
                "theme": "light",
                "marginRight": 70,
                "period": "DD",
                "dataDateFormat": "YYYY-MM-DD HH:mm",
                "columnWidth": 0.5,
                "valueAxis": {
                    "type": "date"
                },
                "brightnessStep": 7,
                "graph": {
                    "lineAlpha": 1,
                    "lineColor": "#fff",
                    "fillAlphas": 0.85,
                    "balloonText": "<b>[[task]]</b>:<br />[[open]] -- [[value]]"
                },
                "rotate": true,
                "categoryField": "category",
                "segmentsField": "segments",
                "colorField": "color",
                "startDateField": "start",
                "endDateField": "end",

                "dataProvider": [

                    @foreach($serviceJournalStepList as $serviceJournalStep)
                    {
                        "category": "{{$serviceJournalStep->service_step_no}}",
                        "segments": [
                            {
                                "start": "{{$serviceJournalStep->execution_start_date}}",
                                "end": "{{$serviceJournalStep->completion_date}}",
                                "task": "{{$serviceJournalStep->service_step_description}}"
                            },
                             ]
                    },
                    @endforeach ],
                "valueScrollbar": {
                    "autoGridCount": true
                },
                "chartCursor": {
                    "cursorColor": "#55bb76",
                    "valueBalloonsEnabled": false,
                    "cursorAlpha": 0,
                    "valueLineAlpha": 0.5,
                    "valueLineBalloonEnabled": true,
                    "valueLineEnabled": true,
                    "zoomable": false,
                    "valueZoomable": true
                },
                "export": {
                    "enabled": false
                }
            } );


        })
    </script>
@endsection
