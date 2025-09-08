<div class="d-none total-step-info"
     data-price="{{number_format($serviceTotals->stepCostTotal, 0, ',', ' ')}}"
     data-day-cnt="{{$serviceTotals->executionWorkDayTotal}}"
    data-tax="{{number_format($serviceTotals->stepTaxTotal, 0, ',', ' ')}}"
>
</div>


<div class="col-12 service-content-data-instructions">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="service-content-data-instructions-head">
        Пошаговая инструкция и требования для получения
        документов
      </div>
      <div>
        <button type="button" class="btn btn-outline-success service-content-data-instructions-head-btn"
                data-bs-toggle="modal" data-bs-target="#downloadRequirementModal">
          <img src="{{asset('/new/images/arrowDown.svg')}}" class="me-2">
          @lang('messages.pages.services.download_requirements')
        </button>
      </div>
    </div>

    <div class="col-12 col-md-8">
      @foreach($serviceStepList as $stepNo => $serviceStep)
        <div class="row">
          <div class="service-content-data-instructions-item">
            <div class="service-content-data-instructions-item-head">
              <div class="service-content-data-instructions-item-head-group">
                <div class="service-content-data-instructions-item-head-no">{{$stepNo+1}}</div>
                <div class="service-content-data-instructions-item-head-description">
                  {{$serviceStep->serviceStepWithLastCostHist->description}}
                </div>
              </div>
              <div class="service-content-data-instructions-item-head-arrow">
                <button class="documents__window_btn_instructions">
                  <i class="bi bi-chevron-down documents__window_icon"></i>
                </button>
                <button class="documents__window_btn_instructions d-none">
                  <i class="bi bi-chevron-up documents__window_icon"></i>
                </button>
              </div>
            </div>
            <div class="service-content-data-instructions-description d-none">
              <div class="row">
                @php
                  $serviceRequiredDocumentList = $serviceStepRequiredDocumentList->where('service_step_id', $serviceStep->service_step_id)->all()
                @endphp
                @if(sizeof($serviceRequiredDocumentList))
                  <div class="col-12 documents__window_list">
                    <p
                      class="documents__window_title-instruction_header">@lang('messages.pages.services.list_of_documents')</p>

                    <ul>
                      @foreach($serviceRequiredDocumentList as $curStepRequiredDocument)

                        @php
                          $description=str_replace(")", "</i>)",str_replace("(", "(<i>", $curStepRequiredDocument->serviceRequiredDocumentWithTranslate->description));
                          $description=str_replace(":",": </br>",$description);
                          $description=str_replace(";","; </br>",$description);
                        @endphp
                        <li class="documents__window_title-instruction_list">{!!$description!!}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                @php
                  if($stepNo > 0){
                      $serviceAdditionalRequirementList = $serviceAdditionalRequirements
                          ->where('step_no', $stepNo+1)
                          ->groupBy('name');
                  } else {
                      $serviceAdditionalRequirementList = $serviceAdditionalRequirements
                          ->filter(function($item) use ($stepNo) {
                              return $item->step_no == $stepNo+1 || $item->step_no == null;
                          })
                          ->groupBy('name');
                  }
                @endphp
                @foreach($serviceAdditionalRequirementList as $type => $valueList)
                  <div class="col-12 documents__window_list">
                    <p class="documents__window_title-instruction_header">{{$type}}</p>
                    <ul>
                      @foreach($valueList->sortBy('description') as $value)
                        @if(!empty($value->description))
                          <li class="documents__window_title-instruction_list">
                            <p>
                              {{$value->description}}
                            </p>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- popular services for business -->
<div class="col-12 service-content-data-popular-services">
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
                  <button class="btn btn-outline-success service-content-data-popular-services-list-item-content-btn">
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

<!-- Cards with services -->
<div class="col-12 service-content-data-our-service-list">
  <div class="service-content-data-our-service-list-head">Что входит в услугу UPPERLICENSE</div>
  <div class="service-content-data-our-service-list-list">
    <div class="row">
      @foreach($serviceContainsList as $serviceContains)
        <div class="col-6 col-md-4 mb-3">
          <div class="service-content-data-our-service-list-list-item">
            <div class="service-content-data-our-service-list-list-item-icon">
              <img src="{{asset($serviceContains['img'])}}">
            </div>
            <div class="service-content-data-our-service-list-list-item-description">
              {{$serviceContains['title']}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
