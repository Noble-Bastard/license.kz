@extends('new.layouts.app')

@section('content')
    <div class="col-12 partner-form">
        <div class="row">
            <div class="col-12 sub_title">
                @lang('messages.partner_form.personal_information')
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.fio')</h6>
                        <div>
                            {{$entity->fio}}
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.position')</h6>
                        <div>
                            {{$entity->position}}
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.email')</h6>
                        <div>
                            {{$entity->email}}
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.phone')</h6>
                        <div>
                            {{$entity->phone}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                @if(is_null($entity->company_logo) || $entity->company_logo == '')
                    <img src="{{asset('images/nophoto.png')}}"/>
                @else
                    <img src="{{\Illuminate\Support\Facades\Storage::url($entity->company_logo)}}"/>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 sub_title">
                @lang('messages.partner_form.company_information')
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-4">
                        <h6>@lang('messages.partner_form.company_name')</h6>
                        <div>
                            {{$entity->company_name}}
                        </div>
                    </div>
                    <div class="col-4 mb-4">
                        <h6>@lang('messages.partner_form.company_site')</h6>
                        <div>
                            <a href="{{$entity->company_site}}" target="_blank">{{$entity->company_site}}</a>
                        </div>
                    </div>
                    <div class="col-4 mb-4">
                        <h6>@lang('messages.partner_form.company_phone')</h6>
                        <div>
                            {{$entity->company_phone}}
                        </div>
                    </div>
                    <div class="col-4 mb-4">
                        <h6>@lang('messages.partner_form.company_location')</h6>
                        <div>
                            {{$entity->company_location}}
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.company_activity')</h6>
                        <div>
                            {{$entity->company_activity}}
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <h6>@lang('messages.partner_form.company_additionally')</h6>
                        <div>
                            {{$entity->company_additionally}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h6>@lang('messages.partner_form.social_title')</h6>
            </div>
            <div class="col-12">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>@lang('messages.partner_form.social_type')</th>
                        <th>@lang('messages.partner_form.social_value')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entity->socials as $socialsEntity)
                        <tr>
                            <td>{{$socialsEntity->socialType->value}}</td>
                            <td>{{$socialsEntity->value}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        //activeTab('partner-index');
    </script>
@endsection