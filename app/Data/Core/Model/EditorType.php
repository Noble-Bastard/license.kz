<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\EditorType
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class EditorType extends Model
{
    protected $table = 'editor_type';

    public $timestamps = false;

    protected $guarded = ['id', 'name'];

}
