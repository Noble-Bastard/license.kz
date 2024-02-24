<?php


namespace App\Data\ServiceJournal\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\ServiceJournal\Model\ServiceJournalServiceMap;

class ServiceJournalServiceMapDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceJournalServiceMap::class);
    }

    public function getListByServiceJournalId($serviceJournalId)
    {
        return $this->model::where('service_journal_id', $serviceJournalId)
            ->with('service')
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getServiceIdListByServiceJournalId($serviceJournalId)
    {
        return $this->model::where('service_journal_id', $serviceJournalId)
            ->select('service_id')
            ->distinct()
            ->get();
    }
}