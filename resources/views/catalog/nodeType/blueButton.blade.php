@if(count($catalogItem->childNodeList) == 0 || optional($catalogItem->childNodeList->first())->catalog_node_type_id != \App\Data\Helper\CatalogTypeList::DROP_DOWN)
    <div class="catalog_item catalog_type_4"
         data-node-id="{{$catalogItem->id}}"
         data-exist-service="{{$catalogItem->existServiceCatalog()}}"
         data-is-blank-page="{{$catalogItem->is_blank_page}}"
    >
        <button class=" hoverable">{{$catalogItem->name}}</button>
    </div>
@else
    <div class="catalog_item catalog_type_4"  data-not-get-child-list="true">
        <button class="dropdown-toggle  hoverable" id="navbarDropdown_{{$catalogItem->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$catalogItem->name}}</button>
        @include('catalog.nodeType.dropDown', ['catalogItem' => $catalogItem])
    </div>
@endif

