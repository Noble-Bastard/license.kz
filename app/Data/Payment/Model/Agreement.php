<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = 'agreement';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'agreement_no',
        'agreement_date',
        'create_date',
        'service_journal_id',
    ];

    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function agreementType()
    {
        return $this->hasOne(AgreementType::class,'id','agreement_type_id');
    }

    public function agreementDocuments()
    {
        return $this->hasMany(AgreementDocument::class,'agreement_id','id')
            ->with('document')
            ->with('document.documentType');
    }

    public function actualDocuments()
    {
        return $this->hasMany(AgreementDocument::class,'agreement_id','id')
            ->where('is_actual', 1)
            ->whereHas('documentPDF')
            ->with('documentPDF.documentType');
    }
}
