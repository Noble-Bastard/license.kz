<?php

namespace App\Data\Payment\Dal;

use App\Data\Helper\Assistant;
use App\Data\Payment\Model\Agreement;
use App\Data\Payment\Model\AgreementDocument;
use Illuminate\Support\Facades\Auth;


class AgreementDocumentDal
{
    public static function get($entityId): AgreementDocument
    {
        $entity = AgreementDocument::where('id', $entityId)->first();
        return $entity;
    }

    public static function getByAgreement($agreementId)
    {
        $entityList = AgreementDocument::where('agreement_id', $agreementId)->get();
        return $entityList;
    }

    public static function insert($agreementId, $documentId): AgreementDocument
    {
        $entity = new AgreementDocument;
        $entity->agreement_id = $agreementId;
        $entity->document_id = $documentId;
        $entity->is_actual = true;
        $entity->is_system_generated = true;
        $entity->create_date = Assistant::getCurrentDate();
        $entity->save();

        return self::get($entity->id);
    }

    /**
     * @param $serviceJournalId
     * @return mixed
     */
    public static function getListByServiceJournal($serviceJournalId, $agreementTypeId)
    {
        $agreementDocument = Agreement::from('agreement as agr')
            ->join('service_journal as sj', function ($join) {
                $join->on('sj.id', '=', 'agr.service_journal_id');
            })
            ->join('agreement_document as ad', function ($join) {
                $join->on('ad.agreement_id', '=', 'agr.id');
            })
            ->join('document as d', function ($join) {
                $join->on('d.id', '=', 'ad.document_id');
            })
            ->where('service_journal_id', $serviceJournalId)
            ->where('agr.agreement_type_id', $agreementTypeId)
            ->get(["ad.*","d.path"]);
        return $agreementDocument;
    }


    public static function getListByClientServiceJournal($serviceJournalId)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

        $agreementDocument = Agreement::from('agreement as agr')
            ->join('service_journal as sj', function ($join) use($profile){
                $join->on('sj.id', '=', 'agr.service_journal_id')
                    ->where('sj.client_id', $profile->id);
            })
            ->join('agreement_document as ad', function ($join) {
                $join->on('ad.agreement_id', '=', 'agr.id');
            })
            ->join('document as d', function ($join) {
                $join->on('d.id', '=', 'ad.document_id');
            })
            ->where('service_journal_id', $serviceJournalId)
            ->get(["ad.*","d.path"]);
        return $agreementDocument;
    }
}
