@extends('new.layouts.app')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">@lang('messages.admin.serviceCarousel.create_carousel')

                    </div>

                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('admin.mainServiceCarousel.create')}}"><i
                                            class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="countries" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.admin.countries.country')</th>
                                    <th>@lang('messages.all.service_name')</th>
                                    <th>@lang('messages.all.order_num')</th>
                                    <th>@lang('messages.all.actions')</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mainServiceCarouselList as $mainServiceCarousel)
                                    <tr>
                                        <td class="text-center">{{$mainServiceCarousel->country_name }}</td>
                                        <td class="text-center">{{$mainServiceCarousel->service_name }}</td>
                                        <td class="text-center">{{$mainServiceCarousel->order_no }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.serviceCarousel.edit', ['id' => $mainServiceCarousel->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.mainServiceCarousel.destroy', $mainServiceCarousel->id)}}"
                                                       data-method="delete">@lang('messages.all.delete')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $mainServiceCarouselList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script>
        //activeTab('main_service_carousel-list');
    </script>
@endsection