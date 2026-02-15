<header class="header-new w-100 {{Request::url() === url(route('new-home')) ? 'header_home' : ''}}">
  <div class="container" style="max-width: 1440px">
    <div>

      {{--            <nav class="hide-mobile-header-new d-none d-xl-block">--}}
      {{--                <div class="row align-items-center justify-content-center">--}}

      {{--                    <!-- logo -->--}}
      {{--                    <div class="col-8 text-center logo">--}}
      {{--                        <a href="/" class="header-new__logo">--}}
      {{--                            <img src="{{asset('/new/images/icons/logo.png')}}" alt="logo"/>--}}
      {{--                            <img src="{{asset('/new/images/icons/Burger_logo.png')}}" alt="logo"/>--}}
      {{--                        </a>--}}
      {{--                    </div>--}}

      {{--                    <!-- Menu -->--}}
      {{--                    <div class="col-3 col-xl-auto text-center links-menu">--}}
      {{--                        <ul class="nav header-new__menu">--}}
      {{--                            @include('layouts.menu')--}}
      {{--                        </ul>--}}
      {{--                    </div>--}}

      {{--                    <!-- burger with animation -->--}}
      {{--                    <div class="col-xxl-1 col-xl-1 text-center burger">--}}
      {{--                        <i class="bi bi-list header-new__burger-icon"></i>--}}
      {{--                        <i class="bi bi-x header-new__burger-icon"></i>--}}
      {{--                    </div>--}}

      {{--                    <!-- Language dropdown -->--}}
      {{--                    @if((Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client)) || !Auth::check())--}}
      {{--                        <div class="col-auto text-xxl-end text-xl-end header-new__language_dropdown elements">--}}
      {{--                            <div class="row">--}}

      {{--                                <div class="col-auto">--}}
      {{--                                    <div class="language-links">--}}
      {{--                                        <ul class="nav-element">--}}

      {{--                                            <li>--}}
      {{--                                                @if(\Illuminate\Support\Facades\App::getLocale() == "ru")--}}
      {{--                                                    <a href="" class="header-new__language_dropdown-element">--}}
      {{--                                                      Русский--}}
      {{--                                                    </a>--}}
      {{--                                                    <a href="" class="header-new__language_dropdown-element-white">--}}
      {{--                                                      Русский--}}
      {{--                                                    </a>--}}
      {{--                                                @else--}}
      {{--                                                    <a href="" class="header-new__language_dropdown-element">--}}
      {{--                                                      English--}}
      {{--                                                    </a>--}}
      {{--                                                    <a href="" class="header-new__language_dropdown-element-white">--}}
      {{--                                                      English--}}
      {{--                                                    </a>--}}
      {{--                                                @endif--}}

      {{--                                                <ul class="submenu">--}}
      {{--                                                    <li>--}}
      {{--                                                        <a rel="alternate" hreflang="ru"--}}
      {{--                                                           href="{{ LaravelLocalization::getLocalizedURL("ru", null, [], true) }}">--}}
      {{--                                                          Русский--}}
      {{--                                                        </a>--}}
      {{--                                                    </li>--}}
      {{--                                                    <li>--}}
      {{--                                                        <a rel="alternate" hreflang="en"--}}
      {{--                                                           href="{{ LaravelLocalization::getLocalizedURL("en", null, [], true) }}">--}}
      {{--                                                          English--}}
      {{--                                                        </a>--}}
      {{--                                                    </li>--}}
      {{--                                                </ul>--}}
      {{--                                            </li>--}}

      {{--                                        </ul>--}}
      {{--                                    </div>--}}
      {{--                                </div>--}}

      {{--                                <div class="col-auto text-start language-header-icons">--}}
      {{--                                    <i class="bi bi-chevron-down header-new__dropdown-icon arrow-down px-1"></i>--}}
      {{--                                    <i class="bi bi-chevron-up header-new__dropdown-icon arrow-up px-1"--}}
      {{--                                       style="display: none"></i>--}}
      {{--                                </div>--}}

      {{--                            </div>--}}

      {{--                        </div>--}}
      {{--                    @endif--}}

      {{--                    <div class="col-auto text-xxl-center text-xl-end cabinet">--}}
      {{--                        @if(Auth::check())--}}
      {{--                            <div class="dropdown">--}}
      {{--                                <a class="nav-link" href="#" id="profileDropdown" role="button"--}}
      {{--                                   data-bs-toggle="dropdown"--}}
      {{--                                   aria-expanded="false">--}}
      {{--                                    @if(Auth::user()->profile->photo_id !=null)--}}
      {{--                                        <img src="/storage_/{{Auth::user()->profile->photo_path}}"--}}
      {{--                                             class="profile-photo_icon rounded-circle">--}}
      {{--                                    @else--}}
      {{--                                        <i class="bi bi-person-circle header-new__icons"></i>--}}
      {{--                                        Личный кабинет--}}
      {{--                                    @endif--}}
      {{--                                </a>--}}

      {{--                                <ul class="dropdown-menu" aria-labelledby="profileDropdown">--}}
      {{--                                    @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))--}}
      {{--                                        <a class="dropdown-item"--}}
      {{--                                           href="{{route('Client.service.list')}}">@lang('messages.layouts.personal_services')</a>--}}
      {{--                                        <a class="dropdown-item"--}}
      {{--                                           href="{{route('profile.documentList')}}">@lang('messages.layouts.personal_documents')</a>--}}
      {{--                                        <a class="dropdown-item"--}}
      {{--                                           href="{{route('profile.bookkeeping')}}">@lang('messages.layouts.personal_bookkeeping')</a>--}}
      {{--                                        <a class="dropdown-item"--}}
      {{--                                           href="{{route('profile')}}">@lang('messages.layouts.personal_area')</a>--}}

      {{--                                    @endif--}}

      {{--                                    <a class="dropdown-item" href="{{route('logout')}}"--}}
      {{--                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}
      {{--                                    >--}}
      {{--                                        @lang('messages.layouts.logout')</a>--}}

      {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
      {{--                                          style="display: none;">--}}
      {{--                                        @csrf--}}
      {{--                                    </form>--}}
      {{--                                </ul>--}}
      {{--                            </div>--}}
      {{--                        @else--}}
      {{--                            <button class="header-new__btn px-0 login">--}}
      {{--                                <i class="bi bi-person-circle header-new__icons"></i>--}}
      {{--                                Личный кабинет--}}
      {{--                            </button>--}}

      {{--                            <button class="header-new__btn-white px-0 login">--}}
      {{--                                <i class="bi bi-person-circle header-new__icons"></i>--}}
      {{--                                Личный кабинет--}}
      {{--                            </button>--}}
      {{--                        @endif--}}
      {{--                    </div>--}}


      {{--                    @if((Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client)) || !Auth::check())--}}
      {{--                    <!-- call button -->--}}
      {{--                    <div class="col-xxl-2 text-xxl-end header-new__btn_burger col-xl-2 text-xl-end">--}}
      {{--                        <button class="btn btn-success" id="phoneDropdown" data-bs-toggle="modal"--}}
      {{--                                data-bs-target="#consultModal"--}}
      {{--                                aria-expanded="false">--}}
      {{--                            <i class="bi bi-telephone-fill me-2" style="color: white"></i>--}}
      {{--                            Заказать звонок--}}
      {{--                        </button>--}}
      {{--                    </div>--}}
      {{--                    @endif--}}
      {{--                </div>--}}

      {{--            </nav>--}}

      <nav class="new_header">
        <div>
          <div class="new_header_logo">
            <a href="/">
              <img src="{{asset('/new/images/icons/logo.png')}}" alt="license"/>
            </a>
          </div>
          <div class="new_header_menu d-none d-sm-flex">
            <ul>
              @include('layouts.menu')
            </ul>
          </div>
        </div>
        <div class="d-none d-sm-flex">
          @include('new.partials.header_phone_login')
        </div>
        <div class="d-flex d-sm-none">
          <div class="new_mobile_header_phone_call callMe" data-bs-toggle="modal"
               data-bs-target="#consultModal">
            <img src="{{asset('/new/images/icons/new/phone.svg')}}" alt="phone"/>
          </div>
          <div class="new_mobile_header_menu">
          </div>
        </div>
      </nav>
    </div>
  </div>

  @php
    $_categoryList = App\Data\Service\Dal\ServiceCategoryDal::getServiceCategoryWithoutSystemList(false, false, 1);
    foreach($_categoryList as $_category){
        $_catalogRootNode = App\Data\Catalog\Dal\ServiceCategoryCatalogDal::getByServiceCategory($_category->id, true);
        $_category->catalogItemList = collect($_catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name');
    }
  @endphp

  <div class="new_main_menu w-100">
    <div class="container " style="max-width: 1440px">
      <div class="new_main_menu_panel">
        <div class="new_main_menu_panel_main">
          <div class="new_main_menu_panel_main_item">
            <img src="{{asset('/new/images/menu/license.png')}}" alt="license"/>
            <span>Лицензирование</span>
            <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}" alt="arrow_right"/>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/company_register.png')}}" alt="company_register"/>
              <span>Регистрация компании</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/legal_support.png')}}" alt="legal_support"/>
              <span>Юридическое сопровождение</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/account_support.png')}}" alt="account_support"/>
              <span>Бухгалтерский аутсорсинг</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/visa_c3_c5.png')}}" alt="visa_c3_c5"/>
              <span>Получение визы С3 и С5</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/additional_services.png')}}" alt="additional_services"/>
              <span>Дополнительные услуги</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/company_register_sez.png')}}"
                   alt="company_register_sez"/>
              <span>Регистрация компаний в СЭЗ и МФЦА</span>
            </a>
          </div>
          <div class="new_main_menu_panel_main_item">
            <a href="#">
              <img src="{{asset('/new/images/menu/bank_account.png')}}" alt="bank_account"/>
              <span>Открытие банковских счетов</span>
            </a>
          </div>

        </div>

        <div class="new_main_menu_panel_sub">
          @foreach($_categoryList as $category)
            <div class="new_main_menu_panel_sub_category">
              <div class="new_main_menu_panel_sub_category_header">
                {{$category->name}}
              </div>
              <div class="new_main_menu_panel_sub_category_list">
                @foreach($category->catalogItemList as $catalogItem)
                  <div class="new_main_menu_panel_sub_category_list_item">
                    <a
                      href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                      title="{{$catalogItem->name}}"
                    >
                      {{$catalogItem->name}}
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="new_mobile_main_menu w-100">
    <div class=" w-100">
      <div class="new_mobile_main_menu_extra_function">
        @include('new.partials.header_phone_login')
      </div>

      <div class="new_mobile_main_menu_panel">
        <ul class="new_mobile_main_menu_panel_nav">
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              Услуги
            </a>
            <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}" alt="arrow_right"/>
            <ul class="new_mobile_main_menu_panel_nav_sub">
              <li class="new_mobile_main_menu_panel_nav_item">
                <a class="new_mobile_main_menu_panel_nav_link new_mobile_main_menu_panel_nav_sub_close"
                   href="#">
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_left.svg')}}"
                       alt="arrow_right"/>
                  Услуги
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/license.png')}}" alt="license"/>
                    Лицензирование
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
                <ul class="new_mobile_main_menu_panel_nav_sub">
                  <li class="new_mobile_main_menu_panel_nav_item">
                    <a class="new_mobile_main_menu_panel_nav_link new_mobile_main_menu_panel_nav_sub_close"
                       href="#">
                      <img class="arrow" src="{{asset('/new/images/icons/new/arrow_left.svg')}}"
                           alt="arrow_right"/>
                      Лицензирование
                    </a>
                  </li>

                  @foreach($_categoryList as $category)
                    <li class="new_mobile_main_menu_panel_nav_item">
                      <a href="#" class="new_mobile_main_menu_panel_nav_link">
                        {{$category->name}}
                        <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                             alt="arrow_right"/>
                      </a>
                      <ul class="new_mobile_main_menu_panel_nav_sub">
                        <li class="new_mobile_main_menu_panel_nav_item">
                          <a class="new_mobile_main_menu_panel_nav_link new_mobile_main_menu_panel_nav_sub_close"
                             href="#">
                            <img class="arrow" src="{{asset('/new/images/icons/new/arrow_left.svg')}}"
                                 alt="arrow_right"/>
                            {{$category->name}}
                          </a>
                        </li>
                        @foreach($category->catalogItemList as $catalogItem)
                          <li class="new_mobile_main_menu_panel_nav_item">
                            <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                               class="new_mobile_main_menu_panel_nav_link">
                              {{$catalogItem->name}}
                              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                                   alt="arrow_right"/>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/company_register.png')}}"
                         alt="company_register"/>
                    Регистрация компании
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/legal_support.png')}}" alt="legal_support"/>
                    Юридическое сопровождение
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/account_support.png')}}"
                         alt="account_support"/>
                    Бухгалтерский аутсорсинг
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/visa_c3_c5.png')}}" alt="visa_c3_c5"/>
                    Получение визы С3 и С5
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/additional_services.png')}}"
                         alt="additional_services"/>
                    Дополнительные услуги
                  </div>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/company_register_sez.png')}}"
                         alt="company_register_sez"/>
                    Регистрация компаний в СЭЗ и МФЦА
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
              <li class="new_mobile_main_menu_panel_nav_item">
                <a href="#" class="new_mobile_main_menu_panel_nav_link">
                  <div>
                    <img src="{{asset('/new/images/menu/bank_account.png')}}" alt="bank_account"/>
                    Открытие банковских счетов
                  </div>
                  <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                       alt="arrow_right"/>
                </a>
              </li>
            </ul>
          </li>
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              О компании
              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                   alt="arrow_right"/>
            </a>
          </li>
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              Блог
              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                   alt="arrow_right"/>
            </a>
          </li>
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              Отзывы
              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                   alt="arrow_right"/>
            </a>
          </li>
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              FAQ
              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                   alt="arrow_right"/>
            </a>
          </li>
          <li class="new_mobile_main_menu_panel_nav_item">
            <a href="#" class="new_mobile_main_menu_panel_nav_link">
              Партнерам
              <img class="arrow" src="{{asset('/new/images/icons/new/arrow_right.svg')}}"
                   alt="arrow_right"/>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

