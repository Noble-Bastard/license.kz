<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 5:34 PM
 */

namespace App\Data\Career\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Company\Model\CareerExperience
 *
 * @property int $id
 * @property int career_form_id
 * @property string place
 * @property \DateTime start
 * @property \DateTime end
 * @property string main_responsibilities
 * @property string merits
 *
 * @mixin \Eloquent
 */
class CareerExperience extends Model
{
    protected $table = 'career_form_experience';
    public $timestamps = false;

    protected $fillable = [
        'career_form_id',
        'place',
        'start',
        'end',
        'main_responsibilities',
        'merits'
    ];
    protected $guarded = ['id'];
}