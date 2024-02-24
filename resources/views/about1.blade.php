@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                <div class="title-main">
                    @lang('messages.pages.about.title')

                </div>

                <div class="card-body about-us-body">
                    <ul class="title-menu text-center text-md-left">
                        <li>
                            <a href="#about_us">
                                @lang('messages.pages.about.about_us')
                            </a>
                        </li>
                        <li>
                            <a href="#company_face">
                                @lang('messages.pages.about.company_face')
                            </a>
                        </li>
                        <li>
                            <a href="#development_plan">
                                @lang('messages.pages.about.development_plan')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#reviews">
                                @lang('messages.pages.about.reviews')
                            </a>
                        </li>
                    </ul>
                    <div class="mt-6 about-us" id="about_us" role="tabpanel"
                         aria-labelledby="about_us-tab">
                        <div class="row justify-content-center">
                            <div class="col-12 mb-3 mb-md-0 col-sm-12 col-md-6 col-lg-5">
                                <div class="row">
                                    <div class="col-3 col-sm-2 col-md-3">
                                        <img src="{{asset('images/first_office.png')}}"/>
                                    </div>
                                    <div class="col-9 col-sm-10 col-md-9 v-midle">
                                        <span>
                                            @lang('messages.pages.about.first_office')
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                                <div class="row">
                                    <div class="col-3 col-sm-2 col-md-3">
                                        <img src="{{asset('images/maps-and-flags.png')}}"/>
                                    </div>
                                    <div class="col-9 col-sm-10 col-md-9 v-midle">
                                        <span>@lang('messages.pages.about.office_maps')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-12">
                                <div class="row">
                                    @foreach($countryList as $country)
                                        <div class="card col-4 text-center border-0">
                                            <div class="row justify-content-center">
                                                <div class="col-8">
                                                    <img class="card-img-top"
                                                         src="{{asset('images/flag_'.$country->code.'.png')}}"
                                                         alt="{{$country->name}}">
                                                </div>
                                                <div class="col-12">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$country->name}}</h5>
                                                        @foreach($country->cityList as $city)
                                                            <p class="card-text m-0">{{$city->value}}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-3">
                            <div class="col-12 d-flex col-sm-7 v-midle">
                                <span class="compani-info">
                                    @lang('messages.pages.about.about_us_text')
                                </span>
                            </div>
                            <div class="col-4 d-none d-sm-flex col-sm-5 d-sm-flex">
                                <img src="{{asset('images/Group (3).png')}}">
                            </div>
                        </div>
                        <div class="row justify-content-center text-center d-md-none mb-4">
                            <div class="col-5 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/step1.png')}}" class="img-fluid">
                            </div>
                            <div class="col-2 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-5 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/step2.png')}}" class="img-fluid">
                            </div>
                            <div class="col-5 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/step3.png')}}" class="img-fluid">
                            </div>
                            <div class="col-2 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-5 mb-3  p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/step4.png')}}" class="img-fluid">
                            </div>
                            <div class="col-5 p-0 px-sm-3 align-self-center">
                                <img src="{{asset('images/step5.png')}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="row justify-content-center flex-nowrap mb-4 d-none d-md-flex">
                            <div class="col-lx-2 align-self-center">
                                <img src="{{asset('images/step1.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-1 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-2 align-self-center">
                                <img src="{{asset('images/step2.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-1 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-2 align-self-center">
                                <img src="{{asset('images/step3.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-1 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-2 align-self-center">
                                <img src="{{asset('images/step4.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-1 align-self-center">
                                <img src="{{asset('images/Arrow.png')}}" class="img-fluid">
                            </div>
                            <div class="col-lx-2 align-self-center">
                                <img src="{{asset('images/step5.png')}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-7 col-xl-7">
                                <div class="row mb-4">
                                    <div class="col-12 mb-2 d-md-none text-center">
                                        Конкретные сроки исполнения каждого шага услуг
                                    </div>
                                    <div class=" mb-2 d-none d-lg-flex align-self-end">
                                                <img src="{{asset('images/arrows.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-12 mb-2 d-none d-md-block d-lg-none">
                                        <img src="{{asset('images/arrows2.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-12 text-center mb-2 d-md-none">
                                        <img src="{{asset('images/arrow3.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-12 text-center mb-2 d-md-none">
                                        <img src="{{asset('images/arrow2.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-12 text-center mb-2 d-md-none">
                                        <img src="{{asset('images/arrow1.png')}}" class="img-fluid">
                                    </div>

                                    <div class="col-12 d-none d-md-block text-center">
                                        Конкретные сроки исполнения каждого шага услуг
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2 col-md-2 col-lg-1">
                                        <img src="{{asset('images/case.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-10 col-md-10 col-lg-11 info-bottom-txt">
                                        Информация по организации и ведению бизнеса в различных странах предоставлена
                                        максимально развернуто и доступно.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2 col-md-2 col-lg-1">
                                        <img src="{{asset('images/Group.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-10 col-md-10 col-lg-11 info-bottom-txt">
                                        Получение информации и стоимости оказания услуг путем не сложных действий по
                                        введению исходных данных.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2 col-md-2 col-lg-1">
                                        <img src="{{asset('images/clock.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-10 col-md-10 col-lg-11 info-bottom-txt">
                                        Мы ценим ваше время, поэтому мы постарались максимально оптимизировать процесс
                                        получения услуг в офисах нашей компании.
                                        В своей работе мы ставим акцент на конкретных сроках и стоимости исполнения
                                        ваших поручений.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2 col-md-2 col-lg-1">
                                        <img src="{{asset('images/user1.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-10 col-md-10 col-lg-11 info-bottom-txt">
                                        Личный кабинет, с возможностью заказать любую услугу, отслеживать этапы
                                        исполнения, получать и хранить результаты нашей работы.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-2 col-md-2 col-lg-1">
                                        <img src="{{asset('images/user2.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-10 col-md-10 col-lg-11 info-bottom-txt">
                                        Выделенный специально для вас менеджер проекта, который регулирует процесс
                                        получения услуги, являясь связующим звеном между вами и множеством исполнителей
                                        Ipravo.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="mt-5 company-face" id="company_face" role="tabpanel" aria-labelledby="company_face-tab">--}}
{{--                        <div class="row mb-2">--}}
{{--                            <div class="col-12 text-center text-sm-left lable-face">--}}
{{--                                Лицо компании--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row justify-content-center mb-4">--}}
{{--                            @foreach($employeeList->where('employee_position_id', '=', 1) as $employee)--}}
{{--                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">--}}
{{--                                    <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}" class="img-fluid"/>--}}
{{--                                    <span>{{$employee->first_name}} {{$employee->last_name}}</span>--}}
{{--                                    <div>--}}
{{--                                        <strong>{{$employee->employee_position_value}}</strong>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <div class="row justify-content-center mb-4">--}}
{{--                            @foreach($employeeList->where('employee_position_id', '=', 2) as $employee)--}}
{{--                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">--}}
{{--                                    <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}" class="img-fluid"/>--}}
{{--                                    <span>{{$employee->first_name}} {{$employee->last_name}}</span>--}}
{{--                                    <div>--}}
{{--                                        <strong>{{$employee->employee_position_value}}</strong>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <div class="row justify-content-center mb-4">--}}
{{--                            @foreach($employeeList->where('employee_position_id', '=', 3) as $employee)--}}
{{--                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">--}}
{{--                                    <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}" class="img-fluid"/>--}}
{{--                                    <span>{{$employee->first_name}} {{$employee->last_name}}</span>--}}
{{--                                    <div>--}}
{{--                                        <strong>{{$employee->employee_position_value}}</strong>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="mt-5 company-face" id="development_plan" role="tabpanel"
                         aria-labelledby="development_plan-tab">
                        <div class="row mb-2">
                            <div class="col-12 text-center text-sm-left lable-face">
                                План развития
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="col-2 col-md-3 col-md- pr-0 px-md-3 mt-5 align-self-center">
                                        <img src="{{asset('images/gprs.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-5 col-md-8 col-xl-6 geography-hdr text-black mt-5 align-self-center">
                                        Расширение географии
                                    </div>
                                    <div class="col-5 col-md-12 pl-0 pl-md-3 pr-md-0 mt-5 text-center">
                                        <img src="{{asset('images/map.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="row text-center">
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2019</span>
                                        <div class="country">
                                            <span>Украина, Киев</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2019</span>
                                        <div class="country">
                                            <span>Армения, Ереван</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2019</span>
                                        <div class="country">
                                            <span>Кыргыстан, Бишкек</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2020</span>
                                        <div class="country">
                                            <span>Узбекистан, Ташкент</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2020</span>
                                        <div class="country">
                                            <span>Кыргыстан, Бишкек</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2020</span>
                                        <div class="country">
                                            <span>Азербайджан, Баку</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 d-none d-md-flex mt-5">
                                        <span class="lable-face"></span>
                                        <div class="country">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2020</span>
                                        <div class="country">
                                            <span>Беларусь, Минск</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 mt-5">
                                        <span class="lable-face blue">2021</span>
                                        <div class="country">
                                            <span>Страны Еврасоюза</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="row mb-2">
                            <div class="col-12 text-center lable-face reviews text-center text-sm-left mb-3 mb-md-5">
                                Отзывы тех, кто с нами
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 mb-5 text-center">
                                <img src="{{asset('images/ytb.png')}}" class="img-fluid">
                                <div class="mt-3 text-center">
                                    <span>Иван Петров</span>
                                    <div>
                                        <span><strong>Предприниматель</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mb-5 text-center">
                                <img src="{{asset('images/ytb.png')}}" class="img-fluid">
                                <div class="mt-3 text-center">
                                    <span>Иван Петров</span>
                                    <div>
                                        <span><strong>Предприниматель</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mb-5 text-center">
                                <img src="{{asset('images/ytb.png')}}" class="img-fluid">
                                <div class="mt-3 text-center">
                                    <span>Иван Петров</span>
                                    <div>
                                        <span><strong>Предприниматель</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($articleList))
                        @foreach($articleList as $article)
                            {!! $article->content !!}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            //activeTab('about');
        });
    </script>
@endsection