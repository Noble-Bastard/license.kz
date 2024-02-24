<?php

namespace App\Data\Document\Dal;

use App\Data\Document\Model\Document;
use App\Data\Helper\DocumentTypeList;
use App\Data\ServiceJournal\Model\ServiceJournalClientDocument;

class DocumentDal
{

    /**
     * Get document by Id
     *
     * @param $documentId
     * @return Document
     */
    public static function get($entityId)
    {
        $document = Document::where('id', $entityId)->firstOrFail();
        return $document;
    }


    public static function getList($serviceJournalId)
    {
        $document = ServiceJournalClientDocument::where('service_journal_id', $serviceJournalId)
        ->leftJoin('document', 'document.id', '=', 'service_journal_client_document.document_id')
        ->select('document.*', 'service_journal_client_document.*')
        ->get();
        return $document;
    }


    /**
     * Insert (or update)  Document
     *
     * @param Document $srcEntity
     * @return Document
     */
    public static function set (Document $srcEntity)
    {
        if(is_null($srcEntity->document_type_id))
            $srcEntity->document_type_id = DocumentTypeList::NotDefined;

        $entity = empty($srcEntity->id) ? new Document() : Document::where('id', $srcEntity->id)->firstOrFail();
        $entity->path = $srcEntity->path;
        $entity->name = $srcEntity->name;
        $entity->document_type_id = $srcEntity->document_type_id;
        $entity->save();
        return $entity;
    }

    /**
     * Delete Document
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        Document::where('id', $entityId)->delete();
        return true;
    }

}
