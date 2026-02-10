@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.sale_manager.potential_client.title')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="services" class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>@lang('messages.sale_manager.request_date')</th>
                                <th>@lang('messages.sale_manager.potential_client.name')</th>
                                <th>@lang('messages.sale_manager.email')</th>
                                <th>@lang('messages.sale_manager.potential_client.phone')</th>
                                <th>@lang('messages.sale_manager.potential_client.serviceName')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($potentialClientList as $potentialClient)
                                <tr>
                                    <td>{{\App\Data\Helper\Assistant::formatDate($potentialClient->created_at) }}</td>
                                    <td>{{$potentialClient->name}}</td>
                                    <td>{{$potentialClient->email}}</td>
                                    <td><a href="tel:{{$potentialClient->phone}}">{{$potentialClient->phone}}</a></td>
                                    <td>
                                        @foreach($potentialClient->serviceList as $service)
                                            <div>{{$service->name}}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(!$potentialClient->is_account_generate)
                                                    <a href="{{route('sale_manager.potential_client.createCabinet', ['potentialClientId' => $potentialClient->id])}}" class="dropdown-item cursor-pointer">
                                                        {{trans('messages.sale_manager.potential_client.create_cabinet')}}
                                                    </a>
                                                @endif
                                                @if(!$potentialClient->is_contacted)
                                                    <a href="{{route('sale_manager.potential_client.setContacted', ['potentialClientId' => $potentialClient->id])}}" class="dropdown-item cursor-pointer">
                                                        {{trans('messages.sale_manager.potential_client.is_contacted')}}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row padding-t-15">
                            <div class="col">
                                {{ $potentialClientList->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection