@extends('new.layouts.app')
@section('content')
  {{-- Mobile Header for Service Pages --}}
  <div class="services-inline-header-wrapper">
    <div class="services-inline-header d-lg-none">
      <a href="{{ route('new-index') }}" class="services-inline-header__logo">
        <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="UPPERLICENSE">
      </a>
      <div class="services-inline-header__actions">
        <a href="tel:+77471350000" class="services-inline-header__icon">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" fill="#191E1D"/>
          </svg>
        </a>
        <button type="button" class="services-inline-header__icon" data-close-inline-header onclick="var path = window.location.pathname.split('/').filter(function(p){return p.length>0}); var locale = (path.length>0 && ['en','ru','kz'].includes(path[0])) ? path[0] : 'en'; window.location.href = '/' + locale; return false;">
          <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 1L13 13" stroke="#279760" stroke-width="1.4" stroke-linecap="round"/>
            <path d="M13 1L1 13" stroke="#279760" stroke-width="1.4" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
  <div class="services-inline-subheader d-lg-none">
    <a href="{{ route('new-services') }}" class="services-inline-subheader__btn">&lt; {{ __('Услуги') }}</a>
  </div>

  <div class="bg-white">

    <div class="documents">

      @include('new.partials.page.document')

      <nav>
        <div class="col-12">
          <div class="container documents__window_layout_useful">
            <div class="documents__window_useful">
              <div class="row">
              @php
                $usefulInformationList = $rootNode->category->usefulInformations;
              @endphp
              @if(sizeof($usefulInformationList) > 0)
                <div class="col-12 text-md-start text-center">
                  <p class="documents__window_title-access">Полезная информация</p>
                </div>

                <div class="col-12">
                  <div class="row">
                    @foreach(collect($usefulInformationList)->sortBy('order_no') as $usefulInformation)
                      <div class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="documents__window_useful_item">
                          <div>
                            <div class="documents__window_useful_item-title">
                              {{$usefulInformation->name}}
                            </div>
                            <div class="documents__window_useful_item-description">
                              {!! $usefulInformation->short_description !!}
                            </div>
                          </div>
                          @if(!is_null($usefulInformation->btn_name))
                            <div>
                              <a href="{{\Illuminate\Support\Facades\Storage::url($usefulInformation->file_path)}}"
                                 type="button"
                                 class="documents__window_useful_item-link">
                                <img src="{{asset('/new/images/arrowDown.svg')}}" class="me-2">
                                {{$usefulInformation->btn_name}}
                              </a>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
            </div>
          </div>
        </div>
      </nav>

      @include('new.partials.page.reviews1')

    </div>
  </div>

  <div class="modals">
    <div class="modal fade" id="downloadRequirementModal" tabindex="-1" aria-labelledby="downloadRequirementModalLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-12">
              <div class="row justify-content-end">
                <div class="col-lg-1 col-auto text-start">
                  <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close"><i
                      class="bi bi-x-circle modals__icon"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="modal-body">
              <p class="modals__title-head">{{trans('messages.services.serviceRequirement.title')}}</p>
              <form method="post" id="formDownloadRequirement"
                    action="{{route('services.sendServiceRequirement')}}">
                <div class="col-12">
                  <div class="row">
                    <div class="col-12">
                      @if(\Illuminate\Support\Facades\Auth::guest())
                        <label>{{trans('messages.services.serviceRequirement.non_auth_label')}}</label>
                        <input class="form-control modals__input" type="email"
                               id="serviceRequirementEmail"
                               placeholder="{{trans('messages.services.serviceRequirement.email')}}"
                               required value=""/>
                        <input class="form-control modals__input" type="tel"
                               name="phone"
                               id="serviceRequirementPhone"
                               placeholder="{{trans('messages.services.serviceRequirement.phone')}}"
                               required value=""/>
                        <input class="form-control modals__input" type="text" id="serviceRequirementNameNew"
                               placeholder="{{trans('messages.services.commercialOffer.name')}}"
                               value=""/>
                      @else
                        <label>{{trans('messages.services.serviceRequirement.auth_label')}}</label>
                        <input class="form-control modals__input" type="email"
                               id="serviceRequirementEmail"
                               placeholder="{{trans('messages.services.serviceRequirement.email')}}"
                               required
                               value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                        <input class="form-control modals__input" type="tel"
                               name="phone"
                               id="serviceRequirementPhon"
                               placeholder="{{trans('messages.services.serviceRequirement.phone')}}"
                               required
                               value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                        <input class="form-control modals__input" type="text"
                               id="serviceRequirementName"
                               placeholder="{{trans('messages.services.serviceRequirement.name')}}"
                               value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                      @endif
                      <div class="form-check pl-0 mt-2">
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
                  </div>
                </div>
                <button type="submit"
                        class="btn btn-success modals__success_btn formDownloadRequirement_submit">{{trans('messages.all.send')}}</button>
                <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку
                  персональных данных</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="downloadCommercialOfferModal" tabindex="-1" role="dialog"
         aria-labelledby="downloadCommercialOfferModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-12">
              <div class="row justify-content-end">
                <div class="col-lg-1 col-auto text-start">
                  <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close"><i
                      class="bi bi-x-circle modals__icon"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="modal-body">
              <p class="modals__title-head">{{trans('messages.services.commercialOffer.title')}}</p>
              <form method="post" id="formDownloadCommercialOffer"
                    action="{{route('services.sendCommercialOffer')}}">

                <div class="col-12">
                  <div class="row">
                    <div class="col-12">

                      @if(\Illuminate\Support\Facades\Auth::guest())
                        <label>{{trans('messages.services.commercialOffer.non_auth_label')}}</label>
                        <input class="form-control modals__input" type="email"
                               id="commercialOfferEmail"
                               placeholder="{{trans('messages.services.commercialOffer.email')}}"
                               required value=""/>
                        <input class="form-control modals__input" type="tel"
                               name="phone"
                               id="commercialOfferPhone"
                               placeholder="{{trans('messages.services.commercialOffer.phone')}}"
                               required value=""/>
                        <input class="form-control modals__input" type="text" id="commercialOfferName"
                               placeholder="{{trans('messages.services.commercialOffer.name')}}"
                               value=""/>
                      @else
                        <label>{{trans('messages.services.commercialOffer.auth_label')}}</label>
                        <input class="form-control modals__input" type="email"
                               id="commercialOfferEmail"
                               placeholder="{{trans('messages.services.commercialOffer.email')}}"
                               required
                               value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                        <input class="form-control modals__input" type="tel"
                               name="phone"
                               id="commercialOfferPhone"
                               placeholder="{{trans('messages.services.commercialOffer.phone')}}"
                               required
                               value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                        <input class="form-control modals__input" type="text"
                               id="commercialOfferName"
                               placeholder="{{trans('messages.services.commercialOffer.name')}}"
                               value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                      @endif
                      <div class="form-check pl-0 mt-2">
                        <input type="checkbox" class="form-check-input" checked id="offerCheck_commercial_offer">
                        <label class="form-check-label" for="offerCheck_commercial_offer">
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
                  </div>
                </div>

                <button type="submit"
                        class="btn btn-success modals__success_btn formDownloadCommercialOffer_submit">{{trans('messages.all.send')}}</button>
                <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку
                  персональных данных</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="sendEmailConfirmModal" tabindex="-1" role="dialog"
         aria-labelledby="sendEmailConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-12">
              <div class="row justify-content-end">
                <div class="col-lg-1 col-auto text-start">
                  <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close"><i
                      class="bi bi-x-circle modals__icon"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="modal-body">
              <p class="modals__title-head">{{trans('messages.services.confirmSendEmail')}}</p>
              <button type="button" class="btn btn-success modals__success_btn"
                      data-bs-dismiss="modal">{{trans('messages.all.close')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function () {
      $.fn.isInViewport = function() {
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight();
        let viewportTop = $(window).scrollTop() + $('.header-new').outerHeight();
        let viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
      };

      $(window).on('resize scroll', function() {
        $('.service-content-data-turnkey-solution').each(function () {
          if ($(this).isInViewport()) {
            $('.service-content-data-total').addClass('d-none')
          } else {
            $('.service-content-data-total').removeClass('d-none')
          }
        });
      })

      $("#formDownloadCommercialOffer").submit(function (event) {
        let serviceIdList = getServiceIdList();

        $('.formDownloadCommercialOffer_submit').attr('disabled', true);

        $.ajax({
          type: 'POST',
          url: '{{route('services.sendCommercialOffer')}}',
          data: {
            '_token': "{{ csrf_token() }}",
            'serviceIdList': serviceIdList,
            'email': $('#commercialOfferEmail').val(),
            'phone': $('#commercialOfferPhone').val(),
            'name': $('#commercialOfferName').val(),
          },
          success: function (data) {
            gtag('event', 'send', {'event_category': 'kp'});

            $('.formDownloadCommercialOffer_submit').attr('disabled', false);

            // let myModalEl = document.getElementById('downloadCommercialOfferModal')
            // let modal = bootstrap.Modal.getInstance(myModalEl);
            // modal.hide();

            $('#commercialOfferEmail').val('')
            $('#commercialOfferPhone').val('')
            $('#commercialOfferName').val('')

            $('#downloadCommercialOfferModal .btn-x').click()

            shoEmailConfirmModal();
          }
        });

        event.preventDefault();
      });

      $("#formDownloadRequirement").submit(function (event) {
        let serviceIdList = getServiceIdList();

        $('.formDownloadRequirement_submit').attr('disabled', true);

        $.ajax({
          type: 'POST',
          url: '{{route('services.sendServiceRequirement')}}',
          data: {
            '_token': "{{ csrf_token() }}",
            'serviceIdList': serviceIdList,
            'email': $('#serviceRequirementEmail').val(),
            'phone': $('#serviceRequirementPhone').val(),
            'name': $('#serviceRequirementName').val(),
          },
          success: function (data) {
            gtag('event', 'send', {'event_category': 'trebovaniya'});
            $('.formDownloadRequirement_submit').attr('disabled', false);

            // let myModalEl = document.getElementById('downloadRequirementModal')
            // let modal = bootstrap.Modal.getInstance(myModalEl);
            // modal.hide();

            $('#serviceRequirementEmail').val('')
            $('#serviceRequirementPhone').val('')
            $('#serviceRequirementName').val('')

            $('#downloadRequirementModal .btn-x').click()

            shoEmailConfirmModal()
          }
        });

        event.preventDefault();
      });

      $(document).on('click', '.readyOffer', function () {
        setAdditionalDataToSendForm('Ready offer', 'Готовое предложение')
      })

      $(document).on('click', '.popularServices', function () {
        let parent = $('.service-content-data-popular-services')
        let type = $('input[type="checkbox"]:checked', parent);
        let tag = []
        let comment = []
        $(type).each(function(){
          tag.push($(this).data('tag'))
          comment.push($(this).data('comment'))
        })
        setAdditionalDataToSendForm(tag.join(', '), comment.join(', '))
      })

      $(document).on('click', '.service-content-data-popular-services-list-item-content-btn', function() {
        let parent = $(this).parent()
        let currVal = $('input[type="checkbox"]', parent).is(':checked')
        if(currVal){
          $(this).removeClass('btn-success').addClass('btn-outline-success')
        } else {
          $(this).removeClass('btn-outline-success').addClass('btn-success')
        }
        $('input[type="checkbox"]', parent).prop('checked', !currVal);
      })

      $(document).on('click', '.card-container', function () {
        const self = this
        $('.loader-line', self).removeClass('d-none')
        $.ajax({
          type: 'GET',
          url: '/service-group/catalog/' + $(self).data('category-pretty-url'),
          success: function (data) {
            let parent = $(self).parents('.service-container')[0]
            $('.service-content', parent).html(data)
            $('.card-container').removeClass('card-container__active')
            $(self).addClass('card-container__active')
            $('.loader-line', self).addClass('d-none')

            let scrollTo = $(".service-content-data-list-head");
            let header = $('.header-new')
            let position = scrollTo.offset().top - header.height() - 20;
            $('html, body').animate({
              scrollTop: position
            });
          },
          error: function () {
            $('.loader-line', self).addClass('d-none')
          }
        })
      })

      $(document).on('click', '.services__window-link', function () {
        let self = this
        let parent = $(self).parents('.service-content-data-list-item')[0]
        $('.services__window-link', parent).toggleClass('d-none')
        $('.services__window_choices', parent).toggleClass('d-none')
      });

      $(document).on('click', '.container_checkbox-all input', function () {
        let parent = $(this).parents('.service-content-data-list-item')[0];

        $('.services__window_all .container_checkbox input:checkbox', parent)
          .prop('checked', $(this).is(':checked'));
        $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');

        setSelectedItemsText(parent, $(this).is(':checked'))

        disableServiceAction()
        loadServiceCompare()
      })

      $(document).on('click', '.services__window_all .container_checkbox input', function () {
        let parent = $(this).parents('.service-content-data-list-item')[0];
        $('.container_checkbox-all input:checkbox', parent).prop('checked', false)

        let allItems = $('.container_checkbox input:checkbox', parent).length - 1
        let selectedItems = $('.container_checkbox input:checkbox:checked', parent).length

        if(selectedItems === allItems){
          $('.container_checkbox-all input:checkbox', parent).prop('checked', true)
          $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        } else if (selectedItems === 0){
          $('.container_checkbox-all input:checkbox', parent).prop('checked', false);
          $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        } else {
          $('.container_checkbox-all input:checkbox', parent).prop('checked', false);
          $('.container_checkbox-all .checkmark', parent).addClass('checkmark_incomplete');
        }

        setSelectedItemsText(parent, null)

        disableServiceAction()
        loadServiceCompare()
      })

      // $(document).on('click', '.documents__window_useful_btn', function () {
      //     let parent = $(this).parents('.documents__window_useful')[0];
      //     $(parent).toggleClass('open');
      // })

      $(document).on('click', '.documents__window_btn_instructions', function () {
        let parent = $(this).parents('.service-content-data-instructions-item')[0];
        $(parent).toggleClass('active');
        $('.documents__window_btn_instructions', parent).toggleClass('d-none');
        $('.service-content-data-instructions-description', parent).toggleClass('d-none');
      })

      $(document).on('submit', '#formDownloadRequirementNew', function (event) {
        let serviceIdList = getServiceIdList();

        $('.formDownloadRequirementNew_submit').attr('disabled', true);

        $.ajax({
          type: 'POST',
          url: '{{route('services.sendServiceRequirement')}}',
          data: {
            '_token': "{{ csrf_token() }}",
            'serviceIdList': serviceIdList,
            'email': $('#serviceRequirementEmailNew').val(),
            'phone': $('#serviceRequirementPhoneNew').val(),
            'name': $('#serviceRequirementNameNew').val(),
          },
          success: function (data) {
            gtag('event', 'send', {'event_category': 'trebovaniya'});
            $('.formDownloadRequirementNew_submit').attr('disabled', false);
            $('#downloadRequirementModal').modal('hide');
            $('#modalSendEmailConfirmNew').modal('show');
          }
        });

        event.preventDefault();
      });

      $(document).on('click', '.orderService', function () {
        event.preventDefault();

        let serviceIdList = getServiceIdList();
        window.location = '{{route('Client.services.paymentInfo')}}?serviceList=' + serviceIdList;
      });

      function disableServiceAction() {
        if ($('.services__window_all .container_checkbox input:checkbox:checked').length > 0) {
          $('.service-action').prop('disabled', false)
        } else {
          $('.service-action').prop('disabled', true)
        }
      }

      function shoEmailConfirmModal() {
        let myModalEl = document.getElementById('sendEmailConfirmModal')
        // let modal = bootstrap.Modal.getInstance(myModalEl);
        // if (!modal) {
          modal = new bootstrap.Modal(document.getElementById('sendEmailConfirmModal'), {});
        // }
        modal.show();
      }

      function loadServiceCompare() {
        if ($('.services__window_all .container_checkbox input:checkbox:checked').length > 0) {
          $('.service-content-data-total .loader-line').removeClass('d-none')
          $.ajax({
            type: 'POST',
            url: '{{route('new.services-group.compare')}}',
            data: {
              '_token': "{{ csrf_token() }}",
              'serviceId[]': getServiceIdList()
            },
            success: function (data) {
              $('.service-steps').html(data)

              const price = $('.service-steps .total-step-info').data('price')
              const dayCnt = $('.service-steps .total-step-info').data('day-cnt')
              const tax = $('.service-steps .total-step-info').data('tax')

              $('.service-content-data-total .price span').html(price)
              $('.service-content-data-turnkey-solution-total .price span').html(price)
              $('.service-content-info_additional_info .price span').html(price)

              $('.service-content-data-total .day_cnt span').html(dayCnt)
              $('.service-content-data-turnkey-solution-total .day_cnt span').html(dayCnt)
              $('.service-content-info_additional_info .day_cnt span').html(dayCnt)

              $('.service-content-info_additional_info .tax span').html(tax)

              $('.service-content-data-total .cnt span').html(getServiceIdList().length)
              $('.service-content-data-turnkey-solution-total .cnt span').html(getServiceIdList().length)




              $('.selected-sub-licence').html(getServiceNameList())

              $('.service-content-data-total .loader-line').addClass('d-none')
            },
            error: function () {
              $('.service-content-data-total .loader-line').addClass('d-none')
            }
          })
        } else {
          $('.service-content-data-total .cnt span').html(0)
        }
      }

      function getServiceIdList() {
        let serviceIdList = [];
        $('.services__window_all .container_checkbox input:checkbox:checked').each(function () {
          serviceIdList.push($(this).data('service-id'))
        });

        return serviceIdList;
      }

      function getServiceNameList() {
        let result = '<ul>';
        $('.services__window_all .container_checkbox input:checkbox:checked').each(function () {
          result += "<li>" + $(this).data('name') + "</li>";
        });

        return result + '</ul>'
      }

      function plural(number, variants) {
        let idx = 2;
        if (number % 10 === 1 && number % 100 !== 11) {
          idx = 0;
        } else if (number % 10 >= 2 && number % 10 <= 4 && (number % 100 < 10 || number % 100 >= 20)) {
          idx = 1;
        }
        return variants[idx];
      }

      function setSelectedItemsText(parentNode, allCheckBoxVal){
        let allCnt = 0
        let selectedCnt = 0
        allCnt = $('.services__window_all .container_checkbox input:checkbox', parentNode).length
        selectedCnt = $('.services__window_all .container_checkbox input:checkbox:checked', parentNode).length
        if(allCheckBoxVal === false) {
            selectedCnt = 0
        }
        let selectedItemText = ''
        let pluralPointVariants = ['пункт','пункта','пунктов']
        let pluralSelectedVariants = ['Выбран','Выбрано', 'Выбрано']

        if (selectedCnt === 0){
          selectedItemText = `${allCnt} ${plural(allCnt, pluralPointVariants)}`
        } else if(selectedCnt === allCnt){
          selectedItemText = `${plural(allCnt, pluralSelectedVariants)} ${allCnt} ${plural(allCnt, pluralPointVariants)}`
        } else {
          selectedItemText = `${plural(selectedCnt, pluralSelectedVariants)} ${selectedCnt} ${plural(selectedCnt, pluralPointVariants)} из ${allCnt}`
        }

        $('.service-content-data-list-item-head-point', parentNode).html(selectedItemText)
      }
    })
  </script>

  {{-- Mobile Header Styles --}}
  <style>
    @media (max-width: 991.98px) {
      /* Hide old header - desktop version */
      .header-new,
      header.header-new,
      header.header-new[style],
      .header-redesigned,
      header.header-redesigned,
      header.header-redesigned[style] {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        opacity: 0 !important;
        pointer-events: none !important;
      }
      
      /* Hide old header - mobile version */
      .header-redesigned__mobile,
      .header-new__mobile,
      div.header-redesigned__mobile,
      div.header-new__mobile {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
        opacity: 0 !important;
        pointer-events: none !important;
      }
      
      .client-app > header.header-new,
      .client-app header.header-new,
      .client-app > header.header-redesigned,
      .client-app header.header-redesigned {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
      }
      
      /* Show new inline header */
      .services-inline-header {
        display: flex !important;
      }
    }

    .services-inline-header-wrapper {
      width: 100%;
      max-width: 100%;
      margin-left: 0;
      margin-right: 0;
      padding-left: 0;
      padding-right: 0;
    }

    .services-inline-header {
      display: flex;
      padding: 2px 16px 0 16px;
      background: #ffffff;
      border-bottom: 1px solid #E8E8E8;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      width: 100%;
      max-width: 100%;
      margin-left: 0;
      margin-right: 0;
      box-sizing: border-box;
      position: sticky;
      top: 0;
      z-index: 10001;
    }

    .services-inline-header__logo img {
      width: 192px;
      height: auto;
      display: block;
    }
    
    .services-inline-header__logo {
      margin-top: -48px;
      margin-left: -12px;
    }

    .services-inline-header__actions {
      margin-left: auto;
      margin-top: -48px;
      display: flex;
      gap: 8px;
      align-items: center;
      transform: translateX(-6px);
    }

    .services-inline-header__icon {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: 1px solid #E8E8E8;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #ffffff;
    }

    .services-inline-header__icon[data-close-inline-header] {
      border: 1px solid #279760;
      cursor: pointer;
      position: relative;
      z-index: 10002;
      pointer-events: auto !important;
    }
    
    .services-inline-header__icon[href] {
      cursor: pointer;
      pointer-events: auto !important;
    }

    .services-inline-header__icon svg {
      display: block;
      pointer-events: none;
    }

    .services-inline-subheader {
      display: none;
      padding: 32px 0 14px;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    @media (max-width: 991.98px) {
      .services-inline-subheader {
        display: flex;
      }
    }

    .services-inline-subheader__btn {
      font-family: 'Manrope', sans-serif;
      font-size: 22px;
      color: #191E1D;
      text-decoration: none;
      padding-left: 22px;
    }
  </style>
@endsection

