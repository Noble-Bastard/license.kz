@php
    $subItem = $catalogRootNode->childNodeList->first();
    $preSelected = isset($preSelected) ? $preSelected : null;
@endphp

<div class="catalog_list w-100">
    @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
        @switch($catalogItem->catalog_node_type_id)
            @case(1)
            <a href="{{route('services.catalog.list', ['catalogId'=>$catalogItem->id])}}"
               class="service-group__item">
                {{$catalogItem->name}}
            </a>
            @break
            @case(2)
            <a href="{{route('services.groupList', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
               class="service-group__item">
                {{$catalogItem->name}}
            </a>
            @break
            @case(8)
                        <div class="accordion col-12 subLicense-group @if(!$loop->first) pt-0 @endif"
                             id="accordion-subLicense-{{$catalogRootNode->id}}_{{$loop->index}}">

                            <div class="subLicense-group_header row"
                                 id="subLicense-group-heading-{{$catalogItem->id}}">
                                <div class="col-12 p-0">
                                    <div class="row no-gutters">
                                        <div class="col-md-8 col-xl-9 subLicense-group_header-title" data-toggle="collapse"
                                             data-target="#subLicense-group-{{$catalogItem->id}}" aria-expanded="false"
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

                                    <form method="get" class="compareServiceForm"
                                          action="{{route('services.servicesCompare')}}">

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
                                    </form>
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
            @break
{{--            @case(9)--}}
{{--                    @foreach($catalogRootNode->childNodeList as $catalogItem)--}}
{{--                        @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])--}}
{{--                    @endforeach--}}
{{--            @break--}}
        @endswitch
    @endforeach


    {{--    @if(isset($subItem) && isset($subItem->catalog_node_type_id) && $subItem->catalog_node_type_id != 9 && $subItem->catalog_node_type_id != 2 && $subItem->catalog_node_type_id != 1)--}}
    {{--        1--}}
    {{--        @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)--}}
    {{--            <div class="accordion col-12 subLicense-group mb-3"--}}
    {{--                 id="accordion-subLicense-{{$catalogRootNode->id}}_{{$loop->index}}">--}}

    {{--                <div class="subLicense-group_header row"--}}
    {{--                     id="subLicense-group-heading-{{$catalogItem->id}}">--}}
    {{--                    <div class="col-12 p-0">--}}
    {{--                        <div class="row no-gutters">--}}
    {{--                            <div class="col-md-8 col-xl-9 subLicense-group_header-title" data-toggle="collapse"--}}
    {{--                                 data-target="#subLicense-group-{{$catalogItem->id}}" aria-expanded="false"--}}
    {{--                                 aria-controls="subLicense-group-{{$catalogItem->id}}">{{$catalogItem->name}}</div>--}}
    {{--                            <div class="col-md-4 col-xl-3 text-md-right">--}}
    {{--                                <div class="custom-control custom-checkbox">--}}
    {{--                                    <input type="checkbox" class=" select_all_in_group"--}}
    {{--                                           id="select_all_in_group_item_{{$catalogItem->id}}">--}}
    {{--                                    <label class="custom-control-label"--}}
    {{--                                           for="select_all_in_group_item_{{$catalogItem->id}}">@lang('messages.all.check_all')--}}
    {{--                                        (<span class="select_in_group_cnt">0</span>/{{$catalogItem->childNodeList->where('is_visible', 1)->count() + $catalogItem->serviceCatalogList->count()}}--}}
    {{--                                        )</label>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                @if($catalogItem->catalog_node_type_id == 1)--}}
    {{--                    <div id="subLicense-group{{$catalogItem->id}}" class="subLicense-group_body collapse row"--}}
    {{--                         aria-labelledby="subLicense-group-heading-{{$catalogItem->id}}"--}}
    {{--                         data-parent="#accordion-subLicense-{{$catalogRootNode->id}}_{{$loop->index}}"--}}
    {{--                    >--}}

    {{--                        <form method="get" class="compareServiceForm"--}}
    {{--                              action="{{route('services.servicesCompare')}}">--}}

    {{--                            <div class="form-check mb-3">--}}
    {{--                                <input class="form-check-input select_all_service_item"--}}
    {{--                                       id="select_all_service_item_{{$catalogItem->id}}" type="checkbox">--}}
    {{--                                <label class="form-check-label"--}}
    {{--                                       for="select_all_service_item_{{$catalogItem->id}}">--}}
    {{--                                    @lang('messages.all.check_all')--}}
    {{--                                </label>--}}
    {{--                            </div>--}}

    {{--                            <hr/>--}}

    {{--                            @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])--}}

    {{--                            @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])--}}
    {{--                            <button type="submit" class="btn btn-success mt-2 compareServiceBtn"--}}
    {{--                                    disabled="disabled">--}}
    {{--                                @lang('messages.all.show')--}}
    {{--                            </button>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                @elseif($catalogItem->catalog_node_type_id == 8)--}}
    {{--                    <div id="subLicense-group-{{$catalogItem->id}}" class="collapse row subLicense-group_container pb-1 "--}}
    {{--                         aria-labelledby="subLicense-group-heading-{{$catalogItem->id}}"--}}
    {{--                    >--}}
    {{--                        @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'preSelected' => $preSelected])--}}

    {{--                        @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        @endforeach--}}
    {{--    @elseif(isset($subItem) && isset($subItem->catalog_node_type_id) && $subItem->catalog_node_type_id == 1)--}}
    {{--        2--}}
    {{--        @if($catalogRootNode->childNodeList->count() > 1)--}}
    {{--            s--}}
    {{--            @foreach($catalogRootNode->childNodeList->groupBy('serviceTypeName')->sortBy('serviceTypeName') as $key => $catalogItemGroup)--}}
    {{--                <h4 class="title-sub">{{$key}}</h4>--}}
    {{--                <div class="service-group">--}}
    {{--                    @foreach($catalogRootNode->childNodeList->sortBy('name') as $catalogItem)--}}
    {{--                        @if($catalogItem->is_visible == 1)--}}
    {{--                            @switch($catalogItem->catalog_node_type_id)--}}
    {{--                                @case(1)--}}
    {{--                                <a href="{{route('services.catalog.list', ['catalogId'=>$catalogItem->id])}}"--}}
    {{--                                   class="service-group__item">--}}
    {{--                                    {{$catalogItem->name}}--}}
    {{--                                </a>--}}
    {{--                                @break--}}
    {{--                                @case(2)--}}
    {{--                                <a href="{{route('services.groupList', ['serviceCategoryId'=>$catalogItem->id])}}"--}}
    {{--                                   class="service-group__item">--}}
    {{--                                    {{$catalogItem->name}}--}}
    {{--                                </a>--}}
    {{--                                @break--}}
    {{--                            @endswitch--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                </div>--}}
    {{--            @endforeach--}}
    {{--        @else--}}
    {{--            @foreach($catalogRootNode->childNodeList->sortBy('name') as $catalogItem)--}}
    {{--                <div class="row services-background">--}}
    {{--                    <div class="col-12">--}}
    {{--                        <div class="card">--}}

    {{--                            <div class="card-body">--}}
    {{--                                <h5>{{$catalogItem->name}}</h5>--}}
    {{--                            </div>--}}
    {{--                            <div class="card-body">--}}
    {{--                                <div class="catalog_list">--}}
    {{--                                    <form method="get" class="compareServiceForm"--}}
    {{--                                          action="{{route('services.servicesCompare')}}">--}}

    {{--                                        <div class="form-check mb-3">--}}
    {{--                                            <input class="form-check-input select_all_service_item"--}}
    {{--                                                   id="select_all_service_item_{{$catalogItem->id}}" type="checkbox">--}}
    {{--                                            <label class="form-check-label"--}}
    {{--                                                   for="select_all_service_item_{{$catalogItem->id}}">--}}
    {{--                                                @lang('messages.all.check_all')--}}
    {{--                                            </label>--}}
    {{--                                        </div>--}}

    {{--                                        <hr/>--}}

    {{--                                        @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])--}}

    {{--                                        @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])--}}
    {{--                                        <button type="submit" class="btn btn-success mt-2 compareServiceBtn"--}}
    {{--                                                disabled="disabled">--}}
    {{--                                            @lang('messages.all.show')--}}
    {{--                                        </button>--}}
    {{--                                    </form>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endforeach--}}
    {{--        @endif--}}
    {{--    @elseif(isset($subItem) && isset($subItem->catalog_node_type_id) && $subItem->catalog_node_type_id == 9)--}}
    {{--        3--}}
    {{--        @foreach($catalogRootNode->childNodeList as $catalogItem)--}}
    {{--            @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])--}}
    {{--        @endforeach--}}
    {{--    @elseif(isset($subItem) && isset($subItem->catalog_node_type_id) && $subItem->catalog_node_type_id == 2)--}}
    {{--        4--}}
    {{--        @foreach($catalogRootNode->childNodeList as $catalogItem)--}}
    {{--            @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])--}}

    {{--            @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])--}}
    {{--        @endforeach--}}
    {{--    @endif--}}
</div>