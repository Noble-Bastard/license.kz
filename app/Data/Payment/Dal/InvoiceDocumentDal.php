<?php

namespace App\Data\Payment\Dal;

use App\Data\Helper\Assistant;
use App\Data\Payment\Model\InvoiceDocument;
use App\Data\Payment\Model\PaymentInvoice;
use Illuminate\Support\Facades\Auth;


class InvoiceDocumentDal
{
    public static function get($entityId): InvoiceDocument
    {
        $entity = InvoiceDocument::where('id', $entityId)->first();
        return $entity;
    }

    public static function insert($invoiceId, $documentId): InvoiceDocument
    {
        $entity = new InvoiceDocument();
        $entity->invoice_id = $invoiceId;
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
    public static function getListByServiceJournal($serviceJournalId, $invoiceTypeId)
    {
        $invoiceDocument = PaymentInvoice::from('invoice as inv')
            ->join('service_journal as sj', function ($join) {
                $join->on('sj.id', '=', 'inv.service_journal_id');
            })
            ->join('invoice_document as invd', function ($join) {
                $join->on('invd.invoice_id', '=', 'inv.id');
            })
            ->join('document as d', function ($join) {
                $join->on('d.id', '=', 'invd.document_id');
            })
            ->where('inv.service_journal_id', $serviceJournalId)
            ->where('inv.invoice_type_id', $invoiceTypeId)
            ->get(["invd.*","d.path"]);
        return $invoiceDocument;
    }


    public static function getListByClientServiceJournal($serviceJournalId)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

        $invoiceDocument = PaymentInvoice::from('invoice as inv')
            ->join('service_journal as sj', function ($join) use($profile){
                $join->on('sj.id', '=', 'inv.service_journal_id')
                    ->where('sj.client_id', $profile->id);
            })
            ->join('invoice_document as invd', function ($join) {
                $join->on('invd.invoice_id', '=', 'inv.id');
            })
            ->join('document as d', function ($join) {
                $join->on('d.id', '=', 'invd.document_id');
            })
            ->where('service_journal_id', $serviceJournalId)
            ->get(["invd.*","d.path"]);
        return $invoiceDocument;
    }
}
