<div class="col-sm-12 col-md-4 mb-2 catalog_item catalog_type_8"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable"
{{--         style="background-image: url({!!\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)!!})"--}}
    >
        <table>
            <tr class="card-body">
                <td></td>
            </tr>
            <tr class="card-footer">
                <td class="text-center"><span>{{$catalogItem->name}}</span></td>
            </tr>
        </table>
    </div>
</div>