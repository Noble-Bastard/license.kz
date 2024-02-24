<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\ServiceThematicGroup
 *
 * @property int $id
 * @property int $service_category_id
 * @property string $name
 * @property string $description
 * @property-read \App\Data\Service\Model\ServiceCategory $serviceCategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceThematicGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceThematicGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceThematicGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceThematicGroup whereServiceCategoryId($value)
 * @mixin \Eloquent
 */
class ServiceThematicGroup extends Model
{
    protected $table = 'service_thematic_group';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'service_category_id',
        'description'
    ];
    protected $guarded = ['id'];

    public function serviceCategory()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceCategory','id','service_category_id');
    }
}
