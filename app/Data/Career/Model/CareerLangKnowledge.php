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
 * App\Data\Company\Model\CareerLangKnowledge
 *
 * @property int $id
 * @property int career_form_id
 * @property string lang_name
 * @property string lang_level
 *
 * @mixin \Eloquent
 */
class CareerLangKnowledge extends Model
{
    protected $table = 'career_form_lang_knowledge';
    public $timestamps = false;

    protected $fillable = [
        'career_form_id',
        'lang_name',
        'lang_level'
    ];
    protected $guarded = ['id'];
}