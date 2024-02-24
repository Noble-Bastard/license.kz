<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;


class ConsultationPayment extends Model
{
    protected $table = 'consultation_payment';
    public $timestamps = false;

    protected $fillable = [
        'consultation_id',
        'pg_status',
        'pg_payment_id',
        'pg_error_code',
        'pg_error_description',
        'pg_currency',
        'pg_amount',
        'pg_payment_system',
        'pg_result',
        'pg_payment_date',
        'pg_can_reject',
        'pg_card_brand',
        'pg_card_pan',
        'pg_failure_code',
        'pg_failure_description'
    ];
    protected $guarded = ['id'];

    public function consultation(){
        return $this->hasOne(Consultation::class, 'id', 'consultation_id');
    }
}
