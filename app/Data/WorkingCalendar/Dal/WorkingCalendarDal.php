<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 29.07.2018
 * Time: 20:24
 */

namespace App\Data\WorkingCalendar\Dal;

use App\Data\Core\Dal\SettingDal;
use App\Data\Helper\Assistant;
use App\Data\WorkingCalendar\Model\WeekWorkingDay;
use App\Data\WorkingCalendar\Model\WorkingDay;
use App\Data\WorkingCalendar\Model\DayType;
use Illuminate\Database\Eloquent\Collection;

class WorkingCalendarDal
{

    /**
     * Return end date with work days counting rule
     *
     * @param $startDate
     * @param int $workDaysCnt
     * @return
     */
    public static function getWorkEndDate($startDate, $workDaysCnt)
    {
        $endDate = $startDate->modify('-1 day')->setTime(0,0,0);
        do {
            $endDate->modify('+1 day');
            if(
                !self::isWeekendDay($endDate->format("N"))
                && !self::isHoliday($endDate)
                || self::isWorkDay($endDate)
            ) {
                $workDaysCnt--;
            }
        } while($workDaysCnt > 0);

        $endDate = $endDate->setTime(23,59,59);

        return $endDate;
    }

    /**
     * Check date is holiday
     *
     * @param $date
     * @return bool
     */
    public static function isHoliday($date){
        $workingDay = WorkingDay::where('start_date','<=',$date)
            ->where('end_date','>=',$date)
            ->where('aps_day_type_id',\App\Data\Helper\DayType::Holiday)
            ->first();
        return $workingDay != null;
    }

    /**
     * Check date is work day
     *
     * @param $date
     * @return bool
     */
    public static function isWorkDay($date){
        $workingDay = WorkingDay::where('start_date','<=',$date)
            ->where('end_date','>=',$date)
            ->where('aps_day_type_id',\App\Data\Helper\DayType::Work)
            ->first();
        return $workingDay != null;
    }
    /**
     * Check is week day is work or not
     *
     * @param $weekDayNo
     * @return bool
     */
    public static function isWeekendDay($weekDayNo){
        $weekWorkingDay = self::getWeekWorkingDay();
        switch ($weekDayNo) {
            case 1:
                return $weekWorkingDay->mon == 0;
            case 2:
                return $weekWorkingDay->tue == 0;
            case 3:
                return $weekWorkingDay->wed == 0;
            case 4:
                return $weekWorkingDay->thu == 0;
            case 5:
                return $weekWorkingDay->fri == 0;
            case 6:
                return $weekWorkingDay->sat == 0;
            case 7:
                return $weekWorkingDay->sun == 0;
            default:
                return true;
        }
    }

    /**
     * Return  holidays and work days in weekend by current year
     *
     * @return  Collection|WorkingDay[]
     */
    public static function getWorkingDayListByCurrentYear(bool $withPagination = false)
    {
        $yearStartDate = Assistant::firstDateOfCurrentYear();
        $yearEndDate = Assistant::lastDateOfCurrentYear();

        if($withPagination){
            return $entities = WorkingDay::whereBetween("start_date",array($yearStartDate,$yearEndDate))
                ->whereBetween("end_date",array($yearStartDate,$yearEndDate))
                ->with('dayType')
                ->paginate(15);
        } else {
            return  $entities = WorkingDay::whereBetween("start_date",array($yearStartDate,$yearEndDate))
                ->whereBetween("end_date",array($yearStartDate,$yearEndDate))
                ->with('dayType')
                ->get();
        }
    }

    public static function getDayTypeList()
    {
        $dayTypeList = DayType::get();
        return $dayTypeList;
    }

    /**
     * Get WorkingDay by id
     *
     * @param $id
     * @return WorkingDay
     */
    public static function getWorkingDay($id)
    {
        $entity = WorkingDay::where('id', $id)->firstOrFail();
        return $entity;
    }

    /**
     * Set WorkingDay
     *
     * @param WorkingDay $srcEntity
     * @return WorkingDay
     */
    public static function setWorkingDay (WorkingDay $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new WorkingDay;
        } else {
            $entity = WorkingDay::where('id',$srcEntity->id)->firstOrFail();;
        }
        $entity->aps_day_type_id = $srcEntity->aps_day_type_id;
        $entity->start_date = $srcEntity->start_date;
        $entity->end_date = $srcEntity->end_date;
        $entity->decsription = $srcEntity->decsription;
        $entity->save();
        return $entity;
    }

    /**
     * Delete WorkingDay by id
     *
     * @param $entityId
     * @return bool
     */
    public static function deleteWorkingDay($entityId)
    {
        WorkingDay::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Get week working day matrix
     *
     * @return WeekWorkingDay
     */
    public static function getWeekWorkingDay()
    {
        $entity = SettingDal::get();
        $weekWokingDay = WeekWorkingDay::where('id',$entity->aps_week_working_day_id)->first();
        return $weekWokingDay;
    }



    /**
     * Set week working days matrix
     *
     * @param WeekWorkingDay $srcEntity
     * @return WeekWorkingDay
     */
    public static function setWeekWorkingDay (WeekWorkingDay $srcEntity)
    {
        $entity = WeekWorkingDay::where('id',$srcEntity->id)->firstOrFail();;
        $entity->sun = $srcEntity->sun;
        $entity->mon = $srcEntity->mon;
        $entity->tue = $srcEntity->tue;
        $entity->wed = $srcEntity->wed;
        $entity->thu = $srcEntity->thu;
        $entity->fri = $srcEntity->fri;
        $entity->sat = $srcEntity->sat;
        $entity->save();
        return $entity;
    }


}