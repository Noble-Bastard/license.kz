<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Payment\Model\PaymentJournal
 *
 * @property int $id
 * @property int $invoice_id
 * @property \DateTime $payment_date
 * @property \DateTime $create_date
 * @property int $payment_type_id
 * @property float $amount
 * @property int $currency_id
 * @property string $ext_payment_id
 * @property string $ext_status
 * @property string $ext_error_code
 * @property string $ext_message
 * @property string $ext_details
 *
 * @mixin \Eloquent
 */
class PaymentJournal extends Model
{
    protected $table = 'payment_journal';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'payment_invoice_id',
        'payment_date',
        'create_date',
        'payment_type_id',
        'amount',
        'currency_id',
        'ext_payment_id',
        'ext_status',
        'ext_error_code',
        'ext_message',
        'ext_details',
    ];

    protected $guarded = ['id'];

    public function currency()
    {
        return $this->hasOne('App\Data\Service\Model\Currency','id','currency_id');
    }

    public function paymentType()
    {
        return $this->hasOne('App\Data\Payment\Model\PaymentType','id','payment_type_id');
    }

    public function paymentInvoice()
    {
        return $this->hasOne('App\Data\Payment\Model\Invoice','id','payment_invoice_id');
    }
}
