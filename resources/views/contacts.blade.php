@extends('new.layouts.app')

@section('content')

    {{--{{dd($countryList)}}--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">
                    @lang('messages.pages.contacts.title')

                </div>

                <div class="address-block">
                    @foreach($countryList as $country)
                        @if(sizeof($country->company_address) > 0)
                            <div class="row country_company_address">
                                <div class="col-4">
                                    <h3 class="contact_header contact-header">
                                        @if(sizeof($country->company_address) > 1)
                                            <div>@lang('messages.pages.contacts.country_title_many')</div>
                                        @else
                                            <div>@lang('messages.pages.contacts.country_title_one')</div>
                                        @endif
                                        <div class="lable">@lang('messages.pages.contacts.ipravo')</div>
                                        <div> @lang('messages.pages.contacts.in') {{$country->name}}</div>
                                    </h3>
                                </div>
                                <div class="col-8">
                                    <div class="row company_address company-address">
                                        <div class="col-12">
                                            @foreach($country->company_address->chunk(3) as $company_address_chunk)
                                                <div class="row mb-3">
                                                    <div class="card-deck">
                                                        @foreach($company_address_chunk as $company_address)
                                                                <div class="card col-4 border-0">
                                                                    <img src="{{is_null($company_address->photo_path) ? asset('images/no-img.svg') : \Illuminate\Support\Facades\Storage::url($company_address->photo_path)}}"
                                                                         alt="{{$company_address->name}}"
                                                                         class="rounded mx-auto d-block card-img-top">
                                                                    <div class="card-body p-0">
                                                                        <div class="name mt-1">
                                                                            {{$company_address->name}}
                                                                        </div>
                                                                        <div class="address mt-3">
                                                                            {{$company_address->address}}
                                                                        </div>
{{--                                                                        <div class="location mt-3">--}}
{{--                                                                            <a href="#" class="show_location card-link"--}}
{{--                                                                               data-country="{{$country->id}}"--}}
{{--                                                                               data-location="{{$company_address->location}}">--}}
{{--                                                                                @lang('messages.pages.contacts.driving_directions')--}}
{{--                                                                            </a>--}}
{{--                                                                        </div>--}}
                                                                    </div>
                                                                    <div class="card-footer p-0 border-0 bg-white">
                                                                        <div class="location mt-3">
                                                                            <a href="#" class="show_location card-link"
                                                                               data-country="{{$country->id}}"
                                                                               data-location="{{$company_address->location}}">
                                                                                @lang('messages.pages.contacts.driving_directions')
                                                                            </a>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 map map_{{$country->id}} mb-3" id="map_{{$country->id}}"
                                     style="height: 350px; display: none">

                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="border-bottom"></div>
                </div>
{{--                <div class="contacts">--}}
{{--                    <div class="row">--}}

{{--                        <div class="col-4 contacts-links">--}}
{{--                            <div class="">CALL CENTER: +7 747 135 0000</div>--}}
{{--                            <div class="">ПОЧТА: info@ipravo.kz</div>--}}
{{--                            --}}{{--                            <div class="">Месенджеры:</div>--}}
{{--                            --}}{{--                            <div>--}}
{{--                            --}}{{--                                <img class="mr-2 mt-2" src="{{asset('images/whatsapp.png')}}">--}}
{{--                            --}}{{--                                <img class="mr-2 mt-2" src="{{asset('images/telegram.png')}}">--}}
{{--                            --}}{{--                                <img class="mr-2 mt-2" src="{{asset('images/viber.png')}}">--}}
{{--                            --}}{{--                            </div>--}}
{{--                            <div class="">Ipravo в социальных сетях:</div>--}}
{{--                            <div class="">--}}
{{--                                <a href="https://www.instagram.com/ipravokz/" target="_blank">--}}
{{--                                    <img class="mr-2 mt-2" src="{{asset('images/instagram.png')}}">--}}
{{--                                </a>--}}
{{--                                <a href="https://api.whatsapp.com/send?phone=+77471530000" target="_blank">--}}
{{--                                    <img class="mr-2 mt-2" src="{{asset('images/whatsapp.png')}}">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-8 col-md-8 contacts-input-block">--}}
{{--                            <div class="row align-items-end">--}}
{{--                                <call-me></call-me>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                {{--                <div class="card-body">--}}
                {{--                    @if(isset($articleList))--}}
                {{--                        @foreach($articleList as $article)--}}
                {{--                            {!! $article->content !!}--}}
                {{--                        @endforeach--}}
                {{--                    @endif--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        //activeTab('contacts');

        $(function () {
            $('.map').hide();
            $('.show_location').click(function () {
                $('.map').hide();
                $('.map_' + $(this).data('country')).html('').show();
                initMap($(this).data('location'), 'map_' + $(this).data('country'));
            });
        });

        function initMap(officePoint, divId) {
            if (divId !== undefined) {
                if (officePoint === '') {
                    officePoint = '43.231793, 76.959164'
                }
                officePoint = officePoint.split(',');
                let lat = officePoint[0] * 1;
                let lng = officePoint[1] * 1;
                let mkr = {lat: lat, lng: lng};
                let map = new google.maps.Map(document.getElementById(divId), {
                    center: {lat: lat, lng: lng},
                    zoom: 16
                });
                var marker = new google.maps.Marker({position: mkr, map: map});
            }
        }

    </script>
@endsection