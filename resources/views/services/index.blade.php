@extends('new.layouts.app')

@section('content')
    <div class="services">
        <div class="services__get-license">
            <img class="position-absolute services__get-license__background"
                 src="{{asset('images/services/BG-first-part.png')}}">
            <img class="position-absolute services__get-license__background"
                 src="{{asset('images/services/BG-second-part.png')}}">
            <img class="position-absolute services__get-license__background"
                 src="{{asset('images/services/mobile-bg.png')}}">

            <div class="container position-relative">
                <h1 class="services__get-license__header text-center">
                    <b>@lang('messages.pages.services-page.get_a_license_in_any_industry')</b></h1>
                <div class="text-center">
                    <span class="text-center services__get-license__header__upon-text text-center">
                        <span class="text-primary "><b>@lang('messages.pages.services-page.online')</b></span> @lang('messages.pages.services-page.with_a_guarantee_and_meeting_deadlines')</span>
                </div>
                <div class="services__get-license__inputs-container position-relative text-center">
                    <span class="text-center services__get-license__inputs-container__promt ">@lang('messages.pages.services-page.enter_your_contact_details')</span>

                    <form class="row mt-4 pl-4 pr-4" id="callMe">
                        <div class="col-md-3 col-12">
                            <input placeholder="@lang('messages.admin.employee.fio_company_name')"
                                   id="name"
                                   class="services__get-license__inputs-container__input">
                        </div>
                        <div class="col-md-3 col-12">
                            <input placeholder="@lang('messages.admin.employee.phone')"
                                   id="phone"
                                   class="services__get-license__inputs-container__input">
                        </div>
                        <div class="col-md-3 col-12">
                            <input placeholder="@lang('messages.admin.employee.email')"
                                   id="email"
                                   class="services__get-license__inputs-container__input">
                        </div>
                        <div class="col-md-3 col-12">
                            <input placeholder="@lang('messages.pages.services-page.license_type')"
                                   id="license_type"
                                   class="services__get-license__inputs-container__input">
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" checked id="offerCheck">
                                <label class="form-check-label" for="offerCheck">
                                    @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                                    <a href="{{route("offer")}}" target="_blank">
                                        @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                                    </a>
                                    {{--                                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_3')--}}
                                    <span
                                            class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="mx-auto position-relative">
                            <button type="submit"
                                    class=" btn btn-success callMe_submit">
                                @lang('messages.pages.services-page.learn_more')
                            </button>
                        </div>
                    </form>
                </div>
                <div class="services__get-license__promt-container position-absolute  ">
                    <div class="services__get-license__promt-container__promt mx-md-auto">
                        <div class="row">
                            <div class="col-12 col-md-3 pl-md-4 pr-md-4 text-md-center mb-4 mt-2 mt-mb-0 mb-md-0">
                                <img class="services__get-license__promt-container__promt__icon mt-2 mt-md-0"
                                     src="{{asset('images/services/promt-icon-1.png')}}">
                                <span class="services__get-license__promt-container__promt__icon__text ml-4">@lang('messages.pages.services-page.we_will_help_you_in_obtaining_all_the_documents_required_for_a_license')</span>
                            </div>
                            <div class="col-12 col-md-3 pl-md-4 pr-md-4 text-md-center mb-4 mt-2 mt-mb-0 mb-md-0">
                                <img class="services__get-license__promt-container__promt__icon"
                                     src="{{asset('images/services/promt-icon-2.png')}}">
                                <span class="services__get-license__promt-container__promt__icon__text ml-4"> @lang('messages.pages.services-page.you_dont_need_to_go_anywhere_all_documents_are_submitted_online')</span>
                            </div>
                            <div class="col-12 col-md-3 pl-md-4 pr-md-4 text-md-center mb-4 mt-2 mt-mb-0 mb-md-0">
                                <img class="services__get-license__promt-container__promt__icon"
                                     src="{{asset('images/services/promt-icon-3.png')}}">
                                <span class="services__get-license__promt-container__promt__icon__text ml-4">@lang('messages.pages.services-page.track_the_process_of_obtaining_a_license_in_your_personal_account')</span>
                            </div>
                            <div class="col-12 col-md-3 pl-md-4 pr-md-4 text-md-center mt-2 mt-mb-0">
                                <img class="services__get-license__promt-container__promt__icon"
                                     src="{{asset('images/services/promt-icon-4.png')}}">
                                <span class="services__get-license__promt-container__promt__icon__text ml-4">@lang('messages.pages.services-page.personal_manager_ready_to_help')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="services__process-for-obtaining-license position-relative">
            <img class="partners-network__certification__background"
                 src="{{asset('images/about-us_background/background-section-2.png')}}">
            <div class="container">
                <h1 class="text-center services__process-for-obtaining-license__header z-index-primary">
                    <b>@lang('messages.pages.services-page.process_for_obtaining_a_license_with_UPPERLICENSE')</b>
                </h1>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <ol class="services__process-for-obtaining-license__timeline">
                            <li>
                                <h3>@lang('messages.pages.services-page.order_the_license_you_need_in_our_catalog')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.or_leave_a_request_for_consultation_we_will_help_you_find_the_right_license')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.you_get_access_to_your_personal_account')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.in_which_you_can_track_the_process_of_obtaining_a_license_online')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.we_carry_out_a_preliminary_check_of_your_documents')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.and_if_necessary')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.you_pay_the_fees_or_services')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.this_can_also_be_done_in_our_personal_account')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.we_submit_documents')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.your_participation_is_not_required')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.authorized_bodies_check')</h3>
                                <span class="services__process-for-obtaining-license__timeline__small-text">
                                    @lang('messages.pages.services-page.compliance_with_licensing_requirements')
                                </span>
                            </li>
                            <li>
                                <h3>@lang('messages.pages.services-page.you_get_all_documents_online')</h3>
                            </li>
                        </ol>
                    </div>
                    <div class="col-6">
                        <img class="services__process-for-obtaining-license__img d-none d-md-block"
                             src="{{asset('images/services/macbook.png')}}">
                    </div>
                </div>

            </div>
        </div>
        <div class="services__which-license-do-you-need position-relative">
            <div class="container">
                <div class="services__which-license-do-you-need__form-container">
                    <h1 class="text-center">
                        @lang('messages.pages.services-page.which_license_do_you_need')</h1>
                    <form class="services__which-license-do-you-need__form-container__form">
                        <div class="form-group mb-3">
                            <select class="form-control" id="selectCategory">
                                <option value="" disabled
                                        selected>@lang('messages.pages.services-page.select_industry')</option>
                                @foreach($categoryList as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" id="selectServiceType" disabled="true" >
                                <option selected
                                        value="" disabled
                                        selected>@lang('messages.pages.services-page.resolution')</option>
                                @foreach($serviceTypeList as $serviceType)
                                    <option value="{{$serviceType->id}}">{{$serviceType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control select2" id="selectCatalog" name="category" disabled="true">
                                <option selected
                                        value="@lang('messages.pages.services-page.select_document')">
                                    @lang('messages.pages.services-page.select_document')
                                </option>

                            </select>
                        </div>
                        <div class="license_info">
                            <div class="mb-3 pl-1">
                                <b>@lang('messages.pages.services-page.type_of_the_issued_license')</b><span
                                        class="text-secondary pl-4 license_info--name"></span>
                            </div>

                            <div class="mb-3 pl-1 "><b
                                        class="pr-4">@lang('messages.pages.services-page.processing_time')</b>
                                <span class="btn-like-href pl-4 license_info--work_day"></span>
                            </div>

                            <div class="mb-5 pl-1 "><b
                                        class="pr-4">@lang('messages.pages.services-page.cost_of_services')</b>
                                <span class="btn-like-href license_info--price"></span>
                            </div>
                            <div class="text-center">
                                <a href=""
                                        class=" btn btn-success open_selected_license">@lang('messages.pages.services-page.order_a_license')</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="services__which-license-do-you-need__download-cp text-center">
{{--                    <span--}}
{{--                            >@lang('messages.pages.services-page.download_a_commercial_offer_with_a_detailed_description_of_the_service') <a href="">@lang('messages.pages.services-page.download_commercial_proposal')</a> </span>--}}
                </div>
            </div>
            <img class="about-us__about-owner__background"
                 src="{{asset('images/about-us_background/background-section-2.png')}}">
        </div>
    </div>
@endsection

@section('css')
    <link href="{{asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/libs/select2/css/select2-bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('/libs/jquery.inputmask.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#phone').inputmask("+7 (999) 999-99-99");

            $('.license_info').hide()

            $('#selectCategory').select2({
                minimumResultsForSearch: Infinity,
                theme: 'bootstrap4',
            }).on('change', function () {
                $('#selectServiceType').prop('disabled', false).val('')
                $('#selectCatalog').empty().append($('<option> @lang('messages.pages.services-page.select_document') </option>')).prop('disabled', true)
            })
            $('#selectServiceType').select2({
                minimumResultsForSearch: Infinity,
                theme: 'bootstrap4',
            }).on('change', function () {
                $.ajax({
                    url: '{{route('services.catalog.listByServiceCategoryAndType')}}?selectCategory=' + $('#selectCategory').val() + '&type=' + $('#selectServiceType').val(),
                    method: 'GET',
                })
                    .done(function (data) {
                        let catalog = $('#selectCatalog')
                        $(catalog).empty();
                        $(catalog)
                            .append($('<option> @lang('messages.pages.services-page.select_document') </option>'))
                        $.each(data, function (i, item) {
                            $(catalog)
                                .append(
                                    $('<option></option>')
                                    .val(item.id)
                                    .html(item.name)
                                    .data('name', item.name)
                                    .data('min_cost', item.min_cost)
                                    .data('min_execution_days', item.min_execution_days)
                                )
                        });
                        $(catalog).prop('disabled', false)
                    })
            })

            $('#selectCatalog').select2({
                minimumResultsForSearch: Infinity,
                theme: 'bootstrap4',
            }).on('change', function () {
                let optionSelected = $("option:selected", this)

                let infoPanel = $('.license_info')
                $('.license_info--name').html($(optionSelected).data('name'))
                $('.license_info--work_day').html($(optionSelected).data('min_execution_days') + ' рабочих дней')
                $('.license_info--price').html($(optionSelected).data('min_cost'))

                $('.open_selected_license').prop('href', '/serviceGroup/catalog/' + this.value)

                $(infoPanel).show()
            })

            $(document).on('change', '#offerCheck', function () {
                $('.callMe_submit').attr('disabled', !this.checked);
            })

            $("#callMe").submit(function (event) {
                event.preventDefault();

                if(!$('#email').val() || !$('#name').val() || !$('#phone').val()){
                    return
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('callMe')}}',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'email': $('#email').val(),
                        'fio': $('#name').val(),
                        'phone': $('#phone').val(),
                        'comment': 'Сфера деятельнсти - ' + $('#license_type').val(),
                    },
                    success: function (data) {
                        gtag('event', 'send', {'event_category': 'callback'});
                        alert("@lang('messages.client.service_create')")
                    }
                });
            });
        })
    </script>
@endsection
