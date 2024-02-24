@if(!is_null($catalogList))
    <ul>
        @foreach($catalogList as $catalog)
            <h3>{{$catalog->name}}</h3>

                @if(!is_null($catalog->serviceCatalog))
                    <li>
                        <a href="{{route('services.serviceInfo', ['id' => $catalog->serviceCatalog->service->id])}}">
                            {{$catalog->serviceCatalog->service->name}}
                        </a>
                    </li>
                @endif

                @include('catalog._catalogListHidden', ['catalogList' => $catalog->childNodeList])

        @endforeach
    </ul>
@endif