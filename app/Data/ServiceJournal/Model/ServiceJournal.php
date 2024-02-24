<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceJournal extends Model
{
    protected $table = 'service_journal';
    public $timestamps = false;

    protected $fillable = [
        'service_status_id',
        'client_id',
        'manager_id',
        'service_no',
        'create_date',
        'modify_date',
        'country_id',
        'agreement_no',
        'agreement_date',
    ];
    protected $guarded = ['id'];

    public function serviceStatus()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStatus','id','service_status_id');
    }

    public function manager()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','manager_id');
    }

    public function client()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','client_id')
                ->with('profileLegal');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }

    public function serviceJournalServiceMapList()
    {
        return $this->hasMany('App\Data\ServiceJournal\Model\ServiceJournalServiceMap', 'service_journal_id', 'id')
            ->with('service');
    }

    public function licenseType()
    {
        return $this->belongsTo('App\Data\Service\Model\LicenseType');
    }

    public function serviceJournalPayment()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournalPayment','service_journal_id', 'id');
    }


}
