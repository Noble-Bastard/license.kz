@extends('new.layouts.app')

@section('content')
    <div class="row employee-summary" id="divMainSummary">
        <div class="col-xl-12 header-summary">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 p-3 p-md-0 px-sm-3 px-md-5 photo-summary text-center">
                    <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path)}}" class="img-fluid">
                </div>
                <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12 mb-3 mb-md-0 namePosition-summary align-self-center text-center text-sm-left">
                            <div class="title">
                                {{$employee->first_name}} {{$employee->last_name}}
                            </div>
                            <div class="position">
                                {{$employee->employee_position->value}}
                            </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 left-panel">
            <div class="left-content text-center text-sm-left">
                        <div class="social mb-5">
                            <div class="sub-title mb-3">
                                <span class="icon">
                                    <i class="far fa-link"></i>
                                </span>
                                @lang('messages.pages.employee.social')
                            </div>
                            <div class="data">
                                @foreach($employee->employee_social_list as $employee_social)
                                    <div class="mb-3">
                                        {{--<i class="far fa-{{$employee_social->social_type_value}}"></i>--}}
                                        <img src="{{asset('images/employee/social/'.$employee_social->social_type_value)}}">
                                        <span>/</span>
                                        <span>{{$employee_social->value}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="education mb-5">
                            <div class="sub-title mb-3">
                                <span class="icon">
                                    <i class="far fa-book"></i>
                                </span>

                                @lang('messages.pages.employee.education')
                            </div>
                            <div class="data">
                                @foreach($employee->employee_education_list as $employee_education)
                                    <div class="mb-3">
                                        <span class="education-period">
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d', $employee_education->start_date)->format('Y')}}
                                            - {{\Carbon\Carbon::createFromFormat('Y-m-d', $employee_education->end_date)->format('Y')}}
                                        </span>
                                        <span>{{$employee_education->education_place}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="contact mb-5">
                            <div class="sub-title mb-3">
                                <span class="icon">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @lang('messages.pages.employee.contact')
                            </div>
                            <div class="data">
                                <div class="address">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{$employee->address}}</span>
                                </div>
                                <div class="phone">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span>{{$employee->phone}}</span>
                                </div>
                                <div class="email">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{$employee->email}}</span>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-8 col-12 main-panel">
            <div class="main-content text-center text-sm-left">
                <div class="profile mb-4">
                    <div class="sub-title">
                        <span class="icon">
                            <i class="fal fa-smile"></i>
                        </span>
                        @lang('messages.pages.employee.profile')
                    </div>
                    <div class="data">
                        {{$employee->description}}
                    </div>
                </div>
                <div class="work_experience mb-4">
                    <div class="sub-title">
                        <span class="icon">
                            <i class="fas fa-building"></i>
                        </span>

                        @lang('messages.pages.employee.work_experience')
                    </div>
                    <div class="data">
                        @foreach($employee->employee_work_experience_list as $employee_work_experience)
                            <div class="row period-block  mb-3">
                                <div class="col-3 period text-end">
                                    <div class="row h-100">
                                        <div class="col-12 col-lg-8">
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d', $employee_work_experience->start_date)->format('Y')}}
                                        </div>
                                        <div class="col-12 col-lg-4 p-0">
                                            <div class="chupa-chups">
                                                <div class="wand">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-9">
                                    <div class="place">{{$employee_work_experience->work_place}}</div>
                                    <div class="description">{{$employee_work_experience->description}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="speciality mb-4">
                    <div class="sub-title mb-2">
                        <span class="icon">
                            <i class="fas fa-cogs"></i>
                        </span>
                        @lang('messages.pages.employee.speciality')
                    </div>
                    <div class="data">
                        @foreach($employee->employee_speciality_list as $employee_speciality)
                            <div class="row mb-3">
                                <div class="col-12 col-md-12 col-lg-4 col-xl-4 mb-2 skill-stats">
                                    {{$employee_speciality->name}}
                                </div>
                                <div class="col-12 col-md-12 col-lg-8 col-xl-8  skill-balls">
                                    @for($i = 1; $i <= 10; $i++)
                                        <i class="{{$i <= $employee_speciality->value ? 'fas' : 'far'}} fa-circle"></i>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="skill">
                    <div class="sub-title">
                        <span class="icon">
                            <i class="far fa-draw-square"></i>
                        </span>
                        @lang('messages.pages.employee.skill')
                    </div>
                    <div class="data">
                        @foreach($employee->employee_skill_list->chunk(4) as $employee_skill_chunk)
                            <div class="row mb-3 skills">
                                @foreach($employee_skill_chunk as $employee_skill)
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3 text-center align-self-center">
                                        <div class="big-skills-balls">
                                            <div>
                                                {{$employee_skill->value}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <canvas id="grid" style="position: absolute"></canvas>
    </div>
@endsection

@section('js')
    <script>
        window.addEventListener("DOMContentLoaded", resize);
        window.addEventListener("resize", resize);

        //activeTab('contacts');

        var wrapper = document.getElementById('divMainSummary');
        var canvas = document.getElementById('grid');
        var context = canvas.getContext('2d');
        var step = 15;

        function resize() {
            context.clearRect(0, 0, canvas.width, canvas.height);

            canvas.height = wrapper.offsetHeight-32;
            canvas.width = wrapper.offsetWidth-32;
            context.strokeStyle = "rgba(255,255,255,0.1)";

            for (var i = 0; i < canvas.width; i += step) {
                context.beginPath();
                context.moveTo(i, 0);
                context.lineTo(i, canvas.height);
                context.stroke();
            }

            for (var i = 0; i < canvas.height; i += step) {
                context.beginPath();
                context.moveTo(0, i);
                context.lineTo(canvas.width, i);
                context.stroke();
            }
        }




    </script>
@endsection