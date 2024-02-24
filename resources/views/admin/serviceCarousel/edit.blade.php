@extends('new.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">@lang('messages.admin.serviceCarousel.edit_carousel')

                </div>

                <div class="card-body">
                    {!! Form::open(['url' => route('admin.mainServiceCarousel.update',$mainServiceCarousel->id), 'method' => 'put', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}
                    <input name="id" type="hidden" value="{{$mainServiceCarousel->id}}"/>

                    <div class="form-row">
                        {!! Form::label('country_id', trans('messages.admin.countries.country'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('country_id', $countryList, $service->country_id, array_merge(['placeholder' => '', 'class' => $errors->has('country_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('country_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('service_category', trans('messages.all.service_category'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('service_category', $serviceCategoryList, $service_category_id, array_merge(['placeholder' => '', 'class' => $errors->has('service_category') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('service_category'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('service_category') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('service_id', trans('messages.all.service'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3 service_list">
                            {!! Form::select('service_id', $serviceList, $service->id, array_merge(['placeholder' => '', 'class' => $errors->has('service_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('service_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('order_no', trans('messages.all.order_num'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::text('order_no', $mainServiceCarousel->order_no, array_merge(['class' => $errors->has('order_no') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                            @if ($errors->has('order_no'))
                                <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('order_no') !!}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @foreach($displayDimentionList as $displayDimention)
                        <div class="form-row">
                            {!! Form::label('img'.$displayDimention->id, trans('messages.admin.serviceCarousel.download_picture').$displayDimention->description, ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::file('img'.$displayDimention->id, null, array_merge(['class' => $errors->has('img'.$displayDimention->id) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('img'.$displayDimention->id))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('img'.$displayDimention->id) !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="form-row">
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                            <submitfiled>{!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success']) !!}</submitfiled>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    @foreach($mainServiceCarouselImgList as $mainServiceCarouselImg)
                        @php
                            $img64 = base64_encode($mainServiceCarouselImg->img);
                            $dimentionType="";

                        @endphp
                        @foreach($displayDimentionList as $displayDimention)
                            @if($displayDimention->id==$mainServiceCarouselImg->display_dimension_type)
                                @php
                                    $dimentionType=$displayDimention->description;
                                @endphp
                            @endif
                        @endforeach
                        <div class="row padding-t-15">
                            <div class="col">{{$dimentionType}}
                                {{--<img class="d-block w-100"--}}
                                     {{--src="/serviceCarouselImage/{{$mainServiceCarousel->id}}/1">--}}
                                <img src="data:image/png;base64,{{ $img64 }}" alt="{{$dimentionType}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        //activeTab('main_service_carousel-list');

        $('#service_category').change(function(){
            $.ajax({
                type: 'GET',
                url: '/admin/_serviceListByCategory/' + $('#service_category').val() + "/" + $('#country_id').val(),
                success: function(data){
                    $('.service_list').html(data);
                }
            });
        });

        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/admin/_serviceListByCategory/' + $('#service_category').val() + "/" + $('#country_id').val(),
                success: function(data){
                    $('.service_list').html(data);
                    $('#service_id').val({{$service->id}});
                }
            });
        });
    </script>
@endsection