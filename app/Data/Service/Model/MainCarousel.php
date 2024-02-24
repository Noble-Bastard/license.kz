<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainCarousel
 *
 * @package App\Data\Service\Model
 * @property int service_id
 * @property int id
 * @property int order_no
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarousel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarousel whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarousel whereServiceId($value)
 * @mixin \Eloquent
 */
class MainCarousel extends Model
{
    protected $table = 'main_service_carousel';
    public $timestamps = false;

    protected $fillable = [
        'service_id',
        'order_no'
    ];
    protected $guarded = ['id'];
    //
}
