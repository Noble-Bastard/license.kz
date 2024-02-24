<div class="catalog_item catalog_type_10"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable" title="{!! $catalogItem->description !!}">
        <div class="card-body text-center">
            <table class="title">
                <tr>
                    <td class="align-middle text-center">{{$catalogItem->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>