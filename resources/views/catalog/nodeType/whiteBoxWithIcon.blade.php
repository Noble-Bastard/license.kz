<div class="col-12 catalog_item catalog_type_1"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable">
        <div class="card-body text-center">

{{--            <img class="" src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/>--}}

            <table class="title">
                <tr>
                    <td class="align-middle text-center">{{$catalogItem->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>