@extends('new.layouts.app')

@section('content')
    <div class="row services-background">
        <div class="col-12">
            <div class="card">
                <div class="title-main">
                    {{$catalogNode->name}}

                </div>

                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <small>Выберите интересующие лицензии</small>
                    </div>

                    <form method="get" action="{{route('services.servicesCompare')}}">
                        @foreach($catalogNode->serviceCatalogList as $serviceCatalog)
                        <div class="form-check">
                            <input class="form-check-input" name="service[]" type="checkbox" value="{{$serviceCatalog->service->id}}" id="check_{{$serviceCatalog->service->id}}">
                            <label class="form-check-label" for="check_{{$serviceCatalog->service->id}}">
                                {{$serviceCatalog->service->name}}
                            </label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-success mt-2">
                            @lang('messages.all.show')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--{{dd($catalogNode)}}--}}
@endsection

@section('js')
    <script>
        //activeTab('services');
    </script>
@endsection