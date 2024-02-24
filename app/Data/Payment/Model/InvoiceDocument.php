<?php

namespace App\Data\Payment\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Payment\Model\InvoiceDocument
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $document_id
 * @property boolean $is_actual
 * @property boolean $is_system_generated
 * @property \DateTime $create_date
 *
 * @mixin \Eloquent
 */
class InvoiceDocument extends Model
{
    protected $table = 'invoice_document';

    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'document_id',
        'is_actual',
        'is_system_generated',
        'create_date',
    ];

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->hasOne('App\Data\Payment\Model\Invoice','id','invoice_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }

    public function documentPDF()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id')
            ->where('path', 'like', '%.pdf')
            ;
    }
}
