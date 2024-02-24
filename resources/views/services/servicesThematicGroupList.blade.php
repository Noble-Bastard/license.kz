@extends('new.layouts.app')
@section('title'){{$catalogRootNode->seo_title}}@endsection

@section('meta-description'){{$catalogRootNode->seo_description}}@endsection

@section('keywords'){{$catalogRootNode->seo_keys}}@endsection

@section('content')
    <div class="container mb-5">
        <div class="row services-background">
            <div class="col-12">
                <h1 class="title-main pt-3">
                    {{$catalogRootNode->name}}
                </h1>

                <div class="row justify-content-center align-items-center pt-3">
                    <div class="col-12 col-md-10">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('new-index') . '#listOfIndustries'}}">@lang('messages.layouts.services')</a>
                                </li>

                                @include('services._breadCrumbCatalog', ['catalogNode' => $catalogRootNode->recursiveParent])

                                <li class="breadcrumb-item active" aria-current="page">{{$catalogRootNode->name}}</li>
                            </ol>
                        </nav>
                        @include('catalog._catalogList', ['catalogRootNode' => $catalogRootNode])

                        <div class="mt-5">
                            {!! $catalogRootNode->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        //activeTab('services');

        $(function () {
            $(document).on('change', '.service_item', function () {
                let form = $(this).parents('.compareServiceForm')[0];
                if ($('.service_item:checked', form).length > 0) {
                    $('.compareServiceBtn', form).attr('disabled', false)
                } else {
                    $('.compareServiceBtn', form).attr('disabled', true)
                }
            });

            $(document).on('change', '.select_all_service_item', function () {
                let form = $(this).parents('.compareServiceForm')[0];

                $('.service_item', form).prop("checked", this.checked).change();
            });
        });
    </script>
@endsection