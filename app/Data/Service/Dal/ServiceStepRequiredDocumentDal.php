<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\ServiceStepRequiredDocument;
use App\Data\ServiceJournal\Dal\ServiceJournalServiceMapDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\DB;

class ServiceStepRequiredDocumentDal extends BaseDal
{
    protected $rules = [
        'service_step_id' => 'required|numeric',
        'service_required_document_id' => 'required|numeric',
        'document_number' => 'required|numeric'
    ];

    public function __construct()
    {
        parent::__construct(ServiceStepRequiredDocument::class);
    }

    public function getByServiceStep($serviceStepId, $serviceIdList, bool $translateData = false)
    {
        $entityList = ServiceStepRequiredDocument::where('service_step_id', $serviceStepId)
            ->whereIn('service_id',$serviceIdList)
            ->with('serviceRequiredDocument');

        return $entityList->get();
    }

    public function getByService($serviceId)
    {
        $entityList = ServiceStepRequiredDocument::where('service_id',$serviceId)
            ->with('serviceRequiredDocument');

        return $entityList->get();
    }

    public function getByServiceStepAndService($serviceStepId, $serviceId, bool $translateData = false)
    {
        $entityList = ServiceStepRequiredDocument::where('service_step_id', $serviceStepId)
            ->where('service_id', $serviceId)
            ->with('serviceRequiredDocument');
        return $entityList->get();
    }


    public function deleteByServiceStepAndService($serviceStepId, $serviceId)
    {
        ServiceStepRequiredDocument::where('service_step_id', $serviceStepId)
            ->where('service_id', $serviceId)
            ->delete();

        return true;
    }

    public function deleteByServiceId($serviceId)
    {
        ServiceStepRequiredDocument::where('service_id', $serviceId)
            ->delete();
        return true;
    }

    public function getListByServiceArray($serviceArray, bool $translateData = false)
    {
        $entityList = ServiceStepRequiredDocument::whereIn('service_id', $serviceArray)
            ->select('service_step_id', 'service_required_document_id', DB::raw('max(document_number) as document_number'))
            ->groupBy('service_step_id', 'service_required_document_id')
            ->orderBy('document_number');

        if($translateData){
            $entityList->with('serviceRequiredDocumentWithTranslate');
        } else {
            $entityList->with('serviceRequiredDocument');
        }

        return $entityList->get();
    }

    public function getByServiceJournal($serviceJournalId) {
        $serviceIdList = (new ServiceJournalServiceMapDal())
            ->getServiceIdListByServiceJournalId($serviceJournalId)
            ->toArray();

        $requiredDocumentList = ServiceJournal::from('service_journal_step as sjst')
            ->join('service_step_required_document as strd', function ($join) use ($serviceIdList){
                $join->on('strd.service_step_id','sjst.service_step_id')
                    ->whereIn('strd.service_id',$serviceIdList);
            })
            ->join('service_required_document as rd', function ($join){
                $join->on('rd.id','strd.service_required_document_id');
            })
            ->where('sjst.service_journal_id',$serviceJournalId)
            ->distinct()
            ->get(['rd.*','sjst.service_step_id']);

        return $requiredDocumentList;
    }

    public function getByServiceJournalAndStep($serviceJournalId, $serviceStepId) {
        $serviceIdList = (new ServiceJournalServiceMapDal())
            ->getServiceIdListByServiceJournalId($serviceJournalId)
            ->toArray();

        $requiredDocumentList = ServiceJournal::from('service_journal_step as sjst')
            ->join('service_step_required_document as strd', function ($join) use ($serviceIdList){
                $join->on('strd.service_step_id','sjst.service_step_id')
                    ->whereIn('strd.service_id',$serviceIdList);
            })
            ->join('service_required_document as rd', function ($join){
                $join->on('rd.id','strd.service_required_document_id');
            })
            ->where('sjst.service_journal_id',$serviceJournalId)
            ->where('sjst.service_step_id', $serviceStepId)
            ->distinct()
            ->get(['rd.*','sjst.service_step_id']);

        return $requiredDocumentList;
    }

}
