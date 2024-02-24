<?php

namespace App\Data\ServiceJournal\Model;

use App\Data\Core\Model\BaseTableModel;
use Illuminate\Database\Eloquent\Model;

class ServiceJournalServiceMap extends BaseTableModel
{

     public function __construct()
     {
         parent::__construct(
             'service_journal_service_map',
             false
         );
     }

    public function service()
    {
        return $this->hasOne('App\Data\Service\Model\Service','id','service_id');
    }

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }


}
