@extends('new.layouts.app')

@section('content')
    <div class="row partner-summary">
        <div class="col-12 partner-summary-header"></div>

        <div class="col-12 partner-summary-body mb-3">
            <div class="row">
                <div class="col-12 col-md-3 offset-lg-1 col-lg-3 mt-3">
                    @if(is_null($partner->company_logo))
                        <img class="card-img-top" src="{{asset('images/no_image.png')}}"/>
                    @else
                        <img class="card-img-top"
                             src="{{\Illuminate\Support\Facades\Storage::url($partner->company_logo)}}"/>
                    @endif
                </div>

                <div class="col-12 col-md-9 col-lg-8 mt-3">
                    <div class="company_name title">
                        {{$partner->company_name}}
                    </div>
                    <hr/>
                    <div class="company_activity_field mt-5">
                        <div class="caption sub-title">
                            @lang('messages.pages.partner.company_activity_field')
                        </div>
                        <div class="data">
                            {!! $partner->company_activity_field !!}
                        </div>
                    </div>
                    <div class="company_founder mt-3">
                        <div class="caption sub-title">
                            @lang('messages.pages.partner.company_founder')
                        </div>
                        <div class="data">
                            {!! $partner->company_founder !!}
                        </div>
                    </div>
                    <div class="company_services mt-3">
                        <div class="caption sub-title">
                            @lang('messages.pages.partner.company_services')
                        </div>
                        <div class="data">
                            {!! $partner->company_services !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 order-last col-md-3 order-md-first col-lg-4 mb-3">
                    <div class="row">
                        <div class="col-12 location mb-2">
                            {{optional($partner->city)->value}}, {{optional($partner->country)->name}}
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="col-12 email mb-2">
                            {{$partner->profile->email}}
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="col-12 company_site mb-2">
                            <a href="{{$partner->company_site}}">{{$partner->company_site}}</a>
                            <i class="fal fa-globe"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 order-first  col-md-9 order-md-last col-lg-8 mb-3">
                    <div class="company_projects mt-3">
                        <div class="caption sub-title">
                            @lang('messages.pages.partner.company_projects')
                        </div>
                        <div class="data">
                            {!! $partner->company_projects !!}
                        </div>
                    </div>
                    <div class="company_awards mt-3">
                        <div class="caption sub-title">
                            @lang('messages.pages.partner.company_awards')
                        </div>
                        <div class="data">
                            {!! $partner->company_awards !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 partner-summary-footer"></div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('partner');
    </script>
@endsection