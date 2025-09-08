@extends('new.layouts.app')

@section('content')
  <div class="payment-type pt-5">
    <div class="container ">
      <div class="row">
        <div class="col-12">
          <h1 class="title-main">
            @lang('messages.pages.setPaymentType.title')
          </h1>
          <div class="col-10 mx-auto">
            <div class="section-header "><span
                class="secondary-txt">@lang('messages.pages.payment-info.select_payment_method')</span>
            </div>
            <div class="payment-section ">
              <form id="paymentMethods">
                <div class="row justify-content-center ">

                  <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <div class="form-check pl-0">
                      <input class="form-check-input" type="radio" name="paymentMethod"
                             id="paymentMethod-1" value="1">
                      <label class="form-check-label " for="paymentMethod-1"><span
                          class="secondary-txt">@lang('messages.pages.payment-info.by_bank_card')</span>
                        <img src="{{asset('images/bank-card.png')}}" class="d-block mt-1">
                      </label>
                    </div>
                  </div>
                  <div class="col-12 col-md-4 mb-3 mb-md-0 text-md-center">
                    <div class="form-check pl-0">
                      <input class="form-check-input" type="radio" name="paymentMethod"
                             id="paymentMethod-2" value="2">
                      <label class="form-check-label" for="paymentMethod-2"><span
                          class="secondary-txt">@lang('messages.pages.payment-info.issue_an_invoice_for_payment')</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-12 col-md-4 mb-3 mb-md-0 text-md-center">
                    <div class="form-check pl-0">
                      <input class="form-check-input" type="radio" name="paymentMethod"
                             id="paymentMethod-3" value="3">
                      <label class="form-check-label" for="paymentMethod-3"><span
                          class="secondary-txt">@lang('messages.pages.payment-info.in_cash')</span>
                      </label>
                    </div>
                    <div>
                      <small class="text-danger">
                        @lang('messages.pages.setPaymentType.cash_note')
                      </small>
                    </div>
                  </div>

                  <div class="col-12 mt-5">
                    <div class="form-check pl-0">
                      <input type="checkbox" class="form-check-input" id="offerCheck">
                      <label class="form-check-label" for="offerCheck">
                        @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                        <a href="{{route("offer")}}" target="_blank">
                          @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                        </a>
                        <span
                          class="text-danger">*</span>
                      </label>
                    </div>
                  </div>
                </div>
              </form>
              <button disabled
                      class="btn btn-success pl-5 pr-5 mt-4 paymentType">@lang('messages.all.pay')</button>
            </div>
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
          {{trans('messages.services.order_complete_cash')}}
        </div>
        <div class="modal-footer">
          <button type="button"
                  class="btn btn-success orderComplete_close">{{trans('messages.all.close')}}</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="chooseCity" tabindex="-1" role="dialog"
       aria-labelledby="modalChooseCityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          {{trans('messages.pages.setPaymentType.choose_city_header')}}
        </div>
        <div class="modal-body">
          <div class="row align-content-center">
            {{--                        @foreach($cityList as $city)--}}
            {{--                            <div class="col-4">--}}
            {{--                                <button class="selectableCity btn btn-link"--}}
            {{--                                        data-city_id="{{$city->id}}">{{$city->value}}</button>--}}
            {{--                            </div>--}}
            {{--                        @endforeach--}}
            @foreach($cityList->split(3) as $citySplit)
              <div class="col-4">
                @foreach($citySplit as $city)
                  <button class="selectableCity btn btn-link"
                          data-city_id="{{$city->id}}">{{$city->value}}</button>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"
                  data-bs-dismiss="modal"
                  class="btn btn-success chooseCity_skip">{{trans('messages.all.skip')}}</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>

  <script>
    $(document).ready(function () {
      let selectedCity = null;
      let selectedPymentMethod = null;

      $('#chooseCity').modal('show');

      $(document).on('click', '.selectableCity', function () {
        selectedCity = $(this).data('city_id')
        $('#chooseCity').modal('hide');
      })
      $(document).on('change', '#offerCheck', function () {
        $('.paymentType').attr('disabled', !this.checked);
      })
      $(document).on('click', '.paymentType', function () {
        switch (selectedPymentMethod) {
          case(null):
            alert("Please, choose one of the payment methods");
            break;
          case("2"):
            window.location = '{{route('ExtraServices.preOrder', ['serviceStepIdList' => $serviceStepIdList, 'extraServiceCode' => $extraServiceCode])}}' + '&selectedCity=' + selectedCity;
            break;
          case("3"):
            $.ajax({
              type: 'POST',
              url: '{{route('ExtraServices.order')}}',
              data: {
                _token: '{{csrf_token()}}',
                serviceStepIdList: '{{$serviceStepIdList}}',
                extraServiceCode: '{{$extraServiceCode}}',
                provideCompanyInfoLater: 'on',
                selectedCity: selectedCity,
                paymentTypeId: {{\App\Data\Helper\PaymentTypeList::BasicPaymentType}}
              },
              success: function (data) {
                $('#orderComplete').modal('show');
              }
            });

            break;
          default:
            alert("Please, choose one of the payment methods");
        }
      })
      $(document).on('change', '#paymentMethods input[name=\'paymentMethod\']', function () {
        selectedPymentMethod = $("input[name='paymentMethod']:checked").val();
        if (selectedPymentMethod == 1) {
          alert('Coming soon')
          btn = document.getElementById("paymentMethod-1");
          btn.checked = false;
        }
      })
      $(document).on('click', '.orderComplete_close', function () {
        window.location = '{{route('Client.service.list')}}';
      });
    })
  </script>
@endsection