</header>
<div class="modals">
  <div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 520px; margin-top: 80px;">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden;">
        <button type="button" class="btn modal_close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 16px; right: 16px; z-index: 10; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; background: #F5F5F5; border-radius: 50%; border: none; cursor: pointer; transition: all 0.2s;">
          <i class="bi bi-x" style="font-size: 18px; color: #191E1D;"></i>
        </button>

          <div class="modal-body" style="padding: 40px 32px 32px;">
            <h3 class="modals__title-head" style="font-family: 'Manrope', sans-serif; font-size: 24px; font-weight: 600; color: #191E1D; margin-bottom: 24px; line-height: 1.3; text-align: center;">Менеджер перезвонит и проконсультирует вас</h3>
            {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'callMe']) !!}
            <input type="hidden" name="tags" value="Callback">
            <input type="hidden" name="comment" value="Заказ звонка">
            <input type="hidden" name="source_page" id="callback_source_page" value="">
            <input type="hidden" name="button_text" id="callback_button_text" value="">
            <div class="col-12" style="margin-bottom: 20px;">
              <div class="row" style="gap: 16px; margin: 0;">
                <div class="col-12" style="padding: 0;">
                  <input type="text" class="form-control modals__input" name="name"
                         placeholder="Ваше имя" required
                         style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s; margin-bottom: 0;">
                </div>
                <div class="col-12" style="padding: 0;">
                  <input type="text" class="form-control modals__input" name="phone"
                         placeholder="Ваш телефон*" required
                         style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s;">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success modals__success_btn" style="width: 100%; padding: 14px; background: #279760; color: #FFFFFF; border: none; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-bottom: 16px;">Отправить</button>
            <p class="modals__title-description" style="font-family: 'Manrope', sans-serif; font-size: 12px; color: #6F6F6F; text-align: center; margin: 0; line-height: 1.4;">Нажимая кнопку отправить вы даете разрешение на обработку персональных данных</p>
            {!! Form::close() !!}
          </div>

      </div>
    </div>
  </div>
  
  <style>
    #consultModal .modal-dialog {
        margin-top: 80px !important;
    }
    
    #consultModal .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    #consultModal .modals__input:focus {
        outline: none;
        border-color: #279760;
        box-shadow: 0 0 0 3px rgba(39, 151, 96, 0.1);
    }
    
    #consultModal .modals__success_btn:hover {
        background: #1e7a50 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(39, 151, 96, 0.3);
    }
    
    #consultModal .modals__success_btn:active {
        transform: translateY(0);
    }
    
    #consultModal .modal_close:hover {
        background: #E8E8E8 !important;
    }
    
    @media (max-width: 576px) {
        #consultModal .modal-dialog {
            margin: 20px;
            max-width: calc(100% - 40px);
        }
        
        #consultModal .modal-body {
            padding: 32px 24px 24px !important;
        }
    }
  </style>
  @php
    if(optional($errors)->login){
        $loginError = $errors->login;
    }
    if(optional($errors)->register){
        $registerError = $errors->register;
    }
  @endphp
  @include('new.partials.modal.login', ['loginError' => $loginError, 'registerError' => $registerError])

