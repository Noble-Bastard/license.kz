<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Payment\Model\PaymentStatus
 *
 * @property int $id
 * @property string name
 *
 * @mixin \Eloquent
 */
class PaymentStatus extends Model
{
    protected $table = 'payment_status';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];
}
