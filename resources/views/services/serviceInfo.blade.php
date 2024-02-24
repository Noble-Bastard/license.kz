@extends('new.layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('services.categoryList')}}">@lang('messages.services.services')</a></li>
            <li class="breadcrumb-item"><a href="{{route('services.groupList', ["serviceCategoryId" => $serviceCategory->id])}}">{{$serviceCategory->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$service->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    @php
        $numberToWords = new \NumberToWords\NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer(\Illuminate\Support\Facades\App::getLocale());
    @endphp

    <div class="servis-order">
        <div class="services-background">
            <div class="row card">
                <div class="col-xl-12 title-main">
                    {{$service->name }}

                </div>
                <div class="col-xl-12 info">
                    {!! $service->description !!}
                </div>
                <div class="col-xl-12">
                    {!! Form::open(['url' => route('Client.services.order'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('serviceId', $service->id) !!}

                    @foreach($serviceStepList as $index => $serviceStep )
                        <div id="accordion" class="iaccordion">
                            <div class="card">
                                <div class="card-header" id="{{"heading".$index}}" aria-expanded="false">
                                    <div class="row">

                                        <div class="col-lg-11 col-sm-11 col-10">
                                            <button type="button" class="btn btn-link" data-toggle="collapse"
                                                    data-target="{{"#collapse".$index}}" aria-expanded="true"
                                                    aria-controls="{{"collapse".$index}}">
                                                {{$serviceStep->description}}
                                            </button>
                                        </div>
                                        <div class="col-lg-1 col-sm-1 col-2 text-center">
                                            <label class="cbx" {!! $serviceStep->is_required == 1 ? "readonly" : "" !!}>
                                                @if($serviceStep->is_required == 1)
                                                    <input name="serviceStepId[]" type="hidden" value="{{$serviceStep->id}}"/>
                                                @endIf
                                                <input class="chbServiceStep" name="serviceStepId[]" type="checkbox"
                                                       checked="checked"  {!! $serviceStep->is_required == 1 ? "disabled='disabled'" : "" !!} data-stepCost="{{$serviceStep->step_cost}}" data-stepDays="{{$serviceStep->execution_work_day_cnt}}"
                                                       value="{{$serviceStep->id}}">
                                                <span title="{!! $serviceStep->is_required == 1 ? trans('messages.admin.service.service_step.is_required_step') : "" !!}" class="checkmark {!! $serviceStep->is_required == 1 ? "is-readonly" : "" !!}"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="{{"collapse".$index}}" class="collapse show"
                                     aria-labelledby="{{"heading".$index}}"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        @if(sizeof($serviceStepRequiredDocumentList->where('service_step_id',$serviceStep->id)) > 0)
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        №
                                                    </th>
                                                    <th>
                                                        @lang('messages.services.required_documents')
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serviceStepRequiredDocumentList->where('service_step_id',$serviceStep->id) as $indexCurStepRequiredDocument => $curStepRequiredDocument)
                                                    <tr>
                                                        <td>
                                                            {{++$indexCurStepRequiredDocument}}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $description=str_replace(")", "</i>)",str_replace("(", "(<i>",$curStepRequiredDocument->description));
                                                                $description=str_replace(":",": </br>",$description);
                                                                $description=str_replace(";","; </br>",$description);
                                                            @endphp
                                                            {!!$description!!}
                                                            {{$curStepRequiredDocument->document_template_path}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                        <table class="step-info table table-sm">
                                            <tbody>
                                            <tr>
                                                <td class="left-heder-1">
                                                    @lang('messages.services.registration_term')
                                                </td>
                                                <td>
                                                    @if($serviceStep->execution_work_day_cnt!=0)
                                                        <span class="text-bold"> {{$serviceStep->execution_work_day_cnt}}
                                                            (<i>{{$numberTransformer->toWords($serviceStep->execution_work_day_cnt)}}</i>)
                                                            {{ \App\Data\Helper\Assistant::num2word($serviceStep->execution_work_day_cnt,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days') )}}  </span>
                                                        @lang('messages.services.from_moment')
                                                    @endif
                                                </td>
                                            </tr>
                                            @if($serviceStep->step_cost != 0)
                                            <tr>
                                                <td class="left-heder">
                                                    @lang('messages.services.cost_of_service')
                                                </td>
                                                <td class="step-text">
                                                    <span class="text-bold"> {{$serviceStep->step_cost}}
                                                        (<i>{{$numberTransformer->toWords($serviceStep->step_cost)}}</i>)</span>
                                                    {{$serviceStep->step_currency_name}}
                                                </td>
                                            </tr>
                                            @endif
                                            @if($serviceStep->step_tax != 0)
                                            <tr>
                                                <td class="left-heder">
                                                    @lang('messages.services.tax_of_service')
                                                </td>
                                                <td class="step-text">
                                                        <span class="text-bold"> {{$serviceStep->step_tax}}
                                                            (<i>{{$numberTransformer->toWords($serviceStep->step_tax)}}</i>)</span>
                                                        {{$serviceStep->step_currency_name}}
                                                </td>
                                            </tr>
                                            @endif
                                            @foreach($serviceStepResultList->where('service_step_id',$serviceStep->id) as $curStepResult)
                                                <tr>
                                                    <td class="left-heder">
                                                        @if ($loop->first)
                                                            @lang('messages.services.result')
                                                        @endif
                                                    </td>
                                                    <td class="step-text {!! !($loop->first) ? "bg-lite" : "" !!}">
                                                        {{$curStepResult->description}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="cost">
                        <div>
                        @if($service->total_service_cost!=0)
                            <span class="text-bold">
                                @lang('messages.services.total_amount') – <span class="total"></span>
                            </span>
                            (<i class="totalStr">{{$numberTransformer->toWords($service->total_service_cost)}}</i>)
                            {{$service->currency_name}}
                        @else
                            <span class="text-bold">
                                @lang('messages.services.total_amount')
                            </span>
                        @endif
                        </div>
                        <div class="dayscount">
                            <span class="text-bold">
                                @lang('messages.services.total_days') –  <span class="totalDays"></span>
                            </span>
                            (<i class="totalDaysStr"></i>)
                        </div>
                    </div>
                    <div class="col-xl-12 mb-4">
                        {!! $service->comment !!}
                    </div>
                    {{--<a class="btn btn-success order-btn" href="{{route('Client.services.order', ['servicesId' => $service->id])}}">Заказать</a>--}}
                    {!! Form::submit( trans('messages.services.order'), ['class' => 'btn btn-success order-btn btnOrderService']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    @include('news._shortNewsPart')
@endsection


@section('js')
    <script>
        //activeTab('services');

        function calcServiceTotalCost() {
            var strCost = 0;
            var strDays=0;
            let serviceStepIdList = [];
            $('input[type="checkbox"]:checked').each(function () {
                serviceStepIdList.push($(this)[0].value)
            });

            $('.btnOrderService').prop('disabled', serviceStepIdList.length === 0);

            $.ajax({
                type: 'POST',
                url: '{{route('services.getServiceTotals')}}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'serviceId': '{{$service->id }}',
                    'serviceStepIdList': serviceStepIdList
                },
                success: function (data) {

                    let serviceCostTotal = data.stepCostTotal*1 + data.stepTaxTotal*1;
                    //strCost = numberInWords(parseInt(serviceCostTotal, 10));
                    debugger;
                    switch ($('html').attr('lang')) {
                        case 'en':{
                            if(data.executionWorkDayTotal === 1)
                                strDays = data.executionWorkDayTotalWords + ' ' + 'working day';
                            else
                                strDays = data.executionWorkDayTotalWords + ' ' + 'working days';
                            break;
                        }
                        case 'ru':
                        default:{
                            strDays = data.executionWorkDayTotalWords + ' ' + num2word(parseInt(data.executionWorkDayTotal, 10), 'рабочий день', 'рабочих дня', 'рабочих дней');
                            break;
                        }

                    }
                    $(".totalStr").html(data.serviceTotalWords);
                    $(".total").html(serviceCostTotal);
                    $(".totalDaysStr").html(strDays);
                    $(".totalDays").html(data.executionWorkDayTotal);

                }
            });

        }

        $(document).ready(function () {
            calcServiceTotalCost();

            $(document).on('click', '.chbServiceStep', function () {
                calcServiceTotalCost();
            });


        });

    </script>
@endsection
