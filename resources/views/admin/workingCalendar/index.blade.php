@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
        <div class="col-12">
            <div class="title-main">
                @lang('messages.admin.workingCalendar.working_calendar')
            </div>
        </div>

            <div class="col-12">
                <div class="card">
                     <div class="card-body">

                            {!! Form::open(['url' => route('admin.workingCalendar.updateWeekDays',$weekWorkingDay->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            <input name="id" type="hidden" value="{{$weekWorkingDay->id}}"/>
                            <div class="form-row">
                                {!! Form::label('mon',  trans('messages.all.week_days.monday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 coln-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('mon', $weekWorkingDay->mon, ($weekWorkingDay->mon  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('tue', trans('messages.all.week_days.tuesday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('tue', $weekWorkingDay->tue, ($weekWorkingDay->tue  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('wed', trans('messages.all.week_days.wednesday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('wed', $weekWorkingDay->wed, ($weekWorkingDay->wed  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('thu', trans('messages.all.week_days.thursday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('thu', $weekWorkingDay->thu, ($weekWorkingDay->thu  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('fri', trans('messages.all.week_days.friday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('fri', $weekWorkingDay->fri, ($weekWorkingDay->fri  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('sat', trans('messages.all.week_days.saturday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('sat', $weekWorkingDay->sat, ($weekWorkingDay->sat  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                {!! Form::label('sun', trans('messages.all.week_days.sunday'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                    {!! Form::checkbox('sun', $weekWorkingDay->sun, ($weekWorkingDay->sun  == 1), array_merge(['class' => ''])) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                                    <submitfiled>{!! Form::submit(trans('messages.all.change'), ['class' => 'btn btn-success']) !!}</submitfiled>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        <div class="row pb-3">
                    </div>
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('admin.workingCalendar.create')}}"><i
                                            class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="users" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.all.decsription')</th>
                                    <th>@lang('messages.admin.workingCalendar.start_date')</th>
                                    <th>@lang('messages.admin.workingCalendar.end_date')</th>
                                    <th>@lang('messages.admin.workingCalendar.type')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workingCalendarList as $workingCalendar)
                                    <tr>
                                        <td>{{$workingCalendar->decsription }}</td>
                                        <td>{{$workingCalendar->start_date }}</td>
                                        <td>{{$workingCalendar->end_date }}</td>
                                        <td>{{$workingCalendar->dayType->name}}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.workingCalendar.edit', ['id' => $workingCalendar->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.workingCalendar.destroy', $workingCalendar->id)}}"
                                                       data-method="delete">@lang('messages.all.delete')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $workingCalendarList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('workingCalendar-list');
    </script>
@endsection