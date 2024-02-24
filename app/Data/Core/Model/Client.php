<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\Client
 *
 * @property int $id
 * @property int $profile_id
 * @property int $agent_id
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $table = 'client';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'agent_id'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id', 'profile_id');
    }

    public function agent()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id', 'agent_id');
    }

}
