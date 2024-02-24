@extends('new.layouts.app')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.sale_manager.commercial_offer.title')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-success float-right mb-2" href="{{route('sale_manager.commercial_offer.create')}}">Создать</a>
                        <table id="services" class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>@lang('messages.sale_manager.request_date')</th>
                                <th>@lang('messages.sale_manager.commercial_offer.name')</th>
                                <th>@lang('messages.sale_manager.email')</th>
                                <th>@lang('messages.sale_manager.commercial_offer.phone')</th>
                                <th>@lang('messages.sale_manager.commercial_offer.type')</th>
                                <th>@lang('messages.sale_manager.commercial_offer.serviceName')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commercialOfferList as $commercialOffer)
{{--                                {{dd($commercialOffer)}}--}}
                                <tr>
                                    <td>{{\App\Data\Helper\Assistant::formatDate($commercialOffer->created_at) }}</td>
                                    <td>{{$commercialOffer->name}}</td>
                                    <td>{{$commercialOffer->email}}</td>
                                    <td><a href="tel:{{$commercialOffer->phone}}">{{$commercialOffer->phone}}</a></td>
                                    <td>{{$commercialOffer->type->name}}</td>

                                    <td>
                                        @foreach($commercialOffer->serviceList as $service)
                                            <div>{{$service->service->name}}</div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row padding-t-15">
                            <div class="col">
                                {{ $commercialOfferList->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection