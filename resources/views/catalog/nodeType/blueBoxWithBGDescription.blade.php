@if(count($catalogItem->childNodeList) == 0 || optional($catalogItem->childNodeList->first())->catalog_node_type_id != \App\Data\Helper\CatalogTypeList::DROP_DOWN)
    <div class="col-xs-6 col-md-3 card-group catalog_item catalog_type_11"
         data-node-id="{{$catalogItem->id}}"
         data-exist-service="{{$catalogItem->existServiceCatalog()}}"
         data-is-blank-page="{{$catalogItem->is_blank_page}}"
    >
        <div class="card hoverable"
             style="background-image: url({!!\Illuminate\Support\Facades\Storage::url(\App\Data\Helper\FilePathHelper::getCatalogFormPath()."/blueBoxImg.png")!!})">
            <div class="card-body">
                <table>
                    @if($catalogItem->image_path != null)
                        <tr class="icon">
                            <td><img src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/></td>
                        </tr>
                    @endif
                    <tr class="title">
                        <td>
                            {{$catalogItem->name}}
                            <hr align="left"/>
                        </td>
                    </tr>
                    @if($catalogItem->description != null)
                        <tr class="description">
                            <td>{!!$catalogItem->description!!}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@else
    <div class="col-xs-6 col-md-3 card-group catalog_item catalog_type_11" data-not-get-child-list="true">
        <div class="card hoverable" class="dropdown-toggle" id="navbarDropdown_{{$catalogItem->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
             style="background-image: url({!!\Illuminate\Support\Facades\Storage::url(\App\Data\Helper\FilePathHelper::getCatalogFormPath()."/blueBoxImg.png")!!})">
            <div class="card-body">
                <table>
                    @if($catalogItem->image_path != null)
                        <tr class="icon">
                            <td><img src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/></td>
                        </tr>
                    @endif
                    <tr class="title">
                        <td>
                            {{$catalogItem->name}}
                            <hr align="left"/>
                        </td>
                    </tr>
                    @if($catalogItem->description != null)
                        <tr class="description">
                            <td>{!!$catalogItem->description!!}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        @include('catalog.nodeType.dropDown', ['catalogItem' => $catalogItem])
    </div>
@endif