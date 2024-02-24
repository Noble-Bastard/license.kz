@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">
                    @lang('messages.pages.career.title')

                </div>
            </div>
        </div>

        <div class="col-12 career-body">

            @if(\Illuminate\Support\Facades\Session::exists('success_save'))
                <div class="row justify-content-between mb-5 reasons">
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            {{\Illuminate\Support\Facades\Session::get('success_save')}}
                        </div>
                    </div>
                </div>
            @endif


            <div class="row justify-content-between mb-5 reasons">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 mb-3 reason-hdr">
                            @lang('messages.pages.career.reason-hdr1')<br/>
                            @lang('messages.pages.career.reason-hdr2')
                        </div>
                        <div class="col-12 reason-body">
                            <ul>
                                <li>@lang('messages.pages.career.reason-1')</li>
                                <li>@lang('messages.pages.career.reason-2')</li>
                                <li>@lang('messages.pages.career.reason-3')</li>
                                <li>@lang('messages.pages.career.reason-4')</li>
                                <li>@lang('messages.pages.career.reason-5')</li>
                                <li>@lang('messages.pages.career.reason-6')</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <img src="{{asset('images/comand.png')}}" class="img-fluid">
                </div>
            </div>
            <div class="row mb-5 already-joined">
                <div class="col-8 already-joined-hdr">
                    @lang('messages.pages.career.already-joined-hdr')
                </div>
                <div class="col-4">
                    <a href="{{route('new-about').'#company_face'}}" class="btn btn-blue">
                        @lang('messages.pages.career.company-list')
                    </a>
                </div>
            </div>
            <div class="row start-career">
                <div class="col-12 start-hdr">
                    @lang('messages.pages.career.start')
                </div>
                <div class="col-12 mb-3 start-body">
                    4 @lang('messages.pages.career.step')
                </div>
                <div class="col-12 stage mb-5">
                    <div class="row justify-content-center">
                        <div class="col-2 text-center">
                            <img src="{{asset('images/1.png')}}" class="img-fluid">
                            <div class="row justify-content-center mt-3">
                                <div class="col-10 stage-info">
                                    @lang('messages.pages.career.fill-form')
                                    <div>
                                        <a href="{{route('career.form.create')}}">@lang('messages.pages.career.here')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <img src="{{asset('images/2.png')}}" class="img-fluid">
                            <div class="row justify-content-center mt-3">
                                <div class="col-10 stage-info">
                                    @lang('messages.pages.career.pass-test')
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <img src="{{asset('images/3.png')}}" class="img-fluid">
                            <div class="row justify-content-center mt-3">
                                <div class="col-10 stage-info">
                                    @lang('messages.pages.career.come-interview')
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <img src="{{asset('images/4.png')}}" class="img-fluid">
                            <div class="row justify-content-center mt-3">
                                <div class="col-10 stage-info">
                                    @lang('messages.pages.career.know-colleagues')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <a href="{{route('career.form.create')}}">
                        <button class="btn btn-blue">
                            @lang('messages.pages.career.you-need-me')
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        //activeTab('career');
    </script>
@endsection