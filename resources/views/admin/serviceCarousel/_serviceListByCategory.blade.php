<select class="form-control" id="service_id" name="service_id">
    <option value=""></option>
    @foreach($serviceList->groupBy('service_thematic_group_name') as $key => $itemList)
        <optgroup label="{{$key}}">
            @foreach($itemList->sortBy("name") as $item)
                <option value="{{$item["id"]}}">{{$item["name"]}}</option>
            @endforeach
        </optgroup>
    @endforeach
</select>