<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\Payment\Model\PaymentType
 *
 * @property int $id
 * @property string name
 *
 * @mixin \Eloquent
 */
class PaymentType extends Model
{
    protected $table = 'payment_type';

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $guarded = ['id'];
}
