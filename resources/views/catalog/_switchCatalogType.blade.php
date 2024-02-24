@foreach($catalogItemList as $catalogItem)
    @switch($catalogItem->catalog_node_type_id)
        @case(\App\Data\Helper\CatalogTypeList::WHITE_BOX_WITH_ICON)
        @include('catalog.nodeType.whiteBoxWithIcon', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::ACCORDION_BOX)
        @include('catalog.nodeType.accordionBox', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::ACCORDION_ITEM)
        {{--do nothing--}}
        @break
        @case(\App\Data\Helper\CatalogTypeList::BLUE_BUTTON)
        @include('catalog.nodeType.blueButton', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::WHITE_BOX_WITH_LOGO)
        @include('catalog.nodeType.whiteBoxWithLogo', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::BLUE_BOX_WITH_BG)
        @include('catalog.nodeType.blueBoxWithBG', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::IMAGE_BG_BOX)
        @include('catalog.nodeType.imageBgBox', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::PANEL_BOX)
        @include('catalog.nodeType.panelBox', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::BLUE_BOX)
        @include('catalog.nodeType.blueBox', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::BLUE_BOX_WITH_BG_DESCRIPTION)
        @include('catalog.nodeType.blueBoxWithBGDescription', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::IMAGE_BG_BOX_2)
        @include('catalog.nodeType.imageBgBox2', ['catalogItem' => $catalogItem])
        @break
        @case(\App\Data\Helper\CatalogTypeList::TOP_DESCRIPTION)
        @include('catalog.nodeType.topDescription', ['catalogItem' => $catalogItem])
        @break
    @endswitch
@endforeach