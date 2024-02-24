@extends('new.layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('services.categoryList')}}">@lang('messages.services.services')</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$serviceCategory->description}}</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row services-background">
        <div class="col-12">
            <div class="card">
                <div class="title-main">{{$serviceCategory->description}}

                </div>

                <div class="card-body">

                    <div class="row catalog_list free_zone_list">
                        @include('services._freeZoneList', ['freeZoneList' => $freeZoneList])
                    </div>

                    <div class="row pt-3 justify-content-center text-center  form-group">
                        <div class="col-3 cursor-pointer show_all">
                            <hr/>
                            @lang('messages.admin.serviceCategory.freeZone.show_all')<i class="fas pl-2 fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center secondary-header pt-3">
                            @lang('messages.admin.serviceCategory.freeZone.search_header')
                        </div>
                    </div>

                    <div class="row pt-3 justify-content-center form-group">

                        <div class="col-3">
                            <select class="form-control" id="activityFilter">
                                <option></option>
                                @foreach($activityList as $activity)
                                    <option value="{{$activity->id}}">{{$activity->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select class="form-control" id="licenseFilter">
                                <option></option>
                                @foreach($licenseList as $license)
                                    <option value="{{$license->id}}">{{$license->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select class="form-control" id="countryRegionFilter">
                                <option></option>
                                @foreach($countryRegionList as $countryRegion)
                                    <option value="{{$countryRegion->id}}">{{$countryRegion->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    <script>
        $(function() {

            $(document).on('click', '.catalog_item', function () {
               window.open("/serviceGroup/" + $(this).data('servicecategoryid'));
            });

            $(document).on('click', '.show_all', function () {
                let activityTypeId = $("#activityFilter").val();
                let licenseTypeId = $("#licenseFilter").val();
                let countryRegionId = $("#countryRegionFilter").val();
                getFreeZoneData(activityTypeId, licenseTypeId, countryRegionId,1);
            });


            $("#activityFilter").select2({
                placeholder: "{{ trans('messages.admin.serviceCategory.freeZone.businessActivityType') }}",
                allowClear: true
            }).on('change', function () {
                let activityTypeId = this.value;
                let licenseTypeId = $("#licenseFilter").val();
                let countryRegionId = $("#countryRegionFilter").val();
                getFreeZoneData(activityTypeId, licenseTypeId, countryRegionId, 0);
            });

            $("#licenseFilter").select2({
                placeholder: "{{ trans('messages.admin.serviceCategory.freeZone.businessLicenseType') }}",
                allowClear: true
            }).on('change', function () {
                let activityTypeId = $("#activityFilter").val();
                let licenseTypeId = this.value;
                let countryRegionId = $("#countryRegionFilter").val();
                getFreeZoneData(activityTypeId, licenseTypeId, countryRegionId,0);
            });

            $("#countryRegionFilter").select2({
                placeholder: "{{ trans('messages.admin.serviceCategory.freeZone.location') }}",
                allowClear: true
            }).on('change', function () {
                let activityTypeId = $("#activityFilter").val();
                let licenseTypeId = $("#licenseFilter").val();
                let countryRegionId = this.value;
                getFreeZoneData(activityTypeId, licenseTypeId, countryRegionId,0);
            });


            function getFreeZoneData(activityTypeId, licenseTypeId, countryRegionId, showAll){

                if (showAll == 1)
                    $('.show_all').hide();
                else
                    $('.show_all').show();

                $.ajax({
                    type: 'GET',
                    url: '{{route('common_data.getFreeZonePartial')}}',
                    data: {
                        'activityTypeId': activityTypeId,
                        'licenseTypeId': licenseTypeId,
                        'countryRegionId': countryRegionId,
                        'showAll': showAll
                    },
                    success: function (data) {
                        $(".catalog_list").html(data);
                    }
                });
            }

        });
    </script>
@endsection