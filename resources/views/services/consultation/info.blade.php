@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row services-background justify-content-center mt-5">
            @if(session()->has('new_order'))
                <div class="col-12 text-center">
                    <h1 class="text-center">Оплата прошла успешно. Номер заявки - {{session()->get('new_order')}}</h1>
                </div>
            @else
                <div class="col-12 text-justify">
                    <p>@lang('messages.pages.services-page.consultation.info.data1')</p>
                    <p>@lang('messages.pages.services-page.consultation.info.data2')</p>
                    <p>@lang('messages.pages.services-page.consultation.info.data3')</p>
                    <p>@lang('messages.pages.services-page.consultation.info.data4')</p>
                    <p>@lang('messages.pages.services-page.consultation.info.data5')</p>
                    <p>@lang('messages.pages.services-page.consultation.info.data6')</p>
                </div>
                <div class="col-12 text-center">
                    <a class="btn btn-success"
                       href="{{route('service.consultation.form')}}">@lang('messages.all.details')</a>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('js')
    <script>
        //activeTab('services');
    </script>
@endsection