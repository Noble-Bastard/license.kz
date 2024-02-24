<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;


class PaymentInvoiceDocument extends Model
{
    protected $table = 'payment_invoice_document';

    public $timestamps = false;

    protected $fillable = [
        'payment_invoice_id',
        'document_id',
        'is_actual',
        'is_system_generated',
        'create_date',
    ];

    protected $guarded = ['id'];

    public function paymentInvoice()
    {
        return $this->hasOne('App\Data\Payment\Model\PaymentInvoice','id','payment_invoice_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }

    public function documentPDF()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id')
            ->where('path', 'like', '%.pdf')
            ;
    }
}
