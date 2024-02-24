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
 * App\Data\Company\Model\CareerSocial
 *
 * @property int $id
 * @property int career_form_id
 * @property int social_type_id
 * @property string value
 *
 * @mixin \Eloquent
 */
class CareerSocial extends Model
{
    protected $table = 'career_form_social';
    public $timestamps = false;

    protected $fillable = [
        'career_form_id',
        'social_type_id',
        'value'
    ];
    protected $guarded = ['id'];

    public function socialType()
    {
        return $this->hasOne('App\Data\Core\Model\SocialType','id','social_type_id');
    }
}