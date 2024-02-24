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
 * App\Data\Company\Model\CareerEducation
 *
 * @property int $id
 * @property int career_form_id
 * @property string place
 * @property \DateTime start
 * @property \DateTime end
 * @property string description
 *
 * @mixin \Eloquent
 */
class CareerEducation extends Model
{
    protected $table = 'career_form_education';
    public $timestamps = false;

    protected $fillable = [
        'career_form_id',
        'place',
        'start',
        'end',
        'description'
    ];
    protected $guarded = ['id'];
}