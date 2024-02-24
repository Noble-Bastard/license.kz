<?php


namespace App\Data\ServiceJournal\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\ServiceJournal\Model\ServiceJournalProfileLegal;

class ServiceJournalProfileLegalDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceJournalProfileLegal::class);
    }

    public function getByServiceJournalId($serviceJournalId)
    {
        return $this->model::where('service_journal_id', $serviceJournalId)
            ->first();
    }

}