</div>
<div id="video-overlay" class="video-overlay">
  <a class="video-overlay-close">&times;</a>
</div>

@section('header-js')
  <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
  <script>
    function showLoginTab(activeTabId, clickedElm){
      $('.new_modal_login_main_tab_header_item').removeClass('active')
      $(clickedElm).addClass('active')

      $('.new_modal_login_main_tab_pane').removeClass('active')
      $(activeTabId).addClass('active')
    }

    function setRecaptcha(formId){
      grecaptcha.ready(function () {
        grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'submit'}).then(function (token) {
          $(formId).prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
          $(document).off('submit', formId)
          $(formId).unbind('submit').submit();
        });
      });
    }

    $(document).ready(function () {
      $('body').click((e) => {
        // e.preventDefault();
        // e.stopPropagation();
        $('.menu_services').removeClass('open')
        $('.new_main_menu').removeClass('open')
        $('.new_mobile_header_menu').removeClass('open')
        $('.new_mobile_main_menu').removeClass('open')
        $('body').removeClass('menu_open')
      })

      $('.menu_services').click((e) => {
        e.preventDefault();
        e.stopPropagation();
        $('.menu_services').toggleClass('open')
        $('.new_main_menu').toggleClass('open')
        $('body').toggleClass('menu_open')
      })

      $('.new_mobile_header_menu').click((e) => {
        e.preventDefault();
        e.stopPropagation();
        $('.new_mobile_header_menu').toggleClass('open')
        $('.new_mobile_main_menu').toggleClass('open')
        $('body').toggleClass('menu_open')
      })

      $('.new_mobile_main_menu_panel_nav_sub_close').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        $(this).parent().parent().removeClass('is-active');
      });

      $('.new_mobile_main_menu_panel_nav_link').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        $(this).siblings().addClass('is-active');
      })


      $('input[name="phone"]').inputmask("+7 (999) 999-99-99");

      // Обработчик кликов на телефонные ссылки
      $(document).on('click', 'a[href^="tel:"]', function(e) {
          e.preventDefault();
          var $link = $(this);
          var buttonText = $link.text().trim() || $link.find('span').text().trim() || 'Телефон';
          var sourcePage = window.location.href;
          
          // Заполняем скрытые поля формы
          $('#callback_source_page').val(sourcePage);
          $('#callback_button_text').val(buttonText);
          
          // Открываем модальное окно
          var modal = new bootstrap.Modal(document.getElementById('consultModal'));
          modal.show();
          
          // Отправляем событие в Google Analytics
          if (typeof gtag !== 'undefined') {
              gtag('event', 'click', {
                  'event_category': 'phone',
                  'event_label': buttonText,
                  'page_path': sourcePage
              });
          }
      });

      $('.callMe').submit(function () {

        $('.modals__success_btn', this).attr('disabled', true);
        $(this).ajaxSubmit({
          success: function () {
            gtag('event', 'send', {'event_category': 'callback'});
            $('#consultModal .modals__success_btn').attr('disabled', false);

            $('#consultModal input').val('')
            $('#consultModal .btn-x').click()

            setTimeout(() => {
              alert("@lang('messages.client.service_create')")
            }, 500);
          }
        })

        return false
      })

      $('#new_modal_login_main_tab_login').click(function () {
        showLoginTab('#login-tab-pane', this)
      })

      $('#new_modal_login_main_tab_register').click(function () {
        showLoginTab('#registration-tab-pane', this)
      })

      $('.pills-legalentity-tab').click(function () {
        $('.pills-legalentity-tab').removeClass('active')
        $(this).addClass('active')

        $('.new_modal_login_main_tab_pane_register').removeClass('active')
        $($(this).data('form')).addClass('active')
      })

      @if(sizeof($loginError) > 0 || sizeof($registerError) > 0 )
        showLoginTab('{{sizeof($registerError) > 0 ? '#registration-tab-pane' : '#login-tab-pane'}}', '{{sizeof($registerError) > 0 ? '#new_modal_login_main_tab_register' : '#new_modal_login_main_tab_login'}}')
        $('.new_header_login').click()
      @endif

      $(document).on('submit', '#legalentityForm1', function (event) {
        event.preventDefault();

        setRecaptcha('#legalentityForm1')
      });

      $(document).on('submit', '#legalentityForm', function (event) {
        event.preventDefault();

        setRecaptcha('#legalentityForm')
      });


    });

    function setAdditionalDataToSendForm(tag, comment) {
      let parent = $('#consultModal');
      $('input[name="tags"]', parent).val(tag)
      $('input[name="comment"]', parent).val(comment)
    }
  </script>


@endsection
