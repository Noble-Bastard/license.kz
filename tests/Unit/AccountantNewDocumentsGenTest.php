<?php

namespace Tests\Unit;


use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\InvoiceTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AccountantNewDocumentsGenTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function tearDown() : void
    {
        DB::rollback();
        parent::tearDown();
    }

    public function testClientCheckAgreementDocumentGen()
    {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        $serviceJounalList = AgreementDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::ClientCheck,
            AgreementTypeList::ClientCheck
        );
        $this->assertEmpty($serviceJounalList);
    }

    public function testClientCheckInvoceDocumentGen()
    {
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        $serviceJounalList = InvoiceDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::ClientCheck,
            InvoiceTypeList::ClientCheck
        );
        $this->assertEmpty($serviceJounalList);
    }

    public function testClientCheckPaymentInvoceDocumentGen()
    {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        $serviceJounalList = PaymentInvoiceDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::ClientCheck,
            InvoiceTypeList::ClientCheck
            );
        $this->assertEmpty($serviceJounalList);
    }


    public function  testClientCheckDocuments() {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);

        $serviceJounalList = PaymentInvoiceDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::ClientCheck,
            InvoiceTypeList::ClientCheck
        );
        $this->assertEmpty($serviceJounalList);

    }

    public function  testPrepaymentDocuments() {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);

        $serviceJounalList = PaymentInvoiceDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::Prepayment,
            InvoiceTypeList::PrePayment
        );
        $this->assertEmpty($serviceJounalList);

    }
    public function  testPaymentDocuments() {
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
        $serviceJounalList = PaymentInvoiceDal::getServiceJournalListForNewDocumentGen(
            ServiceStatusList::Payment,
            InvoiceTypeList::FullPayment
        );
        $this->assertEmpty($serviceJounalList);
    }

    public function testAgreementDocumentMap() {
        $result = (new AgreementDal(24, 3))->generate();
        $this->assertNotEmpty($result);
    }


    public function testClientCheckAgreementDocumentMap() {
        $result = (new AgreementDal(32, AgreementTypeList::ClientCheck))->generate();
        $this->assertNotEmpty($result);
    }

}