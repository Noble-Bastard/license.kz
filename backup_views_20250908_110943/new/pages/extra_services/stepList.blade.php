<div class="service-content-data-total extra-service-data-total extra-service-data-total-sub">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8">
        <div class="service-content-data-total-panel">
          <div class="service-content-data-total-panel-item">
            <div class="service-content-data-total-panel-item-title">Выбрано:</div>
            <div class="service-content-data-total-panel-item-description cnt">
              <span>{{sizeof($stepList)}} @choice('вид|вида|видов', $stepList)</span> услуг
            </div>
          </div>
          <div class="service-content-data-total-panel-item">
            <div class="service-content-data-total-panel-item-title">Стоимость:
            </div>
            <div class="service-content-data-total-panel-item-icon">
              <img src="{{asset('/new/images/money_circle.svg')}}" alt="">
            </div>
            <div class="service-content-data-total-panel-item-description price">
              <span>{{number_format($stepList->sum('cost') + $extraService->cost_minimum, 0, '.', ' ')}}</span>
              тенге
            </div>
          </div>
          <div class="service-content-data-total-panel-item">
            <div class="service-content-data-total-panel-item-title">Срок оказания услуг:</div>
            <div class="service-content-data-total-panel-item-icon">
              <img src="{{asset('/new/images/clock_circle.svg')}}" alt="">
            </div>
            <div class="service-content-data-total-panel-item-description day_cnt">
              <span>{{$stepList->sum('totalDay')}} @choice('день|дня|дней', $stepList->sum('totalDay'))</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="service-content-data-total-btn">
          <button type="button"
                  class="btn btn-white service-action orderService"
          >
            Заказать услугу
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="loader-line d-none"></div>
</div>
<div class="extra-service-step-list">
  @foreach($stepList as $step)
    <div class="extra-service-step-item">
      <div class="extra-service-step-item-header">
        <div class="extra-service-step-item-header-title">{{$step->name}} <span class="d-block d-md-none">{{$step->totalDay}} @choice('день|дня|дней', $step->totalDay)</span></div>
        <div class="extra-service-step-item-header-info">
          <div
            class="extra-service-step-item-header-day d-none d-md-block">{{$step->totalDay}} @choice('день|дня|дней', $step->totalDay)</div>
          <div class="extra-service-step-item-header-collapse close">
            <i class="bi bi-chevron-down"></i>
          </div>
          <div class="extra-service-step-item-header-selector">
            <div class="form-check">
              <input class="form-check-input extra-service-step-item-header-selector_checkbox" type="checkbox"
                     checked="checked" value="{{$step->id}}"
                     id="extra-service-step-item_{{$step->id}}" data-total_day="{{$step->totalDay}}">
              <label class="form-check-label" for="extra-service-step-item_{{$step->id}}"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="extra-service-step-item-step-list close">
        @foreach($step->step_body_list as $stepBody)
          <div class="extra-service-step-item-step-list-item">
            <div class="extra-service-step-item-step-list-item-header">
              <div class="extra-service-step-item-step-list-item-header-info">
                <div class="extra-service-step-item-step-list-item-header_no">{{$loop->index+1}}</div>
                <div class="extra-service-step-item-step-list-item-header-title">
                  <div class="extra-service-step-item-step-list-item-header-title-val">{{$stepBody->name}}</div>
                  <div class="extra-service-step-item-step-list-item-header-title-collapse close">Подробнее</div>
                </div>
              </div>
              <div
                class="extra-service-step-item-step-list-item-header-day">{{$stepBody->dayCount}} @choice('день|дня|дней', $stepBody->dayCount)</div>
            </div>
            <div class="extra-service-step-item-step-list-item-body close">
              @if(sizeof($stepBody->document_list) > 0)
                <div class="extra-service-step-item-step-list-item-body-item">
                  <div class="extra-service-step-item-step-list-item-body-item-header">Список документов</div>
                  <div class="extra-service-step-item-step-list-item-body-item-data">
                    <ul>
                      @foreach($stepBody->document_list as $document)
                        <li>{!! $document->name !!}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              <div class="extra-service-step-item-step-list-item-body-item">
                <div class="extra-service-step-item-step-list-item-body-item-header">Время</div>
                <div
                  class="extra-service-step-item-step-list-item-body-item-data">{{$stepBody->dayCount}} @choice('рабочий|рабочих|рабочих', $stepBody->dayCount) @choice('день|дня|дней', $stepBody->dayCount)</div>
              </div>
              <div class="extra-service-step-item-step-list-item-body-item">
                <div class="extra-service-step-item-step-list-item-body-item-header">Результат</div>
                <div class="extra-service-step-item-step-list-item-body-item-data">{{$stepBody->result}}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
</div>
<div class="extra-service-action">
  <div class="row">
    <div class="col-12 col-md-4 mb-2">
      <div class="extra-service-action-panel">
        <div>
          <div class="extra-service-action-panel-title">Пошаговая инструкция</div>
          <div class="extra-service-action-panel-description">Мы предоставляем инструкцию, которая поможет вам легко
            пройти через весь процесс регистрации бизнеса, открытие банковского счета и т.д.
          </div>
        </div>
        <div class="extra-service-action-panel-btn">
          <button class="btn btn-outline-success w-100 py-3">
            Скачать инструкцию
          </button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-2">
      <div class="extra-service-action-panel">
        <div>
          <div class="extra-service-action-panel-title">Коммерческое предложение</div>
          <div class="extra-service-action-panel-description">Мы подготовили для Вас индивидуальное предложение
            подробное
          </div>
        </div>
        <div class="extra-service-action-panel-btn">
          <button class="btn btn-outline-success w-100 py-3">
            Скачать КП
          </button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-2">
      <div class="extra-service-action-panel dark extra-service-data-total extra-service-data-total-main">
        <div>
          <div class="extra-service-action-panel-title">Заказ услуги</div>
          <div class="extra-service-action-panel-description">
            Эксперты предоставят Вам решение с гарантированным результатом
          </div>
          <div class="extra-service-action-panel-subtitle1 cnt">Выбрано
            <span>{{sizeof($stepList)}} @choice('вид|вида|видов', $stepList)</span> услуг
          </div>
          <div class="extra-service-action-panel-subtitle">Стоимость:</div>
          <div class="extra-service-action-panel-sub_description price">
            <span>{{number_format($stepList->sum('cost') + $extraService->cost_minimum, 0, '.', ' ')}}</span> тенге
          </div>
          <div class="extra-service-action-panel-subtitle">Срок оказания услуг:</div>
          <div class="extra-service-action-panel-sub_description day_cnt">
            <span>{{$stepList->sum('totalDay')}} @choice('день|дня|дней', $stepList->sum('totalDay'))</span></div>
        </div>
        <div class="extra-service-action-panel-btn">
          <button class="btn btn-success w-100 py-3 extraServiceOrder">
            Заказать услугу
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
