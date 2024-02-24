<?php

namespace App\Data\Notify\Model;

use Illuminate\Database\Eloquent\Model;


class EmailAttachment extends Model
{
    protected $table = 'email_attachment';

    public $timestamps = false;

    protected $guarded = ['id'];
}
