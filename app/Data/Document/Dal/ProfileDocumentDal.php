<?php

namespace App\Data\Document\Dal;

use App\Data\Document\Model\Document;
use App\Data\Document\Model\ProfileDocumentExt;
use App\Data\Document\Model\ProfileDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileDocumentDal
{

    /**
     * Return all documents by profile
     *
     * @param $profileId
     * @return mixed
     */
    public static function getListByProfile($profileId)
    {
        $entities = ProfileDocumentExt::where('profile_id',$profileId)->get();
        return $entities;
    }

    /**
     * Get ProfileDocument by Id
     *
     * @param $ProfileDocumentId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = ProfileDocumentExt::where('id', $entityId)->first();
        return $entity;
    }

    /**
     * Atach new document to profile
     *
     * @param $profileId
     * @param $documentName
     * @param $documentPath
     * @return ProfileDocumentExt|\Exception|mixed
     */
    public static function insert ($profileId, $documentName, $documentPath)
    {
        try {
            DB::beginTransaction();

            $document = new Document();
            $document->path = $documentPath;
            $document->name = $documentName;
            $insDocument = DocumentDal::set($document);

            $entity = new ProfileDocument;
            $entity->profile_id = $profileId;
            $entity->document_id = $insDocument->id;
            $entity->save();

            DB::commit();

            return self::get($entity->id);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return $e;
        }

    }

    /**
     * Delete ProfileDocument
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        try {
            DB::beginTransaction();

            $profileDocument = self::get($entityId);
            ProfileDocument::where('id', $entityId)->delete();
            DocumentDal::delete($profileDocument->document_id);

            DB::commit();

            return true;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }

    }

}
