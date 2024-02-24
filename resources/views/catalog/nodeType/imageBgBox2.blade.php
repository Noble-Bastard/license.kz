@if(count($catalogItem->childNodeList) == 0 || optional($catalogItem->childNodeList->first())->catalog_node_type_id != \App\Data\Helper\CatalogTypeList::DROP_DOWN)
    <div class="col-sm-12 col-md-3 mb-2 catalog_item catalog_type_12"
         data-node-id="{{$catalogItem->id}}"
         data-exist-service="{{$catalogItem->existServiceCatalog()}}"
         data-is-blank-page="{{$catalogItem->is_blank_page}}"
    >
        <div class="card hoverable"
             style="background-image: url({!!\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)!!})">
            <div class="card-body">
                <table>
                    <tr>
                        <td class="text-center"><span>{{$catalogItem->name}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="col-sm-12 col-md-3 mb-2 catalog_item catalog_type_12"  data-not-get-child-list="true">
        <div class="card hoverable" id="navbarDropdown_{{$catalogItem->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
             style="background-image: url({!!\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)!!})">
            <div class="card-body">
                <table>
                    <tr>
                        <td class="text-center"><span>{{$catalogItem->name}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        @include('catalog.nodeType.dropDown', ['catalogItem' => $catalogItem])
    </div>
@endif