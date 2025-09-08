@php
  $catalogList = collect($currentNode->childNodeList->where('is_visible', 1)->all())->sortBy('name');
  if(sizeof($catalogList) === 0){
      $catalogList = [$currentNode];
  }
@endphp


<div class="services">

  <div class="col-12 services__window-documents">
    <div class="service-content-data-total">
      <div class="container">
        <div class="col-12 col-md-8">
          <div class="service-content-data-total-panel">
            <div class="service-content-data-total-panel-item">
              <div class="service-content-data-total-panel-item-title">Выбрано:</div>
              <div class="service-content-data-total-panel-item-description cnt">
                <span>0</span> видов работ
              </div>
            </div>
            <div class="service-content-data-total-panel-item">
              <div class="service-content-data-total-panel-item-title">Стоимость оказания
                услуг:
              </div>
              <div class="service-content-data-total-panel-item-icon">
                <img src="{{asset('/new/images/money_circle.svg')}}" alt="">
              </div>
              <div class="service-content-data-total-panel-item-description price">
                <span>{{number_format($currentNode->service->base_cost, 0, '.', ' ')}}</span>
                тенге
              </div>
            </div>
            <div class="service-content-data-total-panel-item">
              <div class="service-content-data-total-panel-item-title">Срок оказания услуг:</div>
              <div class="service-content-data-total-panel-item-icon">
                <img src="{{asset('/new/images/clock_circle.svg')}}" alt="">
              </div>
              <div class="service-content-data-total-panel-item-description day_cnt">
                <span>{{$currentNode->service->total_execution_work_day_cnt}}</span>
                дней
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="service-content-data-total-btn">
            <button type="button"
                    class="btn btn-outline-white service-action"
                    data-bs-toggle="modal"
                    data-bs-target="#downloadCommercialOfferModal"
                    disabled="disabled"
            >
              <img src="{{asset('/new/images/arrowDownWhite.svg')}}" class="me-2">
              Скачать КП
            </button>
            <button type="button"
                    class="btn btn-white service-action orderService"
                    disabled="disabled"
            >
              Заказать услугу
            </button>
          </div>
        </div>
      </div>
      <div class="loader-line d-none"></div>
    </div>
    <div>
      <div class="row">
        <div class="col-sm-10 col-12 service-content-data-list">
          <p class="service-content-data-list-head">Чтобы узнать точные стоимость и сроки выберите подвиды работ</p>
        </div>

        <div class="col-12">
          @foreach($catalogList as $catalogItem)
            @php
              $catalogSubList = collect($catalogItem->childNodeList->where('is_visible', 1)->all())->sortBy('name');
            @endphp
            <div class="row mb-3">
              <div class="col-12">
                <div class="row service-content-data-list-item">
                  <div class="service-content-data-list-item-head">
                    <div class="service-content-data-list-item-head-main-info">
                      <label class="container_checkbox container_checkbox-all">
                        {{$catalogItem->name}}
                        <input type="checkbox"><span class="checkmark"></span>
                      </label>
                      @if(sizeof($catalogSubList) > 0)
                        <div class="service-content-data-list-item-head-point">
                          {{sizeof($catalogSubList)}} @choice('пункт|пункта|пунктов', $catalogSubList)
                        </div>
                      @endif
                    </div>
                    <div class="service-content-data-list-item-head-additional-info">
                      <a type="button" class="service-content-data-list-item-head-link services__window-link">
                        <i class="ml-3 bi bi-chevron-down services__window_title-icon"></i>
                      </a>
                      <a type="button"
                         class="service-content-data-list-item-head-link services__window-link hides d-none">
                        <i class="ml-3 bi bi-chevron-up services__window_title-icon"></i>
                      </a>
                    </div>
                  </div>
                  <div class="services__window_all">
                    <div class="service-content-data-list-item-list services__window_choices d-none">
                      <div class="row">

                        @if(sizeof($catalogSubList) > 0)
                          @foreach($catalogSubList as $catalogSubItem)
                            @if(sizeof($catalogSubItem->serviceCatalogList) > 0)
                              <div class="col-12 services__window_choices_layout">
                                <label class="container_checkbox">{{$catalogSubItem->name}}
                                  <input type="checkbox"
                                         data-service-id="{{$catalogSubItem->serviceCatalogList[0]->service_id}}"
                                         data-name="{{$catalogSubItem->name}}"
                                  >
                                  <span class="checkmark"></span>
                                </label>
                                @if(!$loop->last)
                                  <hr class="services__window-strip">
                                @endif
                              </div>
                            @endif
                          @endforeach
                        @else
                          @if(sizeof($catalogItem->serviceCatalogList) > 0)
                            <div class="col-12 services__window_choices_layout">
                              <label class="container_checkbox">{{$catalogItem->name}}
                                <input type="checkbox"
                                       data-service-id="{{$catalogItem->serviceCatalogList[0]->service_id}}"
                                       data-name="{{$catalogItem->name}}"
                                >
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          @endif
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="service-content-data-turnkey-solution">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="service-content-data-turnkey-solution-total">
                <div class="service-content-data-turnkey-solution-total-item">
                  <div class="service-content-data-turnkey-solution-total-item-title cnt">Выбрано
                    <span>0</span> видов работ
                  </div>
                </div>
                <div class="service-content-data-turnkey-solution-total-item">
                  <div class="service-content-data-turnkey-solution-total-item-title">Стоимость оказания
                    услуг:
                  </div>
                  <div class="service-content-data-turnkey-solution-total-item-desc price">
                    <span>{{number_format($currentNode->service->base_cost, 0, '.', ' ')}}</span>
                    тенге
                  </div>
                </div>
                <div class="service-content-data-turnkey-solution-total-item">
                  <div class="service-content-data-turnkey-solution-total-item-title">Срок оказания услуг:</div>
                  <div class="service-content-data-turnkey-solution-total-item-desc day_cnt">
                    <span>{{$currentNode->service->total_execution_work_day_cnt}}</span>
                    дней
                  </div>
                </div>
              <div class="service-content-data-turnkey-solution-total-btn">
                <button type="button"
                        class="btn btn-outline-white service-action"
                        data-bs-toggle="modal"
                        data-bs-target="#downloadCommercialOfferModal"
                        disabled="disabled"
                >
                  Скачать КП
                </button>
                <button type="button"
                        class="btn btn-white service-action orderService"
                        disabled="disabled"
                >
                  Заказать услугу
                </button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="service-content-data-turnkey-solution-info">
              <div class="service-content-data-turnkey-solution-info-btn">
                <div class="service-content-data-turnkey-solution-info-btn-icon">
                  <img src="{{asset('/new/images/lightning-bolt.svg')}}" alt="">
                </div>
                <div class="service-content-data-turnkey-solution-info-title d-block d-sm-none">
                  Если поджимают сроки, воспользуйтесь готовым решением
                </div>
                <button type="button" class="btn btn-success services__window-white-button readyOffer d-none d-sm-block"
                        data-bs-toggle="modal"
                        data-bs-target="#consultModal"
                        aria-expanded="false">
                  Оставить заявку
                </button>
              </div>
              <div class="service-content-data-turnkey-solution-info-title d-none d-sm-block">
                Если поджимают сроки, воспользуйтесь готовым решением
              </div>
              <div class="service-content-data-turnkey-solution-info-description">
                <div class="service-content-data-turnkey-solution-info-description-item">
                  <div class="service-content-data-turnkey-solution-info-description-item-label">Стоимость:</div>
                  <div class="service-content-data-turnkey-solution-info-description-item-data">6.000.000 тг</div>
                </div>
                <div class="service-content-data-turnkey-solution-info-description-item">
                  <div class="service-content-data-turnkey-solution-info-description-item-label">Срок:</div>
                  <div class="service-content-data-turnkey-solution-info-description-item-data">3 дня</div>
                </div>
              </div>
              <button type="button" class="btn btn-success services__window-white-button readyOffer d-block d-sm-none"
                      data-bs-toggle="modal"
                      data-bs-target="#consultModal"
                      aria-expanded="false">
                Оставить заявку
              </button>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-12 service-content-info">
    <div class="content">
      <div class="col-12 service-content-info-title">
        {{$currentNode->name}}
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-12 col-md-8">
            <div class="service-content-info-description">
              {{$currentNode->description}}
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="service-content-info-download">
              <button type="button"
                      class="btn btn-outline-success main__partners_button service-action"
                      data-bs-toggle="modal"
                      data-bs-target="#downloadRequirementModal"
                      disabled="disabled"
              >
                <img src="{{asset('/new/images/arrowDown.svg')}}" class="me-2">
                Скачать требования
              </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="service-content-info_additional_info">
              <div class="row">
                <div class="col-12 col-md-3 service-content-info_additional_info-item">
                  <div class="service-content-info_additional_info-item-label">Услугодатель</div>
                  <div
                    class="service-content-info_additional_info-item-description">{{$currentNode->service->executive_agency}}</div>
                </div>

                <div class="col-12 col-md-3 service-content-info_additional_info-item">
                  <div class="service-content-info_additional_info-item-label">Государственная пошлина</div>
                  <div class="service-content-info_additional_info-item-description tax">
                    <span>-</span> тенге
                  </div>
                </div>

                <div class="col-12 col-md-3 service-content-info_additional_info-item">
                  <div class="service-content-info_additional_info-item-label">Срок оказания услуг</div>
                  <div class="service-content-info_additional_info-item-description day_cnt">
                    <span>{{$currentNode->service->total_execution_work_day_cnt}}</span> дней
                  </div>
                </div>

                <div class="col-12 col-md-3 service-content-info_additional_info-item">
                  <div class="service-content-info_additional_info-item-label">Стоимость оказания услуг</div>
                  <div class="service-content-info_additional_info-item-description price">
                    <span>{{number_format($currentNode->service->base_cost, 0, '.', ' ')}}</span> тенге
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="service-steps"></div>
</div>



