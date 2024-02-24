<?php

namespace App\Http\Controllers\Admin;

use App\Data\WorkingCalendar\Dal\WorkingCalendarDal;
use App\Data\WorkingCalendar\Model\DayType;
use App\Data\WorkingCalendar\Model\WeekWorkingDay;
use App\Data\WorkingCalendar\Model\WorkingDay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class WorkingCalendarController extends Controller
{
    public function index()
    {
        $workingCalendarList = WorkingCalendarDal::getWorkingDayListByCurrentYear(true);
        $dayTypeList = WorkingCalendarDal::getDayTypeList();
        $weekWorkingDay = WorkingCalendarDal::getWeekWorkingDay();
        return view('admin.workingCalendar.index')
            ->with('workingCalendarList', $workingCalendarList)
            ->with('dayTypeList',$dayTypeList)
            ->with('weekWorkingDay',$weekWorkingDay);
    }

    public function get($id){
        //TODO
        $dayTypeList=WorkingCalendarDal::getDayTypeList();
        return view('admin.workingCalendar.create')
            ->with('dayTypeList',$dayTypeList->pluck('name', 'id'));
    }

    public function create(){
        $dayTypeList=WorkingCalendarDal::getDayTypeList();
        return view('admin.workingCalendar.create')
            ->with('dayTypeList',$dayTypeList->pluck('name', 'id'));
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'aps_day_type_id' => 'required',
            'decsription' => 'required'
        ])->validate();

        $new = new WorkingDay();
        $new->decsription = Input::get('decsription');
        $new->start_date = Input::get('start_date');
        $new->end_date = Input::get('end_date');
        $new->aps_day_type_id = Input::get('aps_day_type_id');

        WorkingCalendarDal::setWorkingDay($new);
        return redirect(route('admin.workingCalendar.list'));
    }

    public function edit($id){
        $WorkingDay = WorkingCalendarDal::getWorkingDay($id);
        $dayTypeList=WorkingCalendarDal::getDayTypeList();
        return view('admin.workingCalendar.edit')
            ->with('WorkingDay', $WorkingDay)
            ->with('dayTypeList',$dayTypeList->pluck('name', 'id'));
    }

    public function update(Request $request){
        Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'aps_day_type_id' => 'required',
            'decsription' => 'required'
        ])->validate();

        $new = new WorkingDay();
        $new->id = Input::get('id');
        $new->decsription = Input::get('decsription');
        $new->start_date = Input::get('start_date');
        $new->end_date = Input::get('end_date');
        $new->aps_day_type_id = Input::get('aps_day_type_id');

        WorkingCalendarDal::setWorkingDay($new);
        return redirect(route('admin.workingCalendar.list'));
    }

    public function updateWeekDays(Request $request){

        $new = new WeekWorkingDay();
        $new->id = (Input::get('id')== null) ? 0 : 1;
        $new->mon = (Input::get('mon')== null) ? 0 : 1;
        $new->tue= (Input::get('tue')== null) ? 0 : 1;
        $new->wed = (Input::get('wed')== null) ? 0 : 1;
        $new->thu = (Input::get('thu')== null) ? 0 : 1;
        $new->fri = (Input::get('fri')== null) ? 0 : 1;
        $new->sat = (Input::get('sat')== null) ? 0 : 1;
        $new->sun = (Input::get('sun')== null) ? 0 : 1;
        WorkingCalendarDal::setWeekWorkingDay($new);
        return redirect(route('admin.workingCalendar.list'));
    }

    public function destroy($id)
    {
        WorkingCalendarDal::deleteWorkingDay($id);
        return redirect(route('admin.workingCalendar.list'));
    }
}
