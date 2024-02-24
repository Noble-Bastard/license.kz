@if($catalogNode)
    @include('services._breadCrumbCatalog', ['catalogNode' => $catalogNode->recursiveParent])

    <li class="breadcrumb-item">
        <a href="{{route('services.groupList', ['serviceCategoryId'=>$catalogNode->pretty_url])}}">{{$catalogNode->name}}</a>
    </li>
@endif