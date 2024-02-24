<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;


class ServiceStepRequiredDocument extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step_required_document',
            false
        );
    }

    public function serviceStep()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id');
    }

    public function serviceRequiredDocument()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceRequiredDocument','id','service_required_document_id')
            ->with('document');
    }

    public function serviceRequiredDocumentWithTranslate()
    {
        $hasOne = $this->hasOne('App\Data\Service\Model\ServiceRequiredDocument','id','service_required_document_id');

        $serviceRequiredDocument = new ServiceRequiredDocument;
        TranslationDal::generateQuery($serviceRequiredDocument->table, $hasOne, $serviceRequiredDocument->getEntityColumnList(true), true);

        return $hasOne->with('document');
    }

    public function service()
    {
        return $this->belongsTo('App\Data\Service\Model\Service');
    }

}
