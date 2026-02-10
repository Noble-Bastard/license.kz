@extends('new.layouts.app')

@section('meta-description')
    {{$catalogRootNode->name}}
@endsection

@section('header__background')
    <div class="header__background header__background-{{$serviceCategory->id}}"></div>
@endsection
@section('footer__background')footer__background-{{$serviceCategory->id}}@endsection

@section('content')
    <div class="container mb-5">
        <div class="row services-background">
            <div class="col-12">
                <h1 class="title-main pt-3">
                    {{$serviceCategory->description}}
                </h1>

                <div class="service subLicense pt-3">
                    <div class="subLicense-label mb-3">@lang('messages.pages.services.activity_licensing'):</div>
                    <h2 class="subLicense-title mb-4">{{$catalogRootNode->name}}</h2>

                    <div class="row justify-content-end">
                        <div class="col-12 col-md-11">
                            @if($catalogRootNode->id === 400)
                                <p class="mt-1 mb-3">@lang('messages.pages.services.note_400')</p>
                            @endif
                            <div class="subLicense-subtitle mb-3">@lang('messages.pages.services.mark_necessary'):
                            </div>
                            <form method="get" class="compareServiceForm"
                                  action="{{route('services.servicesCompare')}}">
                                @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
                                    <div class="accordion col-12 subLicense-group mb-3"
                                         id="accordion-subLicense-{{$catalogRootNode->id}}_{{$loop->index}}">

                                        <div class="subLicense-group_header row"
                                             id="subLicense-group-heading-{{$catalogItem->id}}">
                                            <div class="col-12 p-0">
                                                <div class="row no-gutters">
                                                    <div class="col-md-8 col-xl-9 subLicense-group_header-title"
                                                         data-toggle="collapse"
                                                         data-target="#subLicense-group-{{$catalogItem->id}}"
                                                         aria-expanded="false"
                                                         aria-controls="subLicense-group-{{$catalogItem->id}}">{{$catalogItem->name}}</div>
                                                    <div class="col-md-4 col-xl-3 text-md-right">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class=" select_all_in_group"
                                                                   id="select_all_in_group_item_{{$catalogItem->id}}">
                                                            <label class="custom-control-label"
                                                                   for="select_all_in_group_item_{{$catalogItem->id}}">@lang('messages.all.check_all')
                                                                (<span class="select_in_group_cnt">0</span>/{{$catalogItem->childNodeList->where('is_visible', 1)->count() + $catalogItem->serviceCatalogList->count()}}
                                                                )</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($catalogItem->catalog_node_type_id == 1)
                                            <div id="subLicense-group{{$catalogItem->id}}" class="subLicense-group_body collapse row"
                                                 aria-labelledby="subLicense-group-heading-{{$catalogItem->id}}"
                                                 data-parent="#accordion-subLicense-{{$catalogRootNode->id}}_{{$loop->index}}"
                                            >

{{--                                                <form method="get" class="compareServiceForm"--}}
{{--                                                      action="{{route('services.servicesCompare')}}">--}}

                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input select_all_service_item"
                                                               id="select_all_service_item_{{$catalogItem->id}}" type="checkbox">
                                                        <label class="form-check-label"
                                                               for="select_all_service_item_{{$catalogItem->id}}">
                                                            @lang('messages.all.check_all')
                                                        </label>
                                                    </div>

                                                    <hr/>

                                                    @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])

                                                    @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])
                                                    <button type="submit" class="btn btn-success mt-2 compareServiceBtn"
                                                            disabled="disabled">
                                                        @lang('messages.all.show')
                                                    </button>
{{--                                                </form>--}}
                                            </div>
                                        @elseif($catalogItem->catalog_node_type_id == 8)
                                            <div id="subLicense-group-{{$catalogItem->id}}" class="collapse row subLicense-group_container pb-1 "
                                                 aria-labelledby="subLicense-group-heading-{{$catalogItem->id}}"
                                            >
                                                @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'preSelected' => $preSelected])

                                                @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                {{--                                @include('catalog._catalogServiceList', ['catalogItem' => $catalogRootNode, 'singleNode' => true, 'preSelected' => $preSelected])--}}

                                {{--                                @include('catalog._catalogList', ['catalogRootNode' => $catalogRootNode, 'preSelected' => $preSelected])--}}

                                <div class="row mt-4">
                                    <div class="col-12 text-center text-md-left">
                                        <button type="button"
                                                class="btn btn-default btn-lg select_all_service_item mr-3 mb-3 mb-sm-0">@lang('messages.all.check_all')</button>

                                        <span class="select_all_service_cnt d-none d-sm-inline">@lang('messages.pages.services.selected'): </span>
                                        <span class="select_all_service_cnt-span d-none d-sm-inline">0</span>
                                        <div class="mb-3 d-block d-sm-none">
                                            <span class="select_all_service_cnt"> @lang('messages.pages.services.selected'): </span>
                                            <span class="select_all_service_cnt-span">0</span>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-success btn-lg compareServiceBtn float-md-right text-uppercase"
                                                disabled="disabled">
                                            @lang('messages.all.next')
                                            <i class="ml-2 fal fa-long-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let selectedServices = 0

        ////activeTab('services');

        $(function () {
            $(document).on('click', '.subLicense-group .select_all_in_group', function (e) {
                e.stopPropagation();

                let isChecked = this.checked
                let licenseGroup = $(this).parents('.subLicense-group')[0];

                let serviceItem = $('.service_item', licenseGroup);
                serviceItem.prop("checked", this.checked);

                let select_all_in_group = $('.select_all_in_group', licenseGroup);
                select_all_in_group.prop("checked", this.checked);

                setSelectedItemInGroupCnt(licenseGroup, isChecked ? serviceItem.length : 0);

                $('.subLicense-group', licenseGroup).each(function () {
                    $('.select_in_group_cnt', this).html(isChecked ? $('.select_in_group_cnt', this).length : 0);
                });

                changeParentCnt(licenseGroup, isChecked ? serviceItem.length : serviceItem.length*-1)
            });

            $(document).on('click', '.subLicense-group .service_item', function (e) {
                e.stopPropagation();

                let licenseGroup = $(this).parents('.accordion.subLicense-group')[0];

                let selectedItemCnt = $('.service_item:checked', licenseGroup).length;
                let allItemCnt = $('.service_item', licenseGroup).length;

                setSelectedItemInGroupCnt(licenseGroup, selectedItemCnt);

                $('.select_all_in_group', licenseGroup).prop("checked", selectedItemCnt === allItemCnt);
            });

            $(document).on('click', '.select_all_service_item', function (e) {
                e.stopPropagation();

                $('.accordion.subLicense-group .select_all_in_group').each(function (index, value) {
                    $(this).click();
                });

                $('.singleNode  .service_item').each(function (index, value) {
                    $(this).click();
                });
            });
        });

        function setSelectedItemInGroupCnt(group, cnt) {
            $('.select_in_group_cnt', group).html(cnt);

            let selectedServices = $('.service_item:checked').length
            $('.select_all_service_cnt-span').html(selectedServices);

            $('.compareServiceBtn').attr('disabled', selectedServices <= 0)
        }

        function changeParentCnt(item, cnt){
            let catalog_list = $(item).parents('.catalog_list')
            if(catalog_list.length > 0){
                let licenseGroup = $(catalog_list).parents('.accordion.subLicense-group')[0];
                let elm = $('.subLicense-group_header .select_in_group_cnt', licenseGroup)[0]
                $(elm).html($(elm).html()*1 + cnt)
            }
        }
    </script>
@endsection