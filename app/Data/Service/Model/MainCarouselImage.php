<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\MainCarouselImage
 *
 * @property int id
 * @property int main_service_carousel_id
 * @property mixed img
 * @property int display_dimension_type
 * @property int $id
 * @property int $main_service_carousel_id
 * @property int $display_dimension_type
 * @property mixed|null $img
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarouselImage whereDisplayDimensionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarouselImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarouselImage whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\MainCarouselImage whereMainServiceCarouselId($value)
 * @mixin \Eloquent
 */
class MainCarouselImage extends Model
{
    protected $table = 'main_service_carousel_image';
    public $timestamps = false;

    protected $fillable = [
        'main_service_carousel_id',
        'display_dimension_type',
        'img'
    ];
    protected $guarded = ['id'];
    //

}
