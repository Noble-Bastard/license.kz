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
 * App\Data\Company\Model\CareerEditorSpeed
 *
 * @property int $id
 * @property int career_form_id
 * @property int editor_type_id
 * @property int value
 *
 * @mixin \Eloquent
 */
class CareerEditorSpeed extends Model
{
    protected $table = 'career_form_editor_speed';
    public $timestamps = false;

    protected $fillable = [
        'career_form_id',
        'editor_type_id',
        'value'
    ];
    protected $guarded = ['id'];

    public function editorType()
    {
        return $this->hasOne('App\Data\Core\Model\EditorType','id','editor_type_id');
    }
}