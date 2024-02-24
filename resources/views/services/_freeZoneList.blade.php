@foreach($freeZoneList as $freeZone)
<div class="col-sm-3 pt-3 card-group ">
    <div class="card catalog_item hoverable justify-content-center" data-serviceCategoryId="{{$freeZone->service_category_id}}">
        <img class="bg-light" src="{{asset($freeZone->img_path)}}" alt="{{$freeZone->name}}">
        <div class="card-body text-center">
            <h5 class="card-title">{{$freeZone->code}}</h5>
        </div>
    </div>
</div>
@endforeach

