<div class="col-6 col-sm-3 col-md-2 catalog_item catalog_type_6"
     data-node-id="{{$catalogItem->id}}"
     data-exist-service="{{$catalogItem->existServiceCatalog()}}"
     data-is-blank-page="{{$catalogItem->is_blank_page}}"
>
    <div class="card hoverable">
        @if($catalogItem->image_path != null)
            <img class="card-img-top" src="{{\Illuminate\Support\Facades\Storage::url($catalogItem->image_path)}}"/>
        @else
            <img class="card-img-top" src="{{asset('images/no_image.png')}}"/>
        @endif
        <div class="card-body text-center">
            <p class="card-text">
                {{$catalogItem->name}}
            </p>
        </div>
    </div>
</div>