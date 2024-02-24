<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;


class Consultation extends Model
{
    protected $table = 'consultation';
    public $timestamps = false;

    protected $fillable = [
        'consultation_no',
        'create_date',
        'name',
        'phone',
        'activity',
        'question'
    ];
    protected $guarded = ['id'];
    /**
     * @var mixed
     */
}
