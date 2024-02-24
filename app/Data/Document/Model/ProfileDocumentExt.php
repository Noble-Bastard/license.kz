<?php

namespace App\Data\Document\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Document\Model\ProfileDocumentExt
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $profile_full_name
 * @property int $user_id
 * @property string $profile_user_name
 * @property int $document_id
 * @property string|null $document_name
 * @property string|null $document_path
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\Core\Model\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereDocumentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereProfileFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereProfileUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\ProfileDocumentExt whereUserId($value)
 * @mixin \Eloquent
 */
class ProfileDocumentExt extends Model
{
    protected $table = 'profile_document_ext';

    public $timestamps = false;

    protected $fillable = [
        'profile_full_name',
        'user_id',
        'profile_user_name',
        'profile_id',
        'document_id',
        'document_name',
        'document_path'
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
