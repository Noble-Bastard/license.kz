@extends('new.layouts.app')

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-8">
                        <h6>@lang('messages.career_form.fio')</h6>
                        <div>
                            {{$entity->fio}}
                        </div>
                    </div>
                    <div class="col-4">
                        <h6>@lang('messages.career_form.dob')</h6>
                        <div>
                            {{\App\Data\Helper\Assistant::formatDate($entity->dob)}}
                        </div>
                    </div>
                    <div class="col-8">
                        <h6>@lang('messages.career_form.desired_position')</h6>
                        <div>
                            {{$entity->desired_position}}
                        </div>
                    </div>
                    <div class="col-4">
                        <h6>@lang('messages.career_form.salary')</h6>
                        <div>
                            {{$entity->salary}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                @if(is_null($entity->photo_path) || $entity->photo_path == '')
                    <img src="{{asset('images/nophoto.png')}}"/>
                @else
                    <img src="{{asset($entity->photo_path)}}"/>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h6>@lang('messages.career_form.career_form_education.title')</h6>
            </div>
            <div class="col-12">
                @foreach($entity->educations as $educationEntity)
                    <div class="row pt-2 pb-2 mt-2">
                        <div class="col-12 col-sm-6">
                            <small>@lang('messages.career_form.career_form_education.place')</small>
                            <div>
                                {{$educationEntity->place}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <small>@lang('messages.career_form.career_form_education.start')</small>
                            <div>
                                {{\App\Data\Helper\Assistant::formatDate($educationEntity->start)}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <small>@lang('messages.career_form.career_form_education.end')</small>
                            <div>
                                {{\App\Data\Helper\Assistant::formatDate($educationEntity->end)}}
                            </div>
                        </div>
                        <div class="col-12">
                            <small>@lang('messages.career_form.career_form_education.description')</small>
                            <div>
                                {{$educationEntity->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <h6>@lang('messages.career_form.career_form_experience.title')</h6>
            </div>
            <div class="col-12">
                @foreach($entity->experiences as $experiencesEntity)
                    <div class="row pt-2 pb-2 mt-2">
                        <div class="col-12 col-sm-6">
                            <small>@lang('messages.career_form.career_form_experience.place')</small>
                            <div>
                                {{$experiencesEntity->place}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <small>@lang('messages.career_form.career_form_experience.start')</small>
                            <div>
                                {{\App\Data\Helper\Assistant::formatDate($experiencesEntity->start)}}
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <small>@lang('messages.career_form.career_form_experience.end')</small>
                            <div>
                                {{\App\Data\Helper\Assistant::formatDate($experiencesEntity->end)}}
                            </div>
                        </div>
                        <div class="col-12">
                            <small>@lang('messages.career_form.career_form_experience.main_responsibilities')</small>
                            <div>
                                {{$experiencesEntity->main_responsibilities}}
                            </div>
                        </div>
                        <div class="col-12">
                            <small>@lang('messages.career_form.career_form_experience.merits')</small>
                            <div>
                                {{$experiencesEntity->merits}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-6">
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>@lang('messages.career_form.career_form_lang_knowledge.title')</h6>
                    </div>
                    <div class="col-12">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>@lang('messages.career_form.career_form_lang_knowledge.lang_name')</th>
                                <th>@lang('messages.career_form.career_form_lang_knowledge.lang_level')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entity->langKnowledge as $langKnowledgeEntity)
                                <tr>
                                    <td>{{$langKnowledgeEntity->lang_name}}</td>
                                    <td>{{$langKnowledgeEntity->lang_level}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>@lang('messages.career_form.career_form_editor_speed.title')</h6>
                    </div>
                    <div class="col-12">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>@lang('messages.career_form.career_form_editor_speed.type')</th>
                                <th>@lang('messages.career_form.career_form_editor_speed.value')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entity->editorSpeeds as $editorSpeedsEntity)
                                <tr>
                                    <td>{{$editorSpeedsEntity->editorType->name}}</td>
                                    <td>{{$editorSpeedsEntity->value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-8">
                <h6>@lang('messages.career_form.useful_skills')</h6>
                <div>
                    {{$entity->useful_skills}}
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <h6>@lang('messages.career_form.books_read_cnt')</h6>
                <div>
                    {{$entity->books_read_cnt}}
                </div>
            </div>
            <div class="col-6">
                <h6>@lang('messages.career_form.sport_attitude')</h6>
                <div>
                    {{$entity->sport_attitude}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.self_describe')</h6>
                <div>
                    {{$entity->self_describe}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.contribute_development')</h6>
                <div>
                    {{$entity->contribute_development}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.self_see')</h6>
                <div>
                    {{$entity->self_see}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.want_our_team')</h6>
                <div>
                    {{$entity->want_our_team}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.city_location')</h6>
                <div>
                    {{$entity->city_location}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.social_status')</h6>
                <div>
                    {{$entity->social_status}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.phone')</h6>
                <div>
                    {{$entity->phone}}
                </div>
            </div>
            <div class="col-6 mt-2">
                <h6>@lang('messages.career_form.email')</h6>
                <div>
                    {{$entity->email}}
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h6>@lang('messages.career_form.career_form_social.title')</h6>
            </div>
            <div class="col-12">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>@lang('messages.career_form.career_form_social.type')</th>
                        <th>@lang('messages.career_form.career_form_social.value')</th>
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
        //activeTab('career-index');
    </script>
@endsection