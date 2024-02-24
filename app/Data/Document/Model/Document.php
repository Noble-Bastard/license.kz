<?php

namespace App\Data\Document\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @package App\Data\Document\Model
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $document_type_id
 * @property-read \App\Data\Document\Model\DocumentType $documentType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\Document whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\Document wherePath($value)
 * @mixin \Eloquent
 */

class Document extends Model
{
    protected $table = 'document';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'path',
        'document_type_id'
    ];

    protected $guarded = ['id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function documentType()
    {
        return $this->hasOne('App\Data\Document\Model\DocumentType','id','document_type_id');
    }
}
