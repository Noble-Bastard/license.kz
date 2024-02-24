<?php

namespace App\Data\Document\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Document\Model\DocumentType
 *
 * @property int $id
 * @property string $name
 * @property int $document_template_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\DocumentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Document\Model\DocumentType whereName($value)
 * @mixin \Eloquent
 */
class DocumentType extends Model
{
    protected $table = 'document_type';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'document_template_type_id',
    ];

    protected $guarded = ['id'];

    public function documentTemplateType()
    {
        return $this->hasOne('App\Data\DocumentTemplate\Model\DocumentTemplateType','id','document_template_type_id');
    }

}
