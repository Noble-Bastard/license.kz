<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\data\Service\Model\DisplayDimensionType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\data\Service\Model\DisplayDimensionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\data\Service\Model\DisplayDimensionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\data\Service\Model\DisplayDimensionType whereName($value)
 * @mixin \Eloquent
 */
class DisplayDimensionType extends Model
{
    //
    protected $table = 'display_dimension_type';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];
    protected $guarded = ['id'];
}
