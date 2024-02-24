<?php

namespace App\Data\Document\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Document\Model\ProfileDocument
 *
 * @property int $id
 * @property int $profile_id
 * @property int $document_id
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\Core\Model\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocument whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocument whereProfileId($value)
 * @mixin \Eloquent
 */
class ProfileDocument extends Model
{
    protected $table = 'profile_document';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'document_id'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','profile_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }
}
