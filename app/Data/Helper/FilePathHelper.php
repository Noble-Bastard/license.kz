<?php

namespace App\Data\Helper;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FilePathHelper
{

    public static function getTestSampleFolder()
    {
        return 'testSample';
    }



    public static function getClientDocsPath($userId)
    {
        return 'docs/' . $userId;
    }

    public static function getProfilePhoto($userId)
    {
        return 'profilePhoto/' . $userId;
    }

    public static function getServiceJournalClientPath($serviceJournalId)
    {
        return 'ServiceJournal/' . $serviceJournalId . '/client_docs';
    }

    public static function getServiceJournalManagerPath($serviceJournalId)
    {
        return 'ServiceJournal/' . $serviceJournalId . '/manager_docs';
    }

    public static function getServiceJournalAccountantDocumentPath($serviceJournalId)
    {
        return 'ServiceJournal/' . $serviceJournalId . '/accountant_docs';
    }

    public static function getCompanyDocumentTemplatePath()
    {
        return 'company/template_docs';
    }

    public static function getCompanyStandartContractTemplatePath()
    {
        return 'company/standart_contract_template';
    }


    public static function getPdfConvertorTempPath()
    {
        return 'mpdf/temp';
    }

    public static function getServiceImportTempPath()
    {
        return 'serviceImport/temp';
    }

    public static function getCompanyDocumentTemplateProcessingPath()
    {
        return 'company/template_docs/processing';
    }

    public static function getCommercialOfferDocumentPath()
    {
        return 'ServiceJournal/CommercialOffer';
    }

    public static function getCommercialOfferDocumentQrPath()
    {
        return 'ServiceJournal/CommercialOffer/QR';
    }

    public static function getCompanyPhotoPath()
    {
        return "public/company";
    }

    public static function getEmployeePhotoPath()
    {
        return "public/employee";
    }

    public static function getEventPhotoPath()
    {
        return "public/event";
    }

    public static function getCareerFormPath()
    {
        return "career/form";
    }

    public static function getPartnerFormPath()
    {
        return "public/partner/form";
    }

    public static function getCatalogFormPath()
    {
        return "public/catalog";
    }

    public static function getCountryFlagPath()
    {
        return "public/flags";
    }


    public static function getFileBaseNameWithoutExtension($fileName): String
    {
        $extension = "." . self::getFileExtension($fileName);
        return basename($fileName, $extension);
    }

    public static function getFileBaseName($fileName): String
    {
        return basename($fileName);
    }

    public static function getFileExtension($fileName): String
    {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    public static function getStoragePath()
    {
        return Storage::disk('local')->getAdapter()->getPathPrefix();
    }


    public static function getFileFullName($fileName)
    {
        return Storage::disk('local')->path($fileName);
    }

    public static function getFileDirectory($fileName)
    {
        return pathinfo($fileName, PATHINFO_DIRNAME);
    }


    public static function getValidFileName($fileName)
    {
        return  str_replace(array('\\','/',':','*','?','"','<','>','|'),'_',$fileName);
    }


    public static function downloadFile($filePath, $fileName)
    {
        $fileName = self::getValidFileName($fileName);
        return response()->file(self::getFileFullName($filePath), [
            'Content-Disposition' => str_replace('%name', $fileName, "inline; filename=\"%name\"; filename*=utf-8''%name"),
            'Content-Type'        => Storage::getMimeType($filePath),
        ]);
    }

    public static function getNewsPreviewPhotoPath()
    {
        return "public/userfiles/files";
    }

}
