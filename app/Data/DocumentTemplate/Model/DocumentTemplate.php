<?php

namespace App\Data\DocumentTemplate\Model;

use Illuminate\Database\Eloquent\Model;


/**
 *  App\Data\DocumentTemplate\Model\DocumentTemplate
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $country_id
 * @property int $document_template_type_id
 *
 * @mixin \Eloquent
 */
class DocumentTemplate extends Model
{
    protected $table = 'document_template';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'path',
        'country_id',
        'document_template_type_id'
    ];

    protected $guarded = ['id'];

    public function documentTemplateType()
    {
        return $this->hasOne('App\Data\DocumentTemplate\Model\DocumentTemplateType','id','document_template_type_id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }
}
