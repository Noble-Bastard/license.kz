<ul class="dropdown-menu" role="menu" aria-labelledby="navbarDropdown_{{$catalogItem->id}}">
    @foreach(\App\Data\Catalog\Dal\CatalogDal::geNodeListByParentId($catalogItem->id, false, true) as $node)
        @if(count($node->childNodeList) == 0)
            <li>
                <a href="#" class="dropdown-item catalog_item catalog_type_4"
                   data-node-id="{{$node->id}}"
                   data-exist-service="{{$catalogItem->existServiceCatalog()}}"
                   data-is-blank-page="{{$catalogItem->is_blank_page}}"
                >
                    {{$node->name}}
                </a>
            </li>
        @else
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-item" tabindex="-1" id="navbarDropdown_{{$node->id}}">
                    {{$node->name}}
                </a>
                @include('catalog.nodeType.dropDown', ['catalogItem' => $node])
            </li>
        @endif
    @endforeach
</ul>