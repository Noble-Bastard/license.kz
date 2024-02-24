<div class="col-12 col-md-6 catalog_item catalog_type_2" data-not-get-child-list="true">
    <div id="accordion{{$catalogItem->id}}">
        <div class="card">
            <div class="card-header" id="heading{{$catalogItem->id}}">
                <a class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$catalogItem->id}}" aria-expanded="true" aria-controls="collapse{{$catalogItem->id}}">
                    @if($catalogItem->image_path != null)
                        <img class="" src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/>
                    @endif
                    {{$catalogItem->name}}
                </a>
            </div>

            <div id="collapse{{$catalogItem->id}}" class="collapse show" aria-labelledby="heading{{$catalogItem->id}}" data-parent="#accordion{{$catalogItem->id}}">
                <div class="card-body">
                    <ul>
                        @foreach(\App\Data\Catalog\Dal\CatalogDal::geNodeListByParentId($catalogItem->id, false, true) as $key=>$catalogNode)
                            <li class="catalog_item catalog_type_3"
                                data-node-id="{{$catalogNode->id}}"
                                data-exist-service="{{$catalogItem->existServiceCatalog()}}"
                                data-is-blank-page="{{$catalogNode->is_blank_page}}"
                            >
                                <span class="number">{{++$key}}</span>
                                <span class="title">{{$catalogNode->name}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>