@extends('new.layouts.app')

@section('content')
        <div class="row services-background">
            <div class="col-12">
                <div class="card">
                    <div class="title-main"> @lang('messages.all.service')

                    </div>
                    <div class="card-body">
                        <div class="col-12">
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
                                <div class="col-12">
                                    <div class="row">
                                        @include('Client._serviceJournalClientDataEdit')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('css')
    <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')}}"></script>

    <script>
        //activeTab('profile');

        $(function () {
            $(document).on('click', '.addAdditionalTableParam', function(e){
                var btn = $(this);

                var table = $('.' + btn.data("param"));
                $('thead .template-row', table).clone().removeClass().appendTo('tbody', table);
            })
        })
    </script>
@endsection