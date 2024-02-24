@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.pages.services.request')
                </h1>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <form method="post" id="serviceOrderForm" class="form-horizontal"
                              action="{{route('Client.services.order')}}">
                            @csrf
                            <input type="hidden" name="serviceIdList" value="{{$serviceList}}">
                            <input type="hidden" name="selectedCity" value="{{$selectedCity}}">
                            <input type="hidden" name="paymentTypeId" value="{{\App\Data\Helper\PaymentTypeList::TransferPaymentType}}">
                            <div class="profile-info">
                                @include('_legalProfileCard',["isNewProfile" => false, 'autoFocus' => false, "profileLegal" => $profileLegal])
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="pl-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="provideCompanyInfoLater" name="provideCompanyInfoLater">
                                            <label class="custom-control-label" for="provideCompanyInfoLater">
                                                @lang('messages.all.provide-company-info-later')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit"
                                            class="btn btn-success btnOrderService">{{trans('messages.services.order')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderComplete" tabindex="-1" role="dialog"
         aria-labelledby="modalOrderCompleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{trans('messages.services.order_complete_bill')}}
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-success orderComplete_close">{{trans('messages.all.close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#serviceOrderForm").submit(function (event) {
                $(this).ajaxSubmit({
                    success: function () {
                        gtag('event', 'send', {'event_category': 'lead'});
                        $('#orderComplete').modal('show');
                    }
                });

                return false;
            });

            $(document).on('click', '.orderComplete_close', function(){
                window.location = '{{route('Client.service.list')}}';
            });
        })
    </script>
@endsection