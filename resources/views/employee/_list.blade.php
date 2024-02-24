<div class="row">
    @foreach($employeeList->where('employee_position_id', '=', 1) as $employee)
        <div class="col-2 text-center">
            <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}"/>
            <span>{{$employee->first_name}} {{$employee->last_name}}</span>
            <strong>{{$employee->employee_position_value}}</strong>
            <span>
                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>
                                    </span>
        </div>
    @endforeach
</div>
<div class="row">
    @foreach($employeeList->where('employee_position_id', '=', 2) as $employee)
        <div class="col-2 text-center">
            <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}"/>
            <span>{{$employee->first_name}} {{$employee->last_name}}</span>
            <strong>{{$employee->employee_position_value}}</strong>
            <span>
                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>
                                    </span>
        </div>
    @endforeach
</div>
<div class="row">
    @foreach($employeeList->where('employee_position_id', '=', 3) as $employee)
        <div class="col-2 text-center">
            <img src="{{(is_null($employee->photo_path) || $employee->photo_path != '') ? asset('images/employee_nophoto.png') : asset($employee->photo_path) }}"/>
            <span>{{$employee->first_name}} {{$employee->last_name}}</span>
            <strong>{{$employee->employee_position_value}}</strong>
            <span>
                                        <a href="{{route('employee.show', ['employeeId' => $employee->id])}}">@lang('messages.pages.about.show_summary')</a>
                                    </span>
        </div>
    @endforeach
</div>