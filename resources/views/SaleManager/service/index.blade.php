@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.sale_manager.list_services')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row pb-3">
                                <div class="col-12 text-center">
                                    <div class="btn-group btn-group-sm btn-group-toggle btn-success-toggle ">
                                        @foreach($statusList as $status)
                                            <a class="btn btn-success {{$service_status_id == $status->id ? 'active' : ''}}"
                                               href="{{route('sale_manager.service.list_by_status', ['service_status_id' => $status->id])}}">{{$status->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <table id="services" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.sale_manager.number')</th>
{{--                                    <th class="w-30">@lang('messages.all.name')</th>--}}
                                    <th>@lang('messages.sale_manager.request_date')</th>
                                    <th class="text-center">@lang('messages.sale_manager.client')</th>
                                    <th class="text-center">@lang('messages.all.manager')</th>
{{--                                    <th class="w-10 text-center">@lang('messages.accountant.is_client_check_paid')</th>--}}
                                    <th class="text-center">@lang('messages.accountant.is_prepayment_paid')</th>
                                    <th class="text-center">@lang('messages.accountant.is_final_paid')</th>
                                    <th class="text-center">@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                {{dd($serviceJournalList)}}--}}
                                @foreach($serviceJournalList as $serviceJournal)
                                    <tr>
                                        {{--                                    <td>{{$serviceJournal->service_no }}</td>--}}
                                        <td>
                                            <a href="{{route('sale_manager.serviceJournal.show', ["servicesJournalId" => $serviceJournal->id])}}">{{$serviceJournal->service_no }}</a>
                                        </td>
{{--                                        <td>{{$serviceJournal->service_name }}</td>--}}
                                        <td>{{\App\Data\Helper\Assistant::formatDate($serviceJournal->create_date) }}</td>
                                        <td class="text-center">{{$serviceJournal->client_full_name}}</td>
                                        <td class="text-center">{{$serviceJournal->manager_full_name }}</td>
{{--                                        <td class="text-center">{{($serviceJournal->is_client_check_paid  === 1) ? trans('messages.all.yes') : trans('messages.all.no')}}</td>--}}
                                        <td class="text-center">{{($serviceJournal->is_prepayment_paid  === 1) ? trans('messages.all.yes') : trans('messages.all.no')}}</td>
                                        <td class="text-center">{{($serviceJournal->is_final_paid  === 1) ? trans('messages.all.yes') : trans('messages.all.no')}}</td>
                                        <td class="text-center">
                                            @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation ||
                                                $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Payment ||
                                                $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check
                                            )
                                                <div class="dropdown">
                                                    @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation
                                                            || $serviceJournal->is_profile_legal_exist == 0)
                                                        {{--                                                || $serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check)--}}
                                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="fa fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation
                                                                && $serviceJournal->is_profile_legal_exist == 1)
                                                                <a class="dropdown-item setManager"
                                                                   data-servicename="{{$serviceJournal->service_name}}"
                                                                   data-serviceno="{{$serviceJournal->service_no}}"
                                                                   data-clientname="{{$serviceJournal->client_full_name}}"
                                                                   data-servicejournalid="{{$serviceJournal->id }}"
                                                                   data-managerid="{{$serviceJournal->manager_id }}"
                                                                   href="#">@lang('messages.sale_manager.assign_manager')</a>
                                                                {{--                                                    @elseif($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check)--}}
                                                                {{--                                                        <a class="dropdown-item setInWork"--}}
                                                                {{--                                                           href="{{route('sale_manager.service.setInWork', ['serviceJournal' => $serviceJournal->id])}}">@lang('messages.sale_manager.send_to_work')</a>--}}
                                                            @endif

                                                            @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Creation
                                                                    && $serviceJournal->is_profile_legal_exist == 0)
                                                                <a class="dropdown-item setProfileLegalInfo"
                                                                   data-servicename="{{$serviceJournal->service_name}}"
                                                                   data-serviceno="{{$serviceJournal->service_no}}"
                                                                   data-servicejournalid="{{$serviceJournal->id }}"
                                                                   href="#">@lang('messages.all.legalProfileInfo')</a>
                                                            @endif

                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $serviceJournalList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="setManagerModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['url' => route('sale_manager.service.setManager'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <input name="serviceJournalId" class="serviceJournalId" type="hidden" value=""/>
                <div class="modal-header">
                    <h5 class="service-name"></h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <label class="col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label">@lang('messages.sale_manager.client') </label>
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3"><span
                                    class="service-client"></span></div>
                    </div>
                    <div class="form-row">
                        {!! Form::label('manager', trans('messages.all.manager'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('manager', $managerList, null, array_merge(['placeholder' => '', 'class' => $errors->has('manager') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('manager'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('manager') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                  <div class="form-row">
                    {!! Form::label('prepayment_percent', trans('messages.manager.prepayment_percent'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                    <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                      {!! Form::text('prepayment_percent', '0', array_merge(['class' => $errors->has('prepayment_percent') ? 'form-control is-invalid' : 'form-control'])) !!}
                      @if ($errors->has('prepayment_percent'))
                        <span class="help-block invalid-feedback">
                          <strong>{{ $errors->first('prepayment_percent') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success']) !!}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="setProfileLegalInfoModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="post" id="setProfileLegalInfoForm" class="form-horizontal"
                      action="{{route('sale_manager.service.setProfileLegalInfo')}}">
                    <input name="serviceJournalId" class="serviceJournalId" type="hidden" value=""/>
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('messages.all.legalProfileInfo')}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="profile-info">
                            @include('_legalProfileCard',["isNewProfile" => false, 'autoFocus' => false, "profileLegal" => new \App\Data\Core\Model\ProfileLegal()])
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{trans('messages.all.cancel')}}</button>
                        <button type="submit" class="btn btn-success">{{trans('messages.all.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('js')
    <script>
        var emptySetProfileLegalInfoModalBody = $('.modal-body .profile-info', '#setProfileLegalInfoModal').html();

        $(function () {
            $(document).on('click', '.setManager', function () {
                var modal = '#setManagerModal';
                $('#setManagerModal .service-name').html($(this).data('serviceno'));
                $('#setManagerModal .service-client').html($(this).data('clientname'));
                $('#setManagerModal .serviceJournalId').val($(this).data('servicejournalid'));
                $('select#manager', modal).val($(this).data('managerid'));

                $('#setManagerModal').modal('show');
            });

            $(document).on('click', '.setProfileLegalInfo', function () {
                var modal = '#setProfileLegalInfoModal';
                $('.modal-body .profile-info', modal).html(emptySetProfileLegalInfoModalBody);
                $('.serviceJournalId', modal).val($(this).data('servicejournalid'));
                $('#setProfileLegalInfoModal').modal('show');
            });

            $("#setProfileLegalInfoForm").submit(function (event) {
                event.preventDefault();

                var form = $('#setProfileLegalInfoForm')[0];
                var formData = new FormData(form);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: '{{route('sale_manager.service.setProfileLegalInfo')}}',
                    data: formData,
                    success: function (result) {
                        if (result.serviceJournalId) {
                            $('#setProfileLegalInfoModal').modal('hide');
                            location.reload();
                        } else
                            $('.modal-body .profile-info', '#setProfileLegalInfoModal').html(result);
                    }
                })
                    .fail(function (jqXHR, textStatus) {
                        if (jqXHR.status === 401)
                            window.location = '{{route('login')}}';
                        else {
                            var responseText = $.parseJSON(jqXHR.responseText);
                            window.Vue.notify({
                                group: 'all',
                                position: 'top right',
                                title: '',
                                text: responseText.message,
                                type: 'error'
                            });
                        }
                    });
            });
        });
    </script>
@endsection
