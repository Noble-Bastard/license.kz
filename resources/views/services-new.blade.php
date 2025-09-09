@extends('new-redesign.layouts.app')
@section('content')

  <div class="services">
    <div class="col-12 services__window-documents">
      <div class="container">

        <div class="row">
          <div class="col-sm-9 col-12 services__window_head_layout">
            <p class="services__window_title-head">Выберите типы производимых работ для получения документа</p>
          </div>

          @for($i = 0; $i < 6; $i++)
            <div class="col-lg-8 col-sm-10 col-12">
              <div class="row">
                <!-- head -->
                <div class="col-sm-10 col-11">
                  <p class="services__window_title-construction">
                                    <span class="services__window_title-span">
                                        Строительство
                                    </span>
                    зданий и сооружений
                  </p>
                </div>

                <!-- description -->
                <div class="col-sm-10 col-12 py-1">
                  <p class="services__window_title-description">
                    Возведение несущих и (или) ограждающих конструкций зданий и сооружений
                  </p>
                </div>

                <!-- choice -->
                <div class="col-10">
                  <p class="services__window_title-choice">
                    Выберите виды работ
                  </p>
                </div>

                <!-- box -->
                <div class="col-12">
                  <div class="row services__window-row">
                    <div class="services__window_box box-{{$i}}">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12">
                            <label class="container_checkbox">Выбрать все
                              <input type="checkbox"><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <hr class="services__window-hr">
                      <div class="row">
                        <div class="col-12 services__window_choices win-{{$i}}" style="display: none">
                          <div class="row">
                            @for($j = 0; $j < 7; $j++)
                              <div class="col-12 services__window_choices_layout">
                                <label class="container_checkbox">Пункт - {{$j}}
                                  <input type="checkbox"><span class="checkmark"></span>
                                </label>
                                <hr class="services__window-strip">
                              </div>
                            @endfor
                          </div>
                        </div>
                        <div class="col-auto">
                          <a type="button" class="lk-{{$i}} services__window-link"><p
                              class="services__window_title-work">Показать все виды работ</p></a>
                          <a type="button" class="lh-{{$i}} services__window-link hides" style="display: none"><p
                              class="services__window_title-work">Скрыть все виды работ</p></a>
                        </div>
                        <div class="col-1 services__window_icon_layout">
                          <a type="button" class="i-{{$i}} icon_1"><i
                              class="bi bi-chevron-down services__window_title-icon"></i></a>
                          <a type="button" class="k-{{$i}} icon_2"><i
                              class="bi bi-chevron-down services__window_title-icon"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="services__window-hr_main">
                </div>

              </div>
            </div>
          @endfor

        </div>

      </div>
    </div>

    <div class="col-12">
        <div class="service-turnkey-solution services__window-white">
          <div class="container" style="max-width: 90rem">
            <div class="services__window-white-content">
              <div class="row">
                <div class="col-5">
                  <div class="row">
                    <div class="col-10">
                      <p class="services__window-white-title-head">Если поджимают сроки, воспользуйтесь
                        <span class="services__window-white-title-span">готовым решением</span>
                      </p>
                    </div>
                    <div class="col-12 services__window-white-price_layout">
                      <div class="row">
                        <div class="col-xl-5 col-4">
                          <p class="services__window-white-title-day">3 дня.</p>
                        </div>
                        <div class="col-7">
                          <p class="services__window-white-title-price">6.000.000 тг</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="button" class="btn btn-success services__window-white-button">Оставить заявку
                      </button>
                    </div>
                  </div>
                </div>

                <div class="col-7">
                  <img src="{{asset('/new/images/Instruction.png')}}" class="services__window-white-img">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  </div>
@endsection
@section('services-js')
  <script>
    for (let i = 0; i < 6; i++) {
      $('.lk-' + i + ',' + '.i-' + i).click(function (e) {
        if ($('.services__window_box').css('height') !== '6.5rem') {
          if ($('.services__window-row').css('width') < '490px') {
            $('.services__window_box').css({'height': '6.5rem', 'width': '100%'})
          } else {
            $('.services__window_box').css({'height': '6.5rem', 'width': '16.375rem'})
          }
          $('.services__window-link').css('display', 'block')
          $('.services__window_choices').css('display', 'none')
          $('.hides').css('display', 'none')
          $('.icon_1').css('display', 'block')
          $('.icon_2').css('display', 'none')
        }
        $('.box-' + i).css({
          'width': '54rem',
          'height': 'fit-content',
        });
        $('.win-' + i).css('display', 'block')
        $('.lh-' + i).css('display', 'block')
        $('.lk-' + i).css('display', 'none')
        $('.k-' + i).css('display', 'block')
        $('.i-' + i).css('display', 'none')
      })

      $('.lh-' + i + ',' + '.k-' + i).click(function (e) {
        if ($('.services__window_box').css('height') !== '6.5rem') {
          $('.services__window_box').css({'height': '6.5rem', 'width': '16.375rem'})
          $('.services__window-link').css('display', 'block')
          $('.services__window_choices').css('display', 'none')
          $('.hides').css('display', 'none')
          $('.icon_1').css('display', 'block')
          $('.icon_2').css('display', 'none')
        }
      })
    }

  </script>
@endsection
