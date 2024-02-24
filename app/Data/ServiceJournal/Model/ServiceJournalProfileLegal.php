<?php


namespace App\Data\ServiceJournal\Model;


use App\Data\Core\Model\BaseTableModel;

class ServiceJournalProfileLegal extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'service_journal_profile_legal',
            false
        );
    }

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }


    public function bankCodeType()
    {
        return $this->hasOne('App\Data\Core\Model\BankCodeType','id','bank_code_type_id');
    }



}