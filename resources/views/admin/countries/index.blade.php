@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.admin.countries.countries')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('admin.countries.create')}}"><i
                                            class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="countries" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.admin.countries.country_code')</th>
                                    <th>@lang('messages.admin.countries.country_name')</th>
                                    <th>@lang('messages.admin.countries.country_name_en')</th>
                                    <th>@lang('messages.all.is_visible')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countryList as $countries)
                                    <tr>
                                        <td class="text-center">{{$countries->code }}</td>
                                        <td class="text-center">{{$countries->name }}</td>
                                        <td class="text-center">{{$countries->name_en }}</td>
                                        <td class="text-center">{{$countries->is_visible == 1 ? trans('messages.all.yes') : trans('messages.all.no') }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.countries.edit', ['id' => $countries->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.countries.destroy', $countries->id)}}"
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
                                    {{ $countryList->links() }}
                                </div>
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
        //activeTab('countries-list');
    </script>
@endsection