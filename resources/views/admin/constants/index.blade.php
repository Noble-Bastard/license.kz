@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.admin.systemConstant.system_constant')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table id="constants" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.admin.systemConstant.constant_name')</th>
                                    <th>@lang('messages.all.value')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@lang('messages.admin.systemConstant.communicate_time')</td>
                                    <td class="ClientRequestResponseTime">{{$ClientRequestResponseTime}}</td>
                                    <td>
                                        <button class="btn btn-success ClientRequestResponseTimeEdit" type="button">
                                            @lang('messages.all.set')
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('messages.admin.systemConstant.mrp')</td>
                                    <td class="Mrp">{{$Mrp}}</td>
                                    <td>
                                        <button class="btn btn-success MrpEdit" type="button">
                                            @lang('messages.all.set')
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('messages.admin.systemConstant.client_check_cost')</td>
                                    <td class="ClientCheckCost">{{$ClientCheckCost}}</td>
                                    <td>
                                        <button class="btn btn-success ClientCheckCostEdit" type="button">
                                            @lang('messages.all.set')
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('messages.admin.systemConstant.consultation_service_cost')</td>
                                    <td class="ConsultationServiceCost">{{$ConsultationServiceCost}}</td>
                                    <td>
                                        <button class="btn btn-success ConsultationServiceCostEdit" type="button">
                                            @lang('messages.all.set')
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('messages.admin.systemConstant.prepayment_cost')</td>
                                    <td class="PrepaymentCost">{{$PrepaymentCost}}</td>
                                    <td>
                                        <button class="btn btn-success PrepaymentCostEdit" type="button">
                                            @lang('messages.all.set')
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ConstantModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ModalHeader"></h4>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="ConstantForm" method="post"
                          action="{{route('admin.constants.setConstant')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="ConstantType" value=""/>

                        <div class="form-group">
                            <label for="ConstantValue">@lang('messages.admin.systemConstant.constant_value')</label>
                            <input class="form-control" type="number" name="ConstantValue"/>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <button type="submit" class="btn btn-success float-right">
                                    @lang('messages.all.set')
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
    <script>
        //activeTab('constants-list');

        $(function () {
            $(document).on('click', '.ClientRequestResponseTimeEdit', function (e) {
                var modal = $('#ConstantModal');
                $('.ModalHeader', modal).html('@lang('messages.admin.systemConstant.communicate_time')');
                $('input[name="ConstantValue"]', modal).val($('td.ClientRequestResponseTime').html() * 1);
                $('input[name="ConstantType"]', modal).val('ClientRequestResponseTime');
                modal.modal('show');
            });

            $(document).on('click', '.MrpEdit', function (e) {
                var modal = $('#ConstantModal');
                $('.ModalHeader', modal).html('@lang('messages.admin.systemConstant.mrp')');
                $('input[name="ConstantValue"]', modal).val($('td.Mrp').html() * 1);
                $('input[name="ConstantType"]', modal).val('Mrp');
                modal.modal('show');
            });

            $(document).on('click', '.ClientCheckCostEdit', function (e) {
                var modal = $('#ConstantModal');
                $('.ModalHeader', modal).html('@lang('messages.admin.systemConstant.client_check_cost')');
                $('input[name="ConstantValue"]', modal).val($('td.ClientCheckCost').html() * 1);
                $('input[name="ConstantType"]', modal).val('ClientCheckCost');
                modal.modal('show');
            });

            $(document).on('click', '.ConsultationServiceCostEdit', function (e) {
                var modal = $('#ConstantModal');
                $('.ModalHeader', modal).html('@lang('messages.admin.systemConstant.consultation_service_cost')');
                $('input[name="ConstantValue"]', modal).val($('td.ConsultationServiceCost').html() * 1);
                $('input[name="ConstantType"]', modal).val('ConsultationServiceCost');
                modal.modal('show');
            });

            $(document).on('click', '.PrepaymentCostEdit', function (e) {
                var modal = $('#ConstantModal');
                $('.ModalHeader', modal).html('@lang('messages.admin.systemConstant.prepayment_cost')');
                $('input[name="ConstantValue"]', modal).val($('td.PrepaymentCost').html() * 1);
                $('input[name="ConstantType"]', modal).val('PrepaymentCost');
                modal.modal('show');
            });

            $('#ConstantForm').submit(function () {

                let ConstantType = $('input[name="ConstantType"]', this).val();
                let ConstantValue = $('input[name="ConstantValue"]', this).val();

                $(this).ajaxSubmit({
                    success: function () {
                        $('.' + ConstantType + '').html(ConstantValue);

                        $('#ConstantModal').modal('hide');
                    }
                });

                return false;
            });
        })
    </script>
@endsection
