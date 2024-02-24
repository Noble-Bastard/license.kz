<div class="col-12">
    @foreach($serviceJournal->serviceStepList as $serviceStep)
        <div class="row {{!$loop->last ? 'border-bottom pb-2': ''}} {{!$loop->first ? 'pt-2': ''}} @if($serviceStep->is_completed == 0 && $loop->index == 0) myService-group-step--executing @elseif($serviceStep->is_completed == 1) myService-group-step--executed @else myService-group-step--non_execute @endif">
            <div class="col-12 col-md-6 text-center text-md-right mb-3 mb-md-0">
                <div class="myService-group-step_description d-none d-sm-block">
                    <span class="pr-1">@lang('messages.all.step') {{$loop->index+1}}:</span> {{$serviceStep->serviceStep->description}}
                </div>
                <div class="myService-group-step_description1 d-block d-sm-none">
                    <div>@lang('messages.all.step') {{$loop->index+1}}:</div>
                    <div>{{$serviceStep->serviceStep->description}}</div>
                </div>
            </div>
            <div class="col-12 col-md-2 text-center text-md-right mb-3 mb-md-0">
                @if($serviceStep->is_completed == 0 && $loop->index == 0)
                    @lang('messages.pages.services.step_run')
                @elseif($serviceStep->is_completed == 1)
                    @lang('messages.pages.services.step_completed')
                @else
                    @lang('messages.pages.services.step_not_run')
                @endif
            </div>
            <div class="col-12 col-md-4 text-center text-md-right mb-3 mb-md-0">
                @if(\Carbon\Carbon::parse($serviceStep->execution_start_date)->format('m') === \Carbon\Carbon::parse($serviceStep->completion_date)->format('m'))
                    {{\Carbon\Carbon::parse($serviceStep->execution_start_date)->translatedFormat('d')}}
                    - {{\Carbon\Carbon::parse($serviceStep->completion_date)->translatedFormat('d F Y')}}
                @else
                    {{\Carbon\Carbon::parse($serviceStep->execution_start_date)->translatedFormat('d F Y')}}
                    - {{\Carbon\Carbon::parse($serviceStep->completion_date)->translatedFormat('d F Y')}}
                @endif
            </div>
        </div>
    @endforeach
</div>