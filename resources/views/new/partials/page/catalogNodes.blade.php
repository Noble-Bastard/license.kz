<div class="content">
    <div class="col-12">
        <ul>
            @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
                <li class="main__top_card-list">
                    <a
                        class="main__top_card-link"
                        href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                        title="{{$catalogItem->name}}"
                    >
                        {{$catalogItem->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>