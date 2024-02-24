<?php

namespace App\Data\DocumentTemplate\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Data\DocumentTemplate\Model\DocumentTemplateType
 *
 * @property int $id
 * @property string $name
 *
 * @mixin \Eloquent
 */
class DocumentTemplateType extends Model
{
    protected $table = 'document_template_type';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $guarded = ['id'];

}
