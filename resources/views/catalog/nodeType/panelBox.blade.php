<div class="col-md-3 card-group catalog_item catalog_type_9"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable">
        <div class="card-body text-center">
            <table class="title">
                <tr>
                    <td class="align-middle text-center">{{$catalogItem->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>