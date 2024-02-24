<?php

namespace App\Data\ServiceJournal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\ServiceJournal\Model\ServiceJournalPayment
 *
 * @property int $id
 * @property int $service_journal_id
 * @property string $create_date
 * @property float $amount
 * @property float $tax
 * @property int $currency_id
 * @property-read \App\Data\Service\Model\Currency $currency
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @mixin \Eloquent
 */
class ServiceJournalPayment extends Model
{
    protected $table = 'service_journal_payment';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'create_date',
        'amount',
        'tax',
        'currency_id',
    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }

    public function currency()
    {
        return $this->hasOne('App\Data\Service\Model\Currency','id','currency_id');
    }
}
