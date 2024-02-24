<?php

namespace App\Data\ServiceJournal\Dal;


use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\Helper\Assistant;
use App\Data\Helper\RoleList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Helper\ServiceStatusTypeList;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceStatus;
use App\Data\Service\Model\ServiceStep;
use App\Data\Service\Model\ServiceStepMap;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Data\ServiceJournal\Model\ServiceJournalClientDocument;
use App\Data\ServiceJournal\Model\ServiceJournalDocument;
use App\Data\ServiceJournal\Model\ServiceJournalExt;
use App\Data\ServiceJournal\Model\ServiceJournalPayment;
use App\Data\ServiceJournal\Model\ServiceJournalProfileLegal;
use App\Data\ServiceJournal\Model\ServiceJournalServiceMap;
use App\Data\ServiceJournal\Model\ServiceJournalStep;
use App\Data\ServiceJournal\Model\ServiceJournalStepExt;
use App\Data\Task\Dal\TaskDal;
use App\Data\WorkingCalendar\Dal\WorkingCalendarDal;
use App\Mail\ServiceAssignManagerToClientMessageNotification;
use App\Mail\ServiceAssignManagerToManagerMessageNotification;
use App\Mail\ServiceCreateMessageNotification;
use App\Mail\ServiceStatusChangeMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceJournalDal
{

  public static function getExt($entityId)
  {
    $entity = ServiceJournalExt::where('id', $entityId)->firstOrFail();
    return $entity;
  }

  public static function get($entityId)
  {
    $entity = ServiceJournal::where('id', $entityId)
      ->with('licenseType')
      ->with('client')
      ->with('serviceJournalPayment')
      ->firstOrFail();

    return $entity;
  }


  public static function getServiceJournalStepList($entityId)
  {
    $entityList = ServiceJournalStepExt::where('service_journal_id', $entityId)->orderBy('service_step_no')->get();
    return $entityList;
  }

  public static function getServiceJournalListByCurrentUser(?int $service_status_id, bool $isPaginate)
  {
    $userId = Auth::id();
    $clientProfile = ProfileDal::getByUserId($userId);


    if ($service_status_id != null) {
      $serviceJournalList = ServiceJournalExt::where('client_id', $clientProfile->id)
        ->where('service_status_id', $service_status_id);
    } else {
      $serviceJournalList = ServiceJournalExt::where('client_id', $clientProfile->id);
    }

    if ($isPaginate) {
      $serviceJournalList = $serviceJournalList->paginate(15);
    } else {
      $serviceJournalList = $serviceJournalList->get();
    }

    return $serviceJournalList;
  }

  public static function getServiceJournalListByCurrentUserAndStatusType(?int $service_status_type, bool $isPaginate)
  {
    $userId = Auth::id();
    $clientProfile = ProfileDal::getByUserId($userId);

    $serviceJournalList = ServiceJournalExt::where('client_id', $clientProfile->id);
    switch ($service_status_type) {
      case ServiceStatusTypeList::Opened :
      {
        $serviceJournalList = $serviceJournalList->whereNotIn('service_status_id', array(ServiceStatusList::Complete, ServiceStatusList::Rejected));
        break;
      }
      case ServiceStatusTypeList::Closed :
      {
        $serviceJournalList = $serviceJournalList->whereIn('service_status_id', array(ServiceStatusList::Complete, ServiceStatusList::Rejected));
        break;
      }
    }

    if ($isPaginate) {
      $serviceJournalList = $serviceJournalList->paginate(15);
    } else {
      $serviceJournalList = $serviceJournalList->get();
    }

    return $serviceJournalList;
  }

  public static function getServiceJournalList(bool $isPaginate)
  {
    if ($isPaginate) {
      $serviceJournalList = ServiceJournalExt::orderBy('create_date', 'asc')->paginate(15);
    } else {
      $serviceJournalList = ServiceJournalExt::orderBy('create_date', 'asc')->get();
    }
    return $serviceJournalList;
  }

  public static function getServiceJournalListbyStatus(bool $isPaginate, $service_status_id)
  {
    $serviceJournalList = ServiceJournalExt::orderBy('create_date', 'asc')->where('service_status_id', $service_status_id);
    if ($isPaginate) {
      $serviceJournalList = $serviceJournalList->paginate(15);
    } else {
      $serviceJournalList = $serviceJournalList->get();
    }
    return $serviceJournalList;
  }


  public static function getServiceJournalListByManager(int $managerId, bool $isPaginate, $projectStatusId = null)
  {
    $serviceJournalList = ServiceJournalExt::where('manager_id', $managerId)
      ->whereIn('service_status_id',
        [
          ServiceStatusList::Execution,
          ServiceStatusList::ClientCheck,
          ServiceStatusList::DataCollection,
          ServiceStatusList::Check,
          ServiceStatusList::Payment,
          ServiceStatusList::Complete
        ]
      );

    if (!is_null($projectStatusId)) {
      $serviceJournalList = $serviceJournalList->where('project_status_id', $projectStatusId);
    }

    $serviceJournalList = $serviceJournalList->orderBy('create_date', 'asc');

    if ($isPaginate) {
      $serviceJournalList = $serviceJournalList->paginate(Assistant::getDefaultPaginateCnt());
    } else {
      $serviceJournalList = $serviceJournalList->get();
    }
    return $serviceJournalList;
  }

  public static function getServiceJournalListByClientAndAgent(int $clientId, int $agentId, bool $isPaginate)
  {
    $serviceJournalList = ServiceJournalExt::where('client_id', $clientId)
      ->join('client as c', function ($join) use ($agentId) {
        $join->on('c.profile_id', '=', 'service_journal_ext.client_id')
          ->where('c.agent_id', $agentId);
      })
      ->orderBy('create_date', 'desc');

    if ($isPaginate) {
      $serviceJournalList = $serviceJournalList->paginate(Assistant::getDefaultPaginateCnt());
    } else {
      $serviceJournalList = $serviceJournalList->get();
    }
    return $serviceJournalList;
  }

  public static function setServiceJournalStatus($serviceJournalId, $statusId, $rejectReason = null)
  {
    $serviceJournal = ServiceJournal::where('id', $serviceJournalId)->firstOrFail();
    $serviceJournal->service_status_id = $statusId;

    if ($statusId == ServiceStatusList::Rejected || $statusId == ServiceStatusList::DataCollection)
      $serviceJournal->reject_reason = $rejectReason;

    $serviceJournal->save();

    $emailEntity = new EmailJournal();
    $emailEntity->recipients = self::getRecipients($serviceJournal);
    $emailEntity->subject = 'У услуги ' . $serviceJournal->service_no . ' изменился статус';

    (new ServiceStatusChangeMessageNotification($emailEntity, array(), $serviceJournal))->setData();

    return self::getExt($serviceJournalId);
  }

  public static function completeServiceJournalStep($serviceJournalStepId)
  {
    $serviceJournalStep = ServiceJournalStep::where('id', $serviceJournalStepId)->firstOrFail();
    $serviceJournalStep->completion_date = Assistant::getCurrentDate();
    $serviceJournalStep->is_completed = true;
    $serviceJournalStep->save();
    return $serviceJournalStep;
  }

  public static function addServiceJournalDocument($serviceJournalId, Document $document, $description)
  {

    try {
      DB::beginTransaction();

      $savedDocument = DocumentDal::set($document);
      $serviceJournalDocument = new ServiceJournalDocument;
      $serviceJournalDocument->service_journal_id = $serviceJournalId;
      $serviceJournalDocument->document_id = $savedDocument->id;
      $serviceJournalDocument->create_date = Assistant::getCurrentDate();
      $serviceJournalDocument->created_by = Auth::id();
      $serviceJournalDocument->description = $description;

      $serviceJournalDocument->save();

      DB::commit();

      return $serviceJournalDocument;

    } catch
    (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      return $e;
    }
  }

  public static function addServiceJournalClientDocument($serviceJournalId, $serviceStepId, Document $document, $description, $documentId)
  {

    $serviceJournalStep = ServiceJournalStep::where('service_journal_id', $serviceJournalId)
      ->where('service_step_id', $serviceStepId)
      ->first();

    try {
      DB::beginTransaction();

      $savedDocument = DocumentDal::set($document);
      $serviceJournalClientDocument = new ServiceJournalClientDocument();
      $serviceJournalClientDocument->service_journal_id = $serviceJournalId;
      $serviceJournalClientDocument->service_journal_step_id = $serviceJournalStep->id;
      $serviceJournalClientDocument->document_id = $savedDocument->id;
      $serviceJournalClientDocument->create_date = Assistant::getCurrentDate();
//            $serviceJournalClientDocument->created_by = Auth::user()->id;
      $serviceJournalClientDocument->description = $description;
      $serviceJournalClientDocument->is_active = 1;
      $serviceJournalClientDocument->service_required_document_id = $documentId;
      $serviceJournalClientDocument->save();

      DB::commit();

      return $serviceJournalClientDocument;

    } catch
    (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      throw $e;
    }
  }

  public static function getServiceJournalClientDocumentList($serviceJournalId)
  {
    return ServiceJournalClientDocument::where('service_journal_id', $serviceJournalId)->get();
  }


  public static function assignServiceJournalManager($serviceJournalId, $managerId)
  {
    try {

      DB::beginTransaction();

      $serviceJournalExt = self::setServiceJournalStatus($serviceJournalId, ServiceStatusList::Prepayment);
      $serviceJournal = ServiceJournal::where('id', $serviceJournalExt->id)->firstOrFail();
      $serviceJournal->manager_id = $managerId;
      $serviceJournal->modify_date = Assistant::getCurrentDate();
      $serviceJournal->save();

      ProjectDal::assignProjectManager($serviceJournalId, $managerId);

      DB::commit();

      $subject = 'Услуге ' . $serviceJournal->service_no . ' назначен менеджер';

      $emailEntity = new EmailJournal();
      $emailEntity->recipients = $serviceJournal->client->email;
      $emailEntity->subject = $subject;

      (new ServiceAssignManagerToClientMessageNotification($emailEntity, array(), $serviceJournal))->setData();

      $emailEntity = new EmailJournal();
      $emailEntity->recipients = $serviceJournal->manager->email;
      $emailEntity->subject = $subject;

      (new ServiceAssignManagerToManagerMessageNotification($emailEntity, array(), $serviceJournal))->setData();

      return $serviceJournal;

    } catch
    (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      return $e;
    }
  }


  public static function newServiceRequest($serviceIdList, $profileLegal, $paymentTypeId, $selectedCityId)
  {

    //get current user info
    $userId = Auth::id();
    $clientProfile = ProfileDal::getByUserId($userId);

    $serviceStepList = array();

//        $inputServiceStepList = ServiceStepMap::whereIn('service_id', $serviceIdList)->select('id')->get();
//        foreach ($inputServiceStepList as $inputServiceStep){
//            array_push($serviceStepList, $inputServiceStep->id);
//        }

    $totalServiceCost = 0;
    $totalServiceTax = 0;

    $serviceStepList = (new ServiceStepMapDal())->getExtByService($serviceIdList);

    try {
      DB::beginTransaction();

      //get top one service data
      $topService = ServiceDal::get($serviceIdList[0]);

      $sale_manager = null; //todo add logic to get sale_manager

      //new service journal
      $serviceJournal = new ServiceJournal();
      $serviceJournal->service_status_id = ServiceStatusList::Creation;

      $serviceJournal->client_id = $clientProfile->id;
      $serviceJournal->manager_id = null;
      $serviceJournal->sale_manager_id = $sale_manager;
      $serviceJournal->service_no = CounterDal::getCounterValue($topService->counter_type_id);
      $serviceJournal->create_date = Assistant::getCurrentDate();
      $serviceJournal->modify_date = null;
      $serviceJournal->country_id = $topService->country_id;
      $serviceJournal->license_type_id = $serviceStepList[0]->license_type_id;
      $serviceJournal->payment_type_id = $paymentTypeId;
      $serviceJournal->city_id = $selectedCityId;
      $serviceJournal->save();

      if ($profileLegal) {
        $serviceJournalProfileLegal = new ServiceJournalProfileLegal();
        $serviceJournalProfileLegal->service_journal_id = $serviceJournal->id;;
        $serviceJournalProfileLegal->company_name = $profileLegal->company_name;
        $serviceJournalProfileLegal->bank_code_type_id = $profileLegal->bank_code_type_id;
        $serviceJournalProfileLegal->bank_code = $profileLegal->bank_code;
        $serviceJournalProfileLegal->director_name = $profileLegal->director_name;
        $serviceJournalProfileLegal->legal_address = $profileLegal->legal_address;
        $serviceJournalProfileLegal->business_identification_number = $profileLegal->business_identification_number;
        $serviceJournalProfileLegal->contact_person = $profileLegal->contact_person;
        $serviceJournalProfileLegal->position = $profileLegal->position;
        $serviceJournalProfileLegal->scope_activity = $profileLegal->scope_activity;
        $serviceJournalProfileLegal->save();
      }

      self::fillServiceJournalServiceMap($serviceIdList, $serviceJournal->id);

      //copy service journal steps: service_step -> service_journal_step
      foreach ($serviceStepList as $serviceStep) {
        $serviceJournalStep = new ServiceJournalStep();
        $serviceJournalStep->completion_date = null;
        $serviceJournalStep->service_step_id = $serviceStep->id;
        $serviceJournalStep->is_completed = false;
        $serviceJournalStep->service_journal_id = $serviceJournal->id;
        $serviceJournalStep->execution_start_date = null;
        $serviceJournalStep->service_step_no = CounterDal::getCounterValue($serviceStep->counter_type_id);
        $serviceJournalStep->save();

        $totalServiceCost += $serviceStep->step_cost;
        $totalServiceTax += $serviceStep->step_tax;
      }

      $totalServiceTax *= SettingDal::getMrp();

      $serviceList = Service::whereIn('id', $serviceIdList)->get();
      $totalServiceCost += ServiceDal::getServiceCost($serviceList);

      //insert init data into service_journal_payment
      $serviceJournalPayment = new ServiceJournalPayment();
      $serviceJournalPayment->service_journal_id = $serviceJournal->id;
      $serviceJournalPayment->create_date = Assistant::getCurrentDate();
      $serviceJournalPayment->amount = $totalServiceCost;
      $serviceJournalPayment->prepayment_percent = 0;
      $serviceJournalPayment->tax = $totalServiceTax;
      $serviceJournalPayment->currency_id = $topService->currency_id;
      $serviceJournalPayment->save();

      //init tasks
      TaskDal::generateTaskByServiceJournal($serviceJournal->id);

      DB::commit();

      $emailEntity = new EmailJournal();
      $emailEntity->recipients = self::getRecipients($serviceJournal);
      $emailEntity->subject = 'Создана новая услуга - ' . $serviceJournal->service_no;

      (new ServiceCreateMessageNotification($emailEntity, array(), $serviceJournal))->setData();

      return self::getExt($serviceJournal->id);

    } catch
    (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      return $e;
    }

  }

  public static function newExtraServiceRequest($extraServiceHeaderData, $extraServiceCode, $profileLegal, $paymentTypeId, $selectedCityId)
  {
    //get current user info
    $userId = Auth::id();
    $clientProfile = ProfileDal::getByUserId($userId);

    $serviceStepList = $extraServiceHeaderData;

    $totalServiceCost = 0;
    $totalServiceTax = 0;

    try {
      DB::beginTransaction();

      $sale_manager = null; //todo add logic to get sale_manager

      //new service journal
      $serviceJournal = new ServiceJournal();
      $serviceJournal->service_status_id = ServiceStatusList::Creation;

      $serviceJournal->client_id = $clientProfile->id;
      $serviceJournal->manager_id = null;
      $serviceJournal->sale_manager_id = $sale_manager;
      $serviceJournal->service_no = CounterDal::getCounterValue(1); //GENERAL_COUNTER
      $serviceJournal->create_date = Assistant::getCurrentDate();
      $serviceJournal->modify_date = null;
      $serviceJournal->country_id = 1; //KZ
      $serviceJournal->license_type_id = 1; //base license
      $serviceJournal->payment_type_id = $paymentTypeId;
      $serviceJournal->city_id = $selectedCityId;
      $serviceJournal->save();

      if ($profileLegal) {
        $serviceJournalProfileLegal = new ServiceJournalProfileLegal();
        $serviceJournalProfileLegal->service_journal_id = $serviceJournal->id;;
        $serviceJournalProfileLegal->company_name = $profileLegal->company_name;
        $serviceJournalProfileLegal->bank_code_type_id = $profileLegal->bank_code_type_id;
        $serviceJournalProfileLegal->bank_code = $profileLegal->bank_code;
        $serviceJournalProfileLegal->director_name = $profileLegal->director_name;
        $serviceJournalProfileLegal->legal_address = $profileLegal->legal_address;
        $serviceJournalProfileLegal->business_identification_number = $profileLegal->business_identification_number;
        $serviceJournalProfileLegal->contact_person = $profileLegal->contact_person;
        $serviceJournalProfileLegal->position = $profileLegal->position;
        $serviceJournalProfileLegal->scope_activity = $profileLegal->scope_activity;
        $serviceJournalProfileLegal->save();
      }

      self::fillServiceJournalServiceMap($serviceStepList->pluck('service_id'), $serviceJournal->id);

      foreach ($extraServiceHeaderData as $header) {
        foreach ($header->step_body_list as $serviceStep) {
          $serviceJournalStep = new ServiceJournalStep();
          $serviceJournalStep->completion_date = null;
          $serviceJournalStep->service_step_id = $serviceStep->service_step_id;
          $serviceJournalStep->is_completed = false;
          $serviceJournalStep->service_journal_id = $serviceJournal->id;
          $serviceJournalStep->execution_start_date = null;
          $serviceJournalStep->service_step_no = CounterDal::getCounterValue(12); //GENERAL_STEP_COUNTER
          $serviceJournalStep->save();

          $totalServiceCost += $header->cost;
          $totalServiceTax += 0;
        }
      }

      //insert init data into service_journal_payment
      $serviceJournalPayment = new ServiceJournalPayment();
      $serviceJournalPayment->service_journal_id = $serviceJournal->id;
      $serviceJournalPayment->create_date = Assistant::getCurrentDate();
      $serviceJournalPayment->amount = $totalServiceCost;
      $serviceJournalPayment->prepayment_percent = 0;
      $serviceJournalPayment->tax = $totalServiceTax;
      $serviceJournalPayment->currency_id = 1; //KZT

      $serviceJournalPayment->save();

      //init tasks
      TaskDal::generateTaskByServiceJournal($serviceJournal->id);

      DB::commit();

      $emailEntity = new EmailJournal();
      $emailEntity->recipients = self::getRecipients($serviceJournal);
      $emailEntity->subject = 'Создана новая услуга - ' . $serviceJournal->service_no;

      (new ServiceCreateMessageNotification($emailEntity, array(), $serviceJournal))->setData();

      return self::getExt($serviceJournal->id);

    } catch
    (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      return $e;
    }
  }

  private static function getRecipients($serviceJournal, bool $sendToClient = true)
  {
    $recipients = array();

    if ($sendToClient) {
      array_push($recipients, $serviceJournal->client->email);
    }
    if ($serviceJournal->manager != null) {
      array_push($recipients, $serviceJournal->manager->email);
    }
    if ($serviceJournal->service_status_id == ServiceStatusList::Payment || $serviceJournal->service_status_id == ServiceStatusList::SendBill || $serviceJournal->service_status_id == ServiceStatusList::Prepayment) {
      $accountantList = ProfileDal::getListByRoleType(RoleList::Accountant, false);

      foreach ($accountantList as $accountant) {
        array_push($recipients, $accountant->email);
      }
    }

    return implode(";", $recipients);
  }

  public static function setServiceJournalClientDocActiveStatus($serviceJournalClientDocumentId, $isActive)
  {
    $ServiceJournalClientDoc = ServiceJournalClientDocument::where('id', $serviceJournalClientDocumentId)->firstOrFail();
    $ServiceJournalClientDoc->is_active = $isActive;
    $ServiceJournalClientDoc->save();
  }

  public static function getServiceJournalStatusList()
  {
    return ServiceStatus::orderBy('status_order')
      ->get();
  }

  public static function startExecution($servicesJournalId)
  {
    self::setServiceJournalStatus($servicesJournalId, ServiceStatusList::Execution);
    $serviceJournalStepExtList = ServiceJournalStepExt::where('service_journal_id', $servicesJournalId)
      ->orderBy('execution_parallel_no')
      ->get();
    $executionDate = Assistant::getCurrentDate();
    $lastExecutionDate = Assistant::getCurrentDate();
    $executionParallelNo = null;
    foreach ($serviceJournalStepExtList as $serviceJournalStepExt) {

      $serviceJournalStep = ServiceJournalStep::where('id', $serviceJournalStepExt->id)->firstOrFail();

      if ($executionParallelNo != $serviceJournalStepExt->execution_parallel_no) {
        if (!is_null($executionParallelNo)) {
          $executionDate = clone $lastExecutionDate;
        }
        $executionParallelNo = $serviceJournalStepExt->execution_parallel_no;
      }

      $serviceJournalStep->execution_start_date = clone $executionDate;
      $serviceJournalStep->completion_date = WorkingCalendarDal::getWorkEndDate(
        clone $serviceJournalStep->execution_start_date,
        $serviceJournalStepExt->execution_work_day_cnt
      );
      $serviceJournalStep->save();

      if ($lastExecutionDate < $serviceJournalStep->completion_date->modify("+1 day")->setTime(0, 0, 0)) {
        $lastExecutionDate = clone $serviceJournalStep->completion_date->modify("+1 day")->setTime(0, 0, 0);
      }
    }
  }

  public static function getAccountantServiceJournalList($serviceStatusId)
  {
    $serviceJournalList = ServiceJournalExt::orderBy('create_date', 'desc')
      ->where('service_status_id', $serviceStatusId)
      ->get();
    return $serviceJournalList;
  }

  public static function getHeadServiceJournalList($serviceStatusId)
  {
    $serviceJournalList = ServiceJournalExt::orderBy('create_date', 'desc')
      ->where('service_status_id', $serviceStatusId)
      ->get();
    return $serviceJournalList;
  }

  public static function getClientServiceJournalList($serviceStatusId)
  {
    $profile = ProfileDal::getByUserId(Auth::id());
    $serviceJournalList = ServiceJournalExt::where('client_id', $profile->id)
      ->where('service_status_id', $serviceStatusId)
      ->orderBy('create_date', 'desc')
      ->get();
    return $serviceJournalList;
  }

  public static function getPaymentByServiceJournalId($serviceJournalId)
  {
    return ServiceJournalPayment::where('service_journal_id', $serviceJournalId)->with('currency')->first();
  }


  private static function fillServiceJournalServiceMap($serviceIdList, $serviceJournalId)
  {
    $serviceJournalServiceMapDal = new ServiceJournalServiceMapDal();
    foreach ($serviceIdList as $serviceId) {
      $serviceJournalServiceMap = new ServiceJournalServiceMap();
      $serviceJournalServiceMap->service_journal_id = $serviceJournalId;
      $serviceJournalServiceMap->service_id = $serviceId;
      $serviceJournalServiceMapDal->set($serviceJournalServiceMap);
    }
    return $serviceId;
  }


  public static function setPrepaymentPercent($serviceJournalId, $prepaymentPercent)
  {
    $serviceJournalPayment = self::getPaymentByServiceJournalId($serviceJournalId);
    $serviceJournalPayment->prepayment_percent = $prepaymentPercent;
    $serviceJournalPayment->save();
  }


}
