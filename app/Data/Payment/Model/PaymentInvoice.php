<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Payment\Model\Invoice
 *
 * @property int $id
 * @property float $amount
 * @property \DateTime $payment_invoice_date
 * @property int $agreement_id
 * @property int $payment_status_id
 * @property int $currency_id
 * @property \DateTime $create_date
 * @property int $payment_invoice_no
 * @property int $service_journal_id
 *
 * @mixin \Eloquent
 */
class PaymentInvoice extends Model
{
    protected $table = 'payment_invoice';

    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'agreement_id',
        'payment_invoice_no',
        'payment_invoice_date',
        'create_date',
        'payment_status_id',
        'amount',
        'currency_id',
        'payment_date'
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

    public function paymentJournal()
    {
        return $this->hasOne('App\Data\Payment\Model\PaymentJournal','payment_invoice_id','id');
    }

    public function invoiceType()
    {
        return $this->hasOne('App\Data\Payment\Model\InvoiceType','id','invoice_type_id');
    }

    public function paymentInvoiceDocuments()
    {
        return $this->hasMany(PaymentInvoiceDocument::class,'payment_invoice_id','id')
            ->with('document')
            ->with('document.documentType');
    }

    public function actualDocuments()
    {
        return $this->hasMany(PaymentInvoiceDocument::class,'payment_invoice_id','id')
            ->where('is_actual', 1)
            ->whereHas('documentPDF')
            ->with('documentPDF.documentType');
    }
}
