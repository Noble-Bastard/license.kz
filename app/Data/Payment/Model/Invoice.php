<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    protected $table = 'invoice';

    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'invoice_no',
        'invoice_date',
        'turnover_date',
        'create_date',
    ];

    protected $guarded = ['id'];

    public function currency()
    {
        return $this->hasOne('App\Data\Service\Model\Currency','id','currency_id');
    }

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function agreement()
    {
        return $this->hasOne('App\Data\Payment\Model\Agreement','id','agreement_id');
    }

    public function paymentStatus()
    {
        return $this->hasOne('App\Data\Payment\Model\PaymentStatus','id','payment_status_id');
    }

    public function invoiceType()
    {
        return $this->hasOne('App\Data\Payment\Model\InvoiceType','id','invoice_type_id');
    }

    public function invoiceDocuments()
    {
        return $this->hasMany('App\Data\Payment\Model\InvoiceDocument','invoice_id','id')
            ->with('document')
            ->with('document.documentType');
    }


    public function actualDocuments()
    {
        return $this->hasMany('App\Data\Payment\Model\InvoiceDocument','invoice_id','id')
            ->where('is_actual', 1)
            ->whereHas('documentPDF')
            ->with('documentPDF.documentType');
    }
}
