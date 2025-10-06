<?php

namespace App\Data\ServiceJournal\Model;

use App\Data\Payment\Model\Agreement;
use App\Data\Payment\Model\Invoice;
use App\Data\Payment\Model\PaymentInvoice;
use App\Data\ServiceJournal\Model\ServiceJournalClientDocument;
use Illuminate\Database\Eloquent\Model;

class ServiceJournalExt extends Model
{
    protected $table = 'service_journal_ext';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function serviceStatus()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStatus','id','service_status_id');
    }

    public function projectStatus()
    {
        return $this->hasOne('App\Data\Project\Model\ProjectStatusTable','id','project_status_id');
    }

    public function manager()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','manager_id');
    }

    public function client()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','client_id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }

    public function serviceStepList()
    {
        return $this->hasMany(ServiceJournalStep::class, 'service_journal_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(ServiceJournalPayment::class,'service_journal_id', 'id');
    }

    public function documentList()
    {
        $agreementList = Agreement::where('service_journal_id', $this->id)->with('agreementType')->with('actualDocuments.documentPDF')->get();
        $invoiceList = Invoice::where('service_journal_id', $this->id)->with('invoiceType')->with('actualDocuments.documentPDF')->get();
        $paymentList = PaymentInvoice::where('service_journal_id', $this->id)->with('invoiceType')->with('actualDocuments.documentPDF')->get();

        $docList = array();

        foreach ($invoiceList as $doc){
            $obj = new \stdClass();
            $obj->doc_no = $doc->invoice_no;
            $obj->create_date = $doc->create_date;
            $obj->doc_type = $doc->invoiceType->name;

            $obj_documents = array();
            foreach ($doc->actualDocuments as $document){
                $d = new \stdClass();
                $d->path = $document->documentPDF->path;
                $d->documentType = $document->documentPDF->documentType->name;
                array_push($obj_documents, $d);
            }
            $obj->documents = $obj_documents;

            array_push($docList, $obj);
        }
        foreach ($paymentList as $doc){
            $obj = new \stdClass();
            $obj->doc_no = $doc->payment_invoice_no;
            $obj->create_date = $doc->create_date;
            $obj->doc_type = $doc->invoiceType->name;

            $obj_documents = array();
            foreach ($doc->actualDocuments as $document){
                $d = new \stdClass();
                $d->path = $document->documentPDF->path;
                $d->documentType = $document->documentPDF->documentType->name;
                array_push($obj_documents, $d);
            }
            $obj->documents = $obj_documents;

            array_push($docList, $obj);
        }
        foreach ($agreementList as $doc){
            $obj = new \stdClass();
            $obj->doc_no = $doc->agreement_no;
            $obj->create_date = $doc->create_date;
            $obj->doc_type = $doc->agreementType->name;

            $obj_documents = array();
            foreach ($doc->actualDocuments as $document){
                $d = new \stdClass();
                $d->path = $document->documentPDF->path;
                $d->documentType = $document->documentPDF->documentType->name;
                array_push($obj_documents, $d);
            }
            $obj->documents = $obj_documents;

            array_push($docList, $obj);
        }


        return collect($docList)->groupBy('doc_type');
    }

    public function clientDocumentList(){
        // Получаем документы клиента через ServiceJournalClientDocument
        return $this->hasMany(ServiceJournalClientDocument::class, 'service_journal_id', 'id')
            ->where('is_active', 1)
            ->with('document');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'service_journal_id', 'id');
    }

    public function paymentInvoice()
    {
        return $this->hasMany(PaymentInvoice::class, 'service_journal_id', 'id');
    }

    public function agreement()
    {
        return $this->hasMany(Agreement::class, 'service_journal_id', 'id');
    }
}
