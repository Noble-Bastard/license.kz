<?php

namespace App\Data\Core\Dal;

use App\Data\Helper\RoleList;
use App\Data\Helper\ServiceStatusList;
use App\Data\ServiceJournal\Model\ServiceJournalExt;
use App\Data\Task\Model\TaskExecutorExt;


class ReportDal
{

    public static function getCountClient($country, $start_date, $end_date){
        $users_count =ServiceJournalExt::groupBy('client_id')
            ->selectRaw('client_id')
            ->from('service_journal_ext as sje')
//            ->join('service_ext as se','sje.service_id','=','se.id')
            ->join('profile_ext as p','p.id','=','sje.client_id')
            ->where('p.role_id', RoleList::Client)
            ->whereBetween('p.create_date', [$start_date, $end_date])
            ->where('sje.country_id', $country);

            $users_count = $users_count->distinct('p.id')->count('p.id');
        return $users_count;
    }

    public static function  getServiceComplete($country, $start_date, $end_date){
        $serviceCompletCount =ServiceJournalExt::from('service_journal_ext as sje')
//            ->join('service_ext as se','sje.service_id','=','se.id')
            ->where('sje.country_id', $country)
            ->whereBetween('sje.create_date', [$start_date, $end_date])
            ->where('sje.service_status_id', ServiceStatusList::Complete)
            ->count();
        return $serviceCompletCount;
    }

    public static function  getServiceInProgress($country, $start_date, $end_date){
        $serviceInProgressCount =ServiceJournalExt::from('service_journal_ext as sje')
//            ->join('service_ext as se','sje.service_id','=','se.id')
            ->where('sje.country_id', $country)
            ->whereBetween('sje.create_date', [$start_date, $end_date])
            ->where('sje.service_status_id', ServiceStatusList::Execution)
            ->count();
        return $serviceInProgressCount;
    }

    public static function  getServiceNoPaymentAmount($country, $start_date, $end_date){
        $serviceNoPaymentAmount = ServiceJournalExt::groupBy('sje.currency_name')
            ->selectRaw('sum(sje.Amount) as sum, sje.currency_name as currency')
            ->from('service_journal_ext as sje')
//            ->leftjoin('service_ext as se','sje.service_id','=','se.id')
            ->where('sje.country_id', $country)
            ->whereBetween('sje.create_date', [$start_date, $end_date])
            ->where('sje.is_final_paid', 0)
            ->first();//pluck('sum','currency_name');

            //dd($serviceNoPaymentAmount);
            return $serviceNoPaymentAmount;
    }

    public static function  getAttendanceReportData($country, $start_date, $end_date){
        return 0;
    }

    public static function  getJobEvaluationReportData($country, $start_date, $end_date){
        return 0;
    }

    public static function  getExecutionTimeFactData($country, $start_date, $end_date){
        $ExecutionTimeFactList=TaskExt::from('task_ext as t')
            ->leftjoin('service_journal_ext as sj','sj.project_id','=','t.project_id')
            ->leftjoin('service_ext as s','s.id','=','sj.service_id')
            ->where('s.country_id', $country)
            ->whereBetween('t.project_create_date', [$start_date, $end_date])
            ->where('task_status_id',3)->get();

        return $ExecutionTimeFactList;
    }

    public static function  getExecutorHourlyRateData($country, $start_date, $end_date){
        $HourlyRateList=TaskExecutorExt::from('task_ext as t')
            ->leftjoin('executor_hourly_rate as eh','eh.executor_id','=','t.executor_id')
            ->leftjoin('service_journal_ext as sj','sj.project_id','=','t.project_id')
            ->leftjoin('service_ext as s','s.id','=','sj.service_id')
            ->where('s.country_id', $country)
            ->whereBetween('t.project_create_date', [$start_date, $end_date])
            ->get();

        return $HourlyRateList;
    }

    public static function  getTopServicesData($country, $start_date, $end_date){
    //        WITH cte_cnt as (
    //        select  s.name ,count(t.project_id) cnt from task_ext t
    //						join service_journal_ext as sj
    //						on sj.project_id=t.project_id
    //						join service_ext as s
    //						on s.id=sj.service_id
    //						where t.project_create_date between '2018-01-01' and '2018-12-29'
    //        and s.country_id=1
    //						group by s.name)
    //select TOP 10 * from cte_cnt
    //order by cnt

        return 0;
    }

    public static function  getTopClientsData($country, $start_date, $end_date){
        return 0;
    }
}
