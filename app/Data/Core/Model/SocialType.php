<?php namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\SocialType
 *
 * @property int $id
 * @property string $value
 * @mixin \Eloquent
 */
class SocialType extends Model {

    protected $table = 'social_type';

    public $timestamps = false;

    protected $fillable = ['value'];

    protected $guarded = ['id'];

}
