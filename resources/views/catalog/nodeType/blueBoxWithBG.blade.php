<div class="col-xs-6 col-md-3 card-group catalog_item catalog_type_7"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable"
         style="background-image: url({!!\Illuminate\Support\Facades\Storage::url(\App\Data\Helper\FilePathHelper::getCatalogFormPath()."/blueBoxImg.png")!!})">
        <div class="card-body text-center">
            <table class="title">
                @if($catalogItem->image_path != null)
                    <tr class="icon">
                        <td><img src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/></td>
                    </tr>
                @endif
                <tr>
                    <td class="align-middle text-center">{{$catalogItem->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>