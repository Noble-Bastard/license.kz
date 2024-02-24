@extends('new.layouts.app')

@section('title')
  {{optional($extraService)->name}}
@endsection

@push('css')
  <link href="{{mix('css/app_new.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
  <div class="extra-service bg_white">
    <div class="container documents__window_layout_info">
      <div class="documents__window">
        <div class="col-12">
          <div class="row">
            <div class="col-md-8 col-12 order-1 order-md-0">
              <div class="col-md-8 col-12 text-md-start text-center">
                <p class="documents__window_title-head">{{$extraService->name}}</p>
              </div>
              <div class="col-md-11 col-12 text-start">
                <p class="documents__window_title-description">
                  {!!$extraService->description!!}
                </p>
              </div>
            </div>
            <div class="col-md-4 col-6 mb-3 order-0 order-md-1">
              <img src="{{asset('/new/images/extra-service/' . $extraService->code . '.png')}}" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="extra-service-additional-info">
        <div class="row">
          <div class="col-12 col-md-6 extra-service-additional-info-item">
            <div class="extra-service-additional-info-item-label">{{$extraService->name}}</div>
          </div>

          <div class="col-12 col-md-3 extra-service-additional-info-item">
            <div class="extra-service-additional-info-item-label">Срок оказания услуги</div>
            <div class="extra-service-additional-info-item-description day_cnt">
              <span>от {{$extraService->day_minimum}}</span> раб дней
            </div>
          </div>

          <div class="col-12 col-md-3 extra-service-additional-info-item">
            <div class="extra-service-additional-info-item-label">Стоимость оказания услуги</div>
            <div class="extra-service-additional-info-item-description tax">
              <span>от {{$extraService->cost_minimum}}</span> тг
            </div>
          </div>
        </div>
      </div>

      <div class="extra-service-question">
        <div class="extra-service-question-title">Ответьте на вопросы, а мы подберем подходящие варианты</div>
        @foreach($questionList as $question)
          <div class="extra-service-question-panel {{$loop->first ? 'extra-service-question-panel_active': ''}}" id="extra-service-question-panel_{{$question->id}}">
            <div class="extra-service-question-panel-cnt">Вопрос {{$loop->index+1}}<span> из {{sizeof($questionList)}}</span></div>
            <div class="extra-service-question-panel-title">{{$question->value}}</div>
            <div class="extra-service-question-panel-list row">
              @foreach($question->values->chunk(3) as $valuesColumn)
                <div class="col-12 col-md-6">
                  @foreach($valuesColumn as $value)
                    <div class="form-check"
                         data-name="{{$value->value}}"
                         data-question="{{$question->id}}"
                    >
                      <input class="form-check-input"
                             type="radio"
                             name="{{$question->id}}"
                             id="{{$value->code}}"
                             value="{{$value->code}}"
                             data-name="{{$value->value}}"
                             data-question="{{$question->id}}"
                      >
                      <label class="form-check-label" for="{{$value->code}}">
                        {{$value->value}}
                      </label>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
            <div class="extra-service-question-panel-action">
              @if(!$loop->first)
                <button class="btn btn-success extra-service-question-panel-action-prev" data-question="{{$question->id}}">Назад</button>
              @endif
              @if(!$loop->last)
                <button class="btn btn-success extra-service-question-panel-action-next" data-question="{{$question->id}}" disabled>Далее</button>
              @endif
              @if($loop->last)
                  <button class="btn btn-success extra-service-question-panel-action-result">Показать результат</button>
              @endif
            </div>
          </div>
        @endforeach

        <div class="extra-service-question-result-info d-none">
          @php
            $chunkSize = 5;
            $chunkCnt = floor(sizeof($questionList)/$chunkSize)
          @endphp
          @foreach($questionList as $question)
            <div class="extra-service-question-result-info-item {{$loop->index >= $chunkCnt*$chunkSize ? 'border-bottom-0': '' }}" id="extra-service-question-result-info-item_{{$question->id}}">
              <div class="extra-service-question-result-info-item-label">{{$question->value}}</div>
              <div class="extra-service-question-result-info-item-description"></div>
            </div>
          @endforeach
          <div class="extra-service-question-result-info-item border-bottom-0">
            <button class="btn btn-outline-success w-100 extra-service-question-panel-action-again">Пройти еще раз</button>
          </div>
        </div>
      </div>

      <div class="extra-service-step-panel"></div>

      <!-- popular services for business -->
      <div class="col-12 service-content-data-popular-services mb-3">
        <div class="service-content-data-popular-services-head">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="service-content-data-popular-services-head-title">Популярные услуги для сопровождения бизнеса</div>
            </div>
            <div class="col-12 col-md-6 d-none d-md-block">
              <button type="button" class="btn btn-success service-content-data-popular-services-head-btn services__window_popular_btn popularServices"
                      data-bs-toggle="modal"
                      data-bs-target="#consultModal"
              >
                Заказать звонок
              </button>
            </div>
          </div>
        </div>
        <div class="service-content-data-popular-services-list">
          <div class="row">
            @foreach($popularServiceList as $popularService)
              <div class="col-md-3 col-sm-6 col-6 mb-3">
                <div class="service-content-data-popular-services-list-item">
                  <div>
                    <div class="service-content-data-popular-services-list-item-icon">
                      <img src="{{asset($popularService['icon'])}}"
                           class="services__window_popular_photo" alt="document">
                    </div>
                    <div
                      class="service-content-data-popular-services-list-item-content-description">{{$popularService['title']}}
                    </div>
                  </div>

                  <div class="service-content-data-popular-services-list-item-content">

                    <div>
                      <div class="service-content-data-popular-services-list-item-content-cost">
                        {{number_format($popularService['cost'], 0, ',', '.')}} тг
                      </div>
                      <div>
                        <button class="btn btn-outline-success w-100 py-md-3 service-content-data-popular-services-list-item-content-btn">
                          Добавить услугу
                        </button>

                        <input type="checkbox" data-tag="{{$popularService['tag']}}"
                               data-comment="{{$popularService['comment']}}">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="d-flex d-md-none">
          <button type="button" class="w-100 btn btn-success service-content-data-popular-services-head-btn services__window_popular_btn popularServices"
                  data-bs-toggle="modal"
                  data-bs-target="#consultModal"
          >
            Заказать звонок
          </button>
        </div>
      </div>

      <div class="col-12 documents__window_layout_useful">
        <div class="documents__window_useful">
          <div class="row">
            @php
              $usefulInformationList = $extraService->usefulInformations;
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

      $('.form-check').click(function(){
        let panel = $(this).parents('.extra-service-question-panel')[0]
        $('.extra-service-question-panel-action-next', panel).prop('disabled', false)
        $('#extra-service-question-result-info-item_'+$(this).data('question')+' .extra-service-question-result-info-item-description').html($(this).data('name'))
      })
      $('.extra-service-question-panel-action-prev').click(function () {
        let currentQuestion = $(this).data('question')
        showQuestionPanel(currentQuestion, currentQuestion-1)
      })
      $('.extra-service-question-panel-action-next').click(function () {
        let currentQuestion = $(this).data('question')
        showQuestionPanel(currentQuestion, currentQuestion+1)
      })
      $('.extra-service-question-panel-action-result').click(function () {
        $('.extra-service-question-panel').removeClass('extra-service-question-panel_active')

        $('.extra-service-question-result-info').removeClass('d-none')

        let questionValueCodeList = [];
        $('.extra-service-question-panel .form-check-input:checked').each(function () {
          questionValueCodeList.push($(this).val())
        })

        $.ajax({
          type: 'POST',
          url: '{{route('ExtraServices.steps')}}',
          data: {
            '_token': "{{ csrf_token() }}",
            'questionValueCode[]': questionValueCodeList,
            'extraServiceId': {{$extraService->id}}
          },
          success: function (data) {
            $('.extra-service-step-panel').html(data)
          }
        })
      })
      $('.extra-service-question-panel-action-again').click(function () {
        $('.extra-service-question-result-info').addClass('d-none')
        $('.extra-service-step-panel').html('')
        $('.form-check-input').prop('checked', false);
        $($('.extra-service-question-panel')[0]).addClass('extra-service-question-panel_active')
      })

      $(document).on('click', '.extra-service-step-item-step-list-item-header-title-collapse', function () {
        let parent = $(this).parents('.extra-service-step-item-step-list-item')[0]
        $('.extra-service-step-item-step-list-item-body', parent).toggleClass('close')
        $(this).toggleClass('close')
        $(this).html($(this).hasClass('close') ? 'Подробнее' : 'Свернуть')
      })

      $(document).on('click', '.extra-service-step-item-header-collapse', function () {
        let parent = $(this).parents('.extra-service-step-item')[0]
        $('.extra-service-step-item-step-list', parent).toggleClass('close')
        $(this).toggleClass('close')
        $('i', this).toggleClass('bi-chevron-down').toggleClass('bi-chevron-up')
      })

      $(document).on('change', '.extra-service-step-item-header-selector_checkbox', function(){
        let dayCnt = 0
        let serviceCnt = 0
        let pluralCntVariants = ['вид','вида','видов']
        let pluralDayCntVariants = ['день','дня','дней']
        $('.extra-service-step-item-header-selector_checkbox:checked').each(function () {
          dayCnt += $(this).data('total_day');
          serviceCnt += 1;
        })

        $('.extra-service-data-total .cnt span').html(`${serviceCnt} ${plural(serviceCnt, pluralCntVariants)}`)
        $('.extra-service-data-total .day_cnt span').html(`${dayCnt} ${plural(dayCnt, pluralDayCntVariants)}`)
      })

      $(window).on('resize scroll', function() {
        $('.extra-service-data-total-main').each(function () {
          if ($(this).isInViewport()) {
            $('.extra-service-data-total-sub').addClass('d-none')
          } else {
            $('.extra-service-data-total-sub').removeClass('d-none')
          }
        });
      })

      $(document).on('click', '.extraServiceOrder', function () {
        event.preventDefault();

        let serviceStepIdList = getServiceStepIdList();
        window.location = '{{route('ExtraServices.paymentInfo')}}?extraServiceCode={{$extraService->code}}&serviceStepIdList=' + serviceStepIdList;
      });
    })

    function getServiceStepIdList() {
      let serviceStepIdList = [];
      $('.extra-service-step-item-header-selector_checkbox:checked').each(function () {
        serviceStepIdList.push($(this).val())
      });

      return serviceStepIdList;
    }

    function showQuestionPanel(currentQuestion, nextQuestion){
      $('#extra-service-question-panel_'+currentQuestion).removeClass('extra-service-question-panel_active')
      $('#extra-service-question-panel_'+nextQuestion).addClass('extra-service-question-panel_active')
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
  </script>
@endsection
