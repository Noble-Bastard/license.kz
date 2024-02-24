@extends('new.layouts.app')

@section('content')

  <div class="payment-info">
    <div class="payment-info__your-order">
      <div class="container">
        <h1 class="payment-info__your-order__header">@lang('messages.pages.payment-info.your_order'):</h1>
        <div class="row">
          <div class="col-12 col-md-8">
            @foreach($stepList as $step)
              <input name="serviceStepIdList[]" type="hidden" value="{{$step}}"/>
            @endforeach
            <h6 class="payment-info__your-order__section-header section-header">{{$extraService->name}}</h6>
            <div class="payment-info__your-order__section payment-section">
              <div class="payment-info__your-order__section__info">
                <div class="mb-3"><b>@lang('messages.pages.services.processing_time'): </b><span
                    class="pl-3 secondary-txt">{{$stepHeader->totalDay}}
                    {{ \App\Data\Helper\Assistant::num2word($stepHeader->totalDay,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days') )}}</span>
                </div>
                <div class="mb-3"><b>@lang('messages.services.cost_of_service'): </b><span
                    class="pl-3 secondary-txt">{{number_format($stepHeader->cost, 0, ',', ' ')}} тенге</span>
                </div>
              </div>
            </div>
            <div class="d-none d-md-block payment-info__your-order__section payment-section mt-4">
              <div class="payment-info__your-order__section__contact-form ">

                <button
                  class="btn btn-success mt-4 pl-5 pr-5 continueButton">@lang('messages.pages.payment-info.continue')</button>

              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <h6
              class="payment-info__your-order__section-header section-header mt-3 mt-md-0">@lang('messages.all.cost')</h6>
            <div class="payment-info__your-order__section price-section">
              <span class="payment-info__your-order__section__total-price">{{number_format($stepHeader->cost, 0, ',', ' ')}} тенге</span>
              <hr>
              <div class="payment-info__your-order__section__price-detail">
                <div class="mb-3 payment-info__your-order__section__price-detail__header">{{$extraService->name}}
                  :
                </div>
                <div class="row">
                  <div
                    class="col-7 secondary-txt text-left mb-3"></div>
                  <div class="col-5 secondary-txt text-end">
                    <b>{{number_format($stepHeader->cost, 0, ',', ' ')}} тенге</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-md-none">
            <div class="payment-info__your-order__section payment-section mt-4">
              <div class="payment-info__your-order__section__contact-form ">
                <button
                  class="btn btn-success mt-4 pl-5 pr-5 continueButton">@lang('messages.pages.payment-info.continue')</button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">

    </div>

  </div>
@endsection


@section('js')
  <script>
    $(document).ready(function () {

      function getServiceStepIdList() {
        let serviceStepIdList = [];
        $('input[name="serviceStepIdList[]"]').each(function () {
          serviceStepIdList.push($(this)[0].value)
        });
        return serviceStepIdList;
      }

      $('.continueButton').click(function () {
        event.preventDefault();

        let serviceStepIdList = getServiceStepIdList();
        window.location = '{{route('ExtraServices.setPaymentType')}}?extraServiceCode={{$extraService->code}}&serviceStepIdList=' + serviceStepIdList;
      });
    });
  </script>
@endsection